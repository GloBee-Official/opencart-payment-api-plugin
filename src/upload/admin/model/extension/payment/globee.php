<?php

class ModelExtensionPaymentGlobee extends Model
{
    /** @var string  */
    protected $code = 'payment_globee';

    /**
     * Install script for database settings
     */
    public function install()
    {
        if (true === version_compare(VERSION, '3.0.0', '<')) {
            $this->code = 'globee';
        }

        $this->db->query("INSERT INTO `" . DB_PREFIX . "setting` (`store_id`,`code`,`key`,`value`,`serialized`) VALUES ('0','".$this->code."','".$this->code."_status','0','0');");
        $this->db->query("INSERT INTO `" . DB_PREFIX . "setting` (`store_id`,`code`,`key`,`value`,`serialized`) VALUES ('0','".$this->code."','".$this->code."_sort_order','1','0');");
        $this->db->query("INSERT INTO `" . DB_PREFIX . "setting` (`store_id`,`code`,`key`,`value`,`serialized`) VALUES ('0','".$this->code."','".$this->code."_livenet','1','0');");
        $this->db->query("INSERT INTO `" . DB_PREFIX . "setting` (`store_id`,`code`,`key`,`value`,`serialized`) VALUES ('0','".$this->code."','".$this->code."_payment_api_key','','0');");
        $this->db->query("INSERT INTO `" . DB_PREFIX . "setting` (`store_id`,`code`,`key`,`value`,`serialized`) VALUES ('0','".$this->code."','".$this->code."_risk_speed','medium','0');");
        $this->db->query("INSERT INTO `" . DB_PREFIX . "setting` (`store_id`,`code`,`key`,`value`,`serialized`) VALUES ('0','".$this->code."','".$this->code."_paid_status',2,'0');");
        $this->db->query("INSERT INTO `" . DB_PREFIX . "setting` (`store_id`,`code`,`key`,`value`,`serialized`) VALUES ('0','".$this->code."','".$this->code."_confirmed_status',15,'0');");
        $this->db->query("INSERT INTO `" . DB_PREFIX . "setting` (`store_id`,`code`,`key`,`value`,`serialized`) VALUES ('0','".$this->code."','".$this->code."_completed_status',5,'0');");
        $this->db->query("INSERT INTO `" . DB_PREFIX . "setting` (`store_id`,`code`,`key`,`value`,`serialized`) VALUES ('0','".$this->code."','".$this->code."_notification_url','".str_replace("admin/", "", $this->url->link('extension/payment/globee/callback', $this->config->get('config_secure')))."','0');");
        $this->db->query("INSERT INTO `" . DB_PREFIX . "setting` (`store_id`,`code`,`key`,`value`,`serialized`) VALUES ('0','".$this->code."','".$this->code."_redirect_url','".str_replace("admin/", "", $this->url->link('extension/payment/globee/success', $this->config->get('config_secure')))."','0');");
        $this->db->query("INSERT INTO `" . DB_PREFIX . "setting` (`store_id`,`code`,`key`,`value`,`serialized`) VALUES ('0','".$this->code."','".$this->code."_logging','1','0');");
        $this->db->query("INSERT INTO `" . DB_PREFIX . "setting` (`store_id`,`code`,`key`,`value`,`serialized`) VALUES ('0','".$this->code."','".$this->code."_geo_zone_id','0','0');");
    }

    /**
     * Uninstall script for database settings
     */
    public function uninstall()
    {
        if (true === version_compare(VERSION, '3.0.0', '<')) {
            $this->code = 'globee';
        }

        $this->load->model('setting/setting');
        $this->model_setting_setting->deleteSetting($this->code);
    }
}