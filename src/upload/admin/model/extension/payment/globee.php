<?php

class ModelExtensionPaymentGlobee extends Model
{
    public function install()
    {
        $this->db->query("INSERT INTO `" . DB_PREFIX . "setting` (`store_id`,`code`,`key`,`value`,`serialized`) VALUES ('0','payment_globee','payment_globee_status','0','0');");
        $this->db->query("INSERT INTO `" . DB_PREFIX . "setting` (`store_id`,`code`,`key`,`value`,`serialized`) VALUES ('0','payment_globee','payment_globee_sort_order','1','0');");
        $this->db->query("INSERT INTO `" . DB_PREFIX . "setting` (`store_id`,`code`,`key`,`value`,`serialized`) VALUES ('0','payment_globee','payment_globee_livenet','1','0');");
        $this->db->query("INSERT INTO `" . DB_PREFIX . "setting` (`store_id`,`code`,`key`,`value`,`serialized`) VALUES ('0','payment_globee','payment_globee_payment_api_key','','0');");
        $this->db->query("INSERT INTO `" . DB_PREFIX . "setting` (`store_id`,`code`,`key`,`value`,`serialized`) VALUES ('0','payment_globee','payment_globee_risk_speed','medium','0');");
        $this->db->query("INSERT INTO `" . DB_PREFIX . "setting` (`store_id`,`code`,`key`,`value`,`serialized`) VALUES ('0','payment_globee','payment_globee_paid_status',2,'0');");
        $this->db->query("INSERT INTO `" . DB_PREFIX . "setting` (`store_id`,`code`,`key`,`value`,`serialized`) VALUES ('0','payment_globee','payment_globee_confirmed_status',2,'0');");
        $this->db->query("INSERT INTO `" . DB_PREFIX . "setting` (`store_id`,`code`,`key`,`value`,`serialized`) VALUES ('0','payment_globee','payment_globee_completed_status',5,'0');");
        $this->db->query("INSERT INTO `" . DB_PREFIX . "setting` (`store_id`,`code`,`key`,`value`,`serialized`) VALUES ('0','payment_globee','payment_globee_notification_url','".$this->url->link('extension/payment/globee/callback', $this->config->get('config_secure'))."','0');");
        $this->db->query("INSERT INTO `" . DB_PREFIX . "setting` (`store_id`,`code`,`key`,`value`,`serialized`) VALUES ('0','payment_globee','payment_globee_redirect_url','".$this->url->link('extension/payment/globee/success', $this->config->get('config_secure'))."','0');");
        $this->db->query("INSERT INTO `" . DB_PREFIX . "setting` (`store_id`,`code`,`key`,`value`,`serialized`) VALUES ('0','payment_globee','payment_globee_logging','1','0');");
    }

    public function uninstall()
    {
        $this->db->query("DELETE FROM `" . DB_PREFIX . "setting` WHERE key = 'payment_globee_status';");
        $this->db->query("DELETE FROM `" . DB_PREFIX . "setting` WHERE key = 'payment_globee_sort_order';");
        $this->db->query("DELETE FROM `" . DB_PREFIX . "setting` WHERE key = 'payment_globee_livenet';");
        $this->db->query("DELETE FROM `" . DB_PREFIX . "setting` WHERE key = 'payment_globee_payment_api_key';");
        $this->db->query("DELETE FROM `" . DB_PREFIX . "setting` WHERE key = 'payment_globee_risk_speed';");
        $this->db->query("DELETE FROM `" . DB_PREFIX . "setting` WHERE key = 'payment_globee_confirmed_status';");
        $this->db->query("DELETE FROM `" . DB_PREFIX . "setting` WHERE key = 'payment_globee_completed_status';");
        $this->db->query("DELETE FROM `" . DB_PREFIX . "setting` WHERE key = 'payment_globee_notification_url';");
        $this->db->query("DELETE FROM `" . DB_PREFIX . "setting` WHERE key = 'payment_globee_redirect_url';");
        $this->db->query("DELETE FROM `" . DB_PREFIX . "setting` WHERE key = 'payment_globee_logging';");
    }
}