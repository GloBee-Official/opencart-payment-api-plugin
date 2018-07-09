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
            ->mirror('src/structure/', 'dist/globee-opencart-3.0.2')
            ->run();
        $this->taskFileSystemStack()
            ->mirror('src/structure/', 'dist/globee-opencart-2.1.0')
            ->run();

        // Build the directory structure for version 2.3 and 3.0
        $this->taskFileSystemStack()
            ->mirror('vendor/globee/payment-api/src/', 'dist/globee-opencart-3.0.2/upload/system/library/globee')
            ->run();
        $this->taskFileSystemStack()
            ->mirror('src/code/admin/controller/', 'dist/globee-opencart-3.0.2/upload/admin/controller/extension/payment/')
            ->run();
        $this->taskFileSystemStack()
            ->mirror('src/code/admin/language/', 'dist/globee-opencart-3.0.2/upload/admin/language/en-gb/extension/payment/')
            ->run();
        $this->taskFileSystemStack()
            ->mirror('src/code/admin/view/image/', 'dist/globee-opencart-3.0.2/upload/admin/view/image/payment/')
            ->run();
        $this->taskFileSystemStack()
            ->mirror('src/code/admin/view/template/', 'dist/globee-opencart-3.0.2/upload/admin/view/template/extension/payment/')
            ->run();
        $this->taskFileSystemStack()
            ->mirror('src/code/catalog/controller/', 'dist/globee-opencart-3.0.2/upload/catalog/controller/extension/payment/')
            ->run();
        $this->taskFileSystemStack()
            ->mirror('src/code/catalog/language/', 'dist/globee-opencart-3.0.2/upload/catalog/language/en-gb/extension/payment/')
            ->run();
        $this->taskFileSystemStack()
            ->mirror('src/code/catalog/model/', 'dist/globee-opencart-3.0.2/upload/catalog/model/extension/payment/')
            ->run();
        $this->taskFileSystemStack()
            ->mirror('src/code/catalog/view/', 'dist/globee-opencart-3.0.2/upload/catalog/view/theme/default/template/extension/payment/')
            ->run();
        $this->taskFileSystemStack()
            ->mirror('src/code/system/library/', 'dist/globee-opencart-3.0.2/upload/system/library/globee/')
            ->run();

        // Build the directory structure for version 2.2
        $this->taskFileSystemStack()
            ->mirror('vendor/globee/payment-api/src/', 'dist/globee-opencart-2.2.0/upload/system/library/globee')
            ->run();
        $this->taskFileSystemStack()
            ->mirror('src/code/admin/controller/', 'dist/globee-opencart-2.2.0/upload/admin/controller/payment/')
            ->run();
        $this->taskFileSystemStack()
            ->mirror('src/code/admin/language/', 'dist/globee-opencart-2.2.0/upload/admin/language/en-gb/payment/')
            ->run();
        $this->taskFileSystemStack()
            ->mirror('src/code/admin/view/image/', 'dist/globee-opencart-2.2.0/upload/admin/view/image/payment/')
            ->run();
        $this->taskFileSystemStack()
            ->mirror('src/code/admin/view/template/', 'dist/globee-opencart-2.2.0/upload/admin/view/template/payment/')
            ->run();
        $this->taskFileSystemStack()
            ->mirror('src/code/catalog/controller/', 'dist/globee-opencart-2.2.0/upload/catalog/controller/payment/')
            ->run();
        $this->taskFileSystemStack()
            ->mirror('src/code/catalog/language/', 'dist/globee-opencart-2.2.0/upload/catalog/language/en-gb/payment/')
            ->run();
        $this->taskFileSystemStack()
            ->mirror('src/code/catalog/model/', 'dist/globee-opencart-2.2.0/upload/catalog/model/payment/')
            ->run();
        $this->taskFileSystemStack()
            ->mirror('src/code/catalog/view/', 'dist/globee-opencart-2.2.0/upload/catalog/view/theme/default/template/payment/')
            ->run();
        $this->taskFileSystemStack()
            ->mirror('src/code/system/library/', 'dist/globee-opencart-2.2.0/upload/system/library/globee/')
            ->run();

        // Build the directory structure for version 2.1
        $this->taskFileSystemStack()
            ->mirror('vendor/globee/payment-api/src/', 'dist/globee-opencart-2.1.0/upload/system/library/globee')
            ->run();
        $this->taskFileSystemStack()
            ->mirror('src/code/admin/controller/', 'dist/globee-opencart-2.1.0/upload/admin/controller/payment/')
            ->run();
        $this->taskFileSystemStack()
            ->mirror('src/code/admin/language/', 'dist/globee-opencart-2.1.0/upload/admin/language/english/payment/')
            ->run();
        $this->taskFileSystemStack()
            ->mirror('src/code/admin/view/image/', 'dist/globee-opencart-2.1.0/upload/admin/view/image/payment/')
            ->run();
        $this->taskFileSystemStack()
            ->mirror('src/code/admin/view/template/', 'dist/globee-opencart-2.1.0/upload/admin/view/template/payment/')
            ->run();
        $this->taskFileSystemStack()
            ->mirror('src/code/catalog/controller/', 'dist/globee-opencart-2.1.0/upload/catalog/controller/payment/')
            ->run();
        $this->taskFileSystemStack()
            ->mirror('src/code/catalog/language/', 'dist/globee-opencart-2.1.0/upload/catalog/language/english/payment/')
            ->run();
        $this->taskFileSystemStack()
            ->mirror('src/code/catalog/model/', 'dist/globee-opencart-2.1.0/upload/catalog/model/payment/')
            ->run();
        $this->taskFileSystemStack()
            ->mirror('src/code/catalog/view/', 'dist/globee-opencart-2.1.0/upload/catalog/view/theme/default/template/payment/')
            ->run();
        $this->taskFileSystemStack()
            ->mirror('src/code/system/library/', 'dist/globee-opencart-2.1.0/upload/system/library/globee/')
            ->run();

        // Build the zips
        $this->taskExec('zip')
            ->dir('dist/globee-opencart-3.0.2')
            ->arg('-r')
            ->arg('../globee-opencart-3.0.2.ocmod.zip')
            ->arg('./')
            ->run();
        $this->taskExec('zip')
            ->dir('dist/globee-opencart-2.2.0')
            ->arg('-r')
            ->arg('../globee-opencart-2.2.0.ocmod.zip')
            ->arg('./')
            ->run();
        $this->taskExec('zip')
            ->dir('dist/globee-opencart-2.1.0')
            ->arg('-r')
            ->arg('../globee-opencart-2.1.0.ocmod.zip')
            ->arg('./')
            ->run();

        // Delete the directories
        $this->taskDeleteDir('dist/globee-opencart-3.0.2')
            ->run();
        $this->taskDeleteDir('dist/globee-opencart-2.2.0')
            ->run();
        $this->taskDeleteDir('dist/globee-opencart-2.1.0')
            ->run();
    }
}
