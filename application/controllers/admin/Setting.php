<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setting extends Admin_Controller
{
    public $_settings;
    public $_database;
    public $_page;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Settings_model');
        $this->_settings = new Settings_model();
        $this->_database = 'admin_settings';
        $this->_page = 'settings';
    }

    public function index()
    {
        $dataRaw = $this->input->post();
        if (!empty($dataRaw)) {
            $type = $dataRaw['type'];
            unset($dataRaw['type']);
            $content = json_encode($dataRaw);
            $this->_settings->update(['type'=> $type], ['content'=> $content]);
            redirect(base_url("admin/setting"));
        }
        // ==>> START CODE <<== //
        $data['site'] = $this->_settings->getByField('type', 'site');
        $data['link301'] = $this->_settings->getByField('type', 'link301');
        $data['social'] = $this->_settings->getByField('type', 'social');
        $data['email'] = $this->_settings->getByField('type', 'email');
        // ==>> END CODE <<== //
        
        $data['main'] = $this->load->view("$this->template_admin/$this->_page/index", $data, true);
        $this->__loadadminview('admin/dashboard', $data);
    }
}
