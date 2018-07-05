<?php

require __DIR__.'/../../../../system/library/globee/autoload.php';

use GloBee\PaymentApi\Connectors\GloBeeCurlConnector;
use GloBee\PaymentApi\Models\PaymentRequest;
use GloBee\PaymentApi\PaymentApi;

class ControllerExtensionPaymentGloBee extends Controller
{
    public function __construct($registry)
    {
        parent::__construct($registry);
    }

    public function index()
    {
        $this->load->language('extension/payment/globee');

        $data['testnet'] = ($this->config->get('payment_globee_livenet') == 0) ? true : false;
        $data['text_title'] = $this->language->get('text_title');
        $data['warning_testnet'] = $this->language->get('warning_testnet');
        $data['url_redirect'] = $this->url->link('extension/payment/globee/confirm', $this->config->get('config_secure'));
        $data['button_confirm'] = $this->language->get('button_confirm');

        if (file_exists(DIR_TEMPLATE.$this->config->get('config_template').'/template/extension/payment/globee')) {
            return $this->load->view($this->config->get('config_template').'/template/extension/payment/globee', $data);
        }
        return $this->load->view('extension/payment/globee', $data);
    }

    /**
     * Confirmation handler that creates payment request and redirects user to GloBee
     */
    public function confirm()
    {
        $this->load->model('checkout/order');

        if (!isset($this->session->data['order_id'])) {
            $this->response->redirect($this->url->link('checkout/cart'));

            return;
        }

        $order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);
        if (false === $order_info) {
            $this->response->redirect($this->url->link('checkout/cart'));

            return;
        }

        $connector = new GloBeeCurlConnector($this->config->get('payment_globee_payment_api_key'), $this->config->get('payment_globee_livenet'));
        $paymentApi = new PaymentApi($connector);

        $paymentRequest = new PaymentRequest();
        $paymentRequest->total = $order_info['total'];
        $paymentRequest->customerName = trim($order_info['firstname'].' '.$order_info['lastname']);
        $paymentRequest->customerEmail = $order_info['email'];
        $paymentRequest->confirmationSpeed = $this->config->get('payment_globee_risk_speed');
        $paymentRequest->successUrl = $this->config->get('payment_globee_redirect_url');
        $paymentRequest->ipnUrl = $this->config->get('payment_globee_notification_url');
        $paymentRequest->cancelUrl = $this->url->link('checkout/cart', $this->config->get('config_secure'));
        $paymentRequest->currency = $order_info['currency_code'];
        $paymentRequest->customPaymentId = $this->session->data['order_id'];

        $response = $paymentApi->createPaymentRequest($paymentRequest);

        $this->session->data['globee_invoice_id'] = $response->id;

        $this->response->redirect($response->redirectUrl);
    }

    /**
     * Redirect handler after successful payment
     */
    public function success()
    {
        $this->load->language('extension/payment/globee');
        $this->load->model('checkout/order');

        $order_id = $this->session->data['order_id'];
        if (is_null($order_id)) {
            $this->response->redirect($this->url->link('checkout/success'));

            return;
        }

        $order = $this->model_checkout_order->getOrder($order_id);
        try {
            $connector = new GloBeeCurlConnector($this->config->get('payment_globee_payment_api_key'), $this->config->get('payment_globee_livenet'));
            $paymentApi = new PaymentApi($connector);
            $paymentRequest = $paymentApi->getPaymentRequest($this->session->data['globee_invoice_id']);
        } catch (Exception $e) {
            $this->response->redirect($this->url->link('checkout/success'));

            return;
        }

        $order_status_id = null;

        switch ($paymentRequest->status) {
            case 'paid':
                $order_status_id = $this->config->get('payment_globee_paid_status');
                break;
            case 'confirmed':
                $order_status_id = $this->config->get('payment_globee_confirmed_status');
                break;
            case 'complete':
                $order_status_id = $this->config->get('payment_globee_completed_status');
                break;
            default:
                $this->response->redirect($this->url->link('checkout/checkout'));

                return;
        }

        $this->model_checkout_order->addOrderHistory($order_id, $order_status_id);
        $this->session->data['globee_invoice_id'] = null;
        $this->response->redirect($this->url->link('checkout/success'));
    }

    /**
     * The IPN Handler
     */
    public function callback()
    {
        $this->load->model('checkout/order');

        $post = file_get_contents("php://input");
        if (empty($post)) {
            $this->log('IPN handler called with no data');

            return;
        }
        $json = @json_decode($post, true);
        if (empty($json)) {
            $this->log('IPN handler called with invalid data: '.$post);

            return;
        }

        if (!array_key_exists('id', $json)) {
            $this->log('IPN handler called with missing ID: '.$post);

            return;
        }

        $connector = new GloBeeCurlConnector($this->config->get('payment_globee_payment_api_key'), $this->config->get('payment_globee_livenet'));
        $paymentApi = new PaymentApi($connector);
        $paymentRequest = $paymentApi->getPaymentRequest($json['id']);
        $order_status_id = null;

        switch ($paymentRequest->status) {
            case 'paid':
                $this->log('Marking order as paid for Payment Request with GloBee ID: '.$json['id']);
                $order_status_id = $this->config->get('payment_globee_paid_status');
                break;
            case 'confirmed':
                $this->log('Marking order as confirmed for Payment Request with GloBee ID: '.$json['id']);
                $order_status_id = $this->config->get('payment_globee_confirmed_status');
                break;
            case 'complete':
                $this->log('Marking order as completed for Payment Request with GloBee ID: '.$json['id']);
                $order_status_id = $this->config->get('payment_globee_completed_status');
                break;
            default:
                return;
        }

        $this->model_checkout_order->addOrderHistory($paymentRequest->customPaymentId, $order_status_id);
    }

    /**
     * Logger function for debugging
     *
     * @param $message
     */
    public function log($message)
    {
        if ($this->config->get('payment_globee_logging') != true) {
            return;
        }
        $log = new Log('globee.log');
        $log->write($message);
    }

}
