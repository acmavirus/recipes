<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Filemanage extends Admin_Controller
{
    public $common_model;
    public $users_model;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/common_model');
        $this->load->model('admin/users_model');
        $this->common_model = new common_model();
        $this->users_model = new users_model();
    }

    function index()
    {
        $data = [];
        // ==>> END CODE <<== //
        $data['main'] = $this->load->view("$this->template_admin/filemanage/index", $data, true);
        $this->__loadadminview('admin/dashboard', $data);
    }
}
