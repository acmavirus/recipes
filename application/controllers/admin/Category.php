<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category extends Admin_Controller
{
    public $_category;
    public $_pagination;
    public $_database;
    public $_page;
    public $_keyShow;
    public $_keyData;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Category_model');
        $this->load->model('Pagination_model');
        $this->_category = new Category_model();
        $this->_pagination = new Pagination_model();
        $this->_database = 'category';
        $this->_page = 'category';
        $this->_keyShow = ['id', 'title', 'slug'];
        $fields = $this->db->field_data($this->_database);
        $fields = $this->array_group_by($fields, function ($a) {
            return $a->name;
        });
        $this->_keyData = array_keys($fields);
    }

    public function index($page = 1)
    {
        $data = [];
        $limit_per_page = 10;

        // ==>> START CODE <<== //
        $data['listview'] = $listview = $this->_category->getDataByLM($this->_database, [], $limit_per_page, $page);
        $data['listkey'] = $this->_keyData;
        $data['listkeyShow'] = $this->_keyShow;
        // init params
        $params = array();
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
        $data["pagination"] = $this->pagination->create_links();
        // ==>> END CODE <<== //
        $data['main'] = $this->load->view("$this->template_admin/$this->_page/index", $data, true);
        $this->__loadadminview('admin/dashboard', $data);
    }

    public function add()
    {
        if (!empty($this->input->post())) {
            $data = (object) $this->input->post();
            // check 
            $config = array(
                array(
                    'field' => 'title',
                    'label' => 'Title',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'You must provide a %s.',
                    )
                ),
                array(
                    'field' => 'description',
                    'label' => 'Description',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'You must provide a %s.',
                    )
                ),
                array(
                    'field' => 'slug',
                    'label' => 'Slug',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'You must provide a %s.',
                    )
                ),
                // array(
                //     'field' => 'type',
                //     'label' => 'Type',
                //     'rules' => 'required',
                //     'errors' => array(
                //         'required' => 'You must provide a %s.',
                //     )
                // ),
                array(
                    'field' => 'meta_title',
                    'label' => 'Meta_title',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'You must provide a %s.',
                    )
                ),
                array(
                    'field' => 'meta_description',
                    'label' => 'Meta_description',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'You must provide a %s.',
                    )
                ),
                array(
                    'field' => 'meta_keywords',
                    'label' => 'Meta_keywords',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'You must provide a %s.',
                    )
                )
            );

            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == FALSE) {
                return $this->returnJson($this->returnReponsive("error", 300, "Error rules", $this->form_validation->error_array()));
            } else {
                $page = $data->page;
                unset($data->page);
                $this->_category->insert($data);
                return $this->returnJson($this->returnReponsive("success", 200, "Insert done", ['page' => $page]));
            }
        }
    }

    public function edit()
    {
        if (!empty($this->input->post())) {
            $data = (object) $this->input->post();
            $config = array(
                array(
                    'field' => 'title',
                    'label' => 'Title',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'You must provide a %s.',
                    )
                ),
                array(
                    'field' => 'description',
                    'label' => 'Description',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'You must provide a %s.',
                    )
                ),
                array(
                    'field' => 'slug',
                    'label' => 'Slug',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'You must provide a %s.',
                    )
                ),
                // array(
                //     'field' => 'type',
                //     'label' => 'Type',
                //     'rules' => 'required',
                //     'errors' => array(
                //         'required' => 'You must provide a %s.',
                //     )
                // ),
                array(
                    'field' => 'meta_title',
                    'label' => 'Meta_title',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'You must provide a %s.',
                    )
                ),
                array(
                    'field' => 'meta_description',
                    'label' => 'Meta_description',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'You must provide a %s.',
                    )
                ),
                array(
                    'field' => 'meta_keywords',
                    'label' => 'Meta_keywords',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'You must provide a %s.',
                    )
                )
            );

            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == FALSE) {
                return $this->returnJson($this->returnReponsive("error", 300, "Error rules", $this->form_validation->error_array()));
            } else {
                $id = $data->id;
                $page = $data->page;
                unset($data->page);
                unset($data->id);
                $status = $this->_category->update(['id' => $id], $data);
                if ($status == -1) $this->returnJson($this->returnReponsive("error", 300, "Error rules", []));
                if ($status == 1) return $this->returnJson($this->returnReponsive("success", 200, "Insert done", ['page' => $page]));
            }
        }
    }

    public function delete()
    {
        $id = $this->input->post();
        $status = $this->_category->delete(['id' => $id['id']]);
        if ($status == -1) $this->returnJson($this->returnReponsive("error", 300, "Error rules", []));
        if ($status == 1) return $this->returnJson($this->returnReponsive("success", 200, "delete done", []));
    }

    public function getRow()
    {
        $id = $this->input->post();
        if ($id) {
            $del = $this->_category->getDataBy($this->_database, $id);
            return $this->returnJson($del);
        }
    }

    private function returnReponsive($status, $code = 200, $message, $data = null)
    {
        return (object)[
            'status'    => $status,
            'code'      => $code,
            'message'   => $message,
            'data'      => $data
        ];
    }
}
