<?php

/**
 * Class RoboFile
 */
class RoboFile extends \Robo\Tasks
{
    /**
     * Build the our distribution package
     */
    public function build()
    {
        // Delete existing distribution directory
        $this->taskDeleteDir('dist')
            ->run();

        // Copy the src directory into the stack
        $this->taskFileSystemStack()
            ->mirror('src', 'dist/globee-opencart-3.0.2')
            ->run();

        // Copy the SDK into the stack
        $this->taskFileSystemStack()
            ->mirror('vendor/globee/payment-api/src/', 'dist/globee-opencart-3.0.2/upload/system/library/globee')
            ->run();

        // Build the zip
        $this->taskExec('zip')
            ->dir('dist/globee-opencart-3.0.2')
            ->arg('-r')
            ->arg('../globee-opencart-3.0.2.ocmod.zip')
            ->arg('./')
            ->run();

        // Delete the directory
        $this->taskDeleteDir('dist/globee-opencart-3.0.2')
            ->run();
    }
}
