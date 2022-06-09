<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Page extends Admin_Controller
{
    public $_modelpage;
    public $_pagination;
    public $_database;
    public $_page;
    public $_keyShow;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Page_model');
        $this->load->model('Pagination_model');
        $this->_modelpage = new Page_model();
        $this->_pagination = new Pagination_model();
        $this->_database = 'page';
        $this->_page = 'page';
        $this->_keyShow = ['id', 'parent_id', 'title', 'slug'];
    }

    private function __loadTable($page=0)
    {
        $data = [
            'pagination' => $this->__pagination($page),
            'listkeyShow' => $this->_keyShow
        ];
        $data['listview'] = $listview = $this->_modelpage->getDataByLM($this->_database, [], 10, $page);
        $fields = $this->db->field_data($this->_database);
        $fields = $this->array_group_by($fields, function ($a) {
            return $a->name;
        });
        $data['listkey'] = array_keys($fields);
        return $this->load->view("$this->template_admin/$this->_page/_table", $data, true);
    }

    private function __pagination($page=0)
    {
        // init params
        $params = array();
        $limit_per_page = 10;
        $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : $page;
        $total_records = $this->_pagination->get_total($this->_database);
        $config['base_url'] = '#';
        $config['total_rows'] = $total_records;
        $config['cur_page'] = $page;
        $config['per_page'] = $limit_per_page;
        $config["uri_segment"] = 3;
        $this->pagination->initialize($config);
        // build paging links
        $_GET['page'] = $page;
        $params["links"] = $this->pagination->create_links();
        return $params;
    }

    public function index()
    {
        $data = array_merge([
            'breadcrumb' => $this->__breadcrumb(),
            'pagination' => $this->__pagination(),
            'page' => $this->_page,
            'listkeyShow' => $this->_keyShow
        ], $this->___root());
        
        // ==>> START CODE <<== //
        $data['listview'] = $listview = $this->_modelpage->getDataByLM($this->_database, [], 10, 1);
        $fields = $this->db->field_data($this->_database);
        $fields = $this->array_group_by($fields, function ($a) {
            return $a->name;
        });
        $data['listkey'] = array_keys($fields);
        // ==>> END CODE <<== //
        $data['main'] = $this->load->view("$this->template_admin/$this->_page/index", $data, true);
        $this->__loadadminview('admin/dashboard', $data);
    }

    public function add()
    {
        if (!empty($this->input->post())) {
            $data = $this->input->post();
            $page = $data['page'];
            unset($data['page']);
            if(!empty($data['slug'])) $data['slug'] = $this->toSlug($data['slug']);
            if ($this->db->insert($this->_database, $data)) {
                echo $this->__loadTable($page);
            }
        }
    }

    public function edit()
    {
        if (!empty($this->input->post())) {
            $data = $this->input->post();
            $id = $data['id'];
            $page = $data['page'];
            unset($data['id']);
            unset($data['page']);
            if ($this->_modelpage->updateData($this->_database, ['id' => $id], $data)) {
                echo $this->__loadTable($page);
            }
        }
    }

    public function delete()
    {
        $id = $this->input->post();
        if ($id) {
            $del = $this->_modelpage->deleteDataBy($this->_database, ['id'=>$id['id']]);
            $del2 = $this->_modelpage->deleteDataBy('post_datacrawler', ['post_id'=>$id['id']]);
            echo $this->__loadTable($id['page']);
        }
    }

    public function getRow()
    {
        $id = $this->input->post();
        if ($id) {
            $del = $this->_modelpage->getDataBy($this->_database, $id);
            return $this->returnJson($del);
        }
    }

    public function loadPagination()
    {
        $page = $this->input->post('page');
        if ($page) {
            echo $this->__loadTable($page);
        }
    }
}
