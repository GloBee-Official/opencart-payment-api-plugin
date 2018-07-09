<?php

/** Used by OC 2.1 */
class ModelPaymentGlobee extends ModelExtensionPaymentGlobee {}

/**
 * Class ModelExtensionPaymentGlobee
 */
class ModelExtensionPaymentGlobee extends Model
{
    /** @var string  */
    protected $languagePath = 'extension/payment/globee';

    public function __construct($registry)
    {
        parent::__construct($registry);

        if (true === version_compare(VERSION, '2.3.0', '<')) {
            $this->languagePath = 'payment/globee';
        }

        $this->load->language($this->languagePath);
    }

    public function getMethod()
    {
        $this->load->language('extension/payment/globee');

        return array(
            'code' => 'globee',
            'title' => $this->language->get('text_title'),
            'terms' => '',
            'sort_order' => $this->config->get('payment_globee_sort_order')
        );
    }
}