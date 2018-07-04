<?php

class ModelExtensionPaymentGlobee extends Model
{
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