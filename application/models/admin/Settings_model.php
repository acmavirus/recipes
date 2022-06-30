<?php

class Settings_model extends ADMIN_Model
{
    protected $_table;
    function __construct()
    {
        parent::__construct();
        // define primary table
        $this->_table = 'admin_settings';
    }

    public function getAll() {
        $cache = "$this->_table-getAll";
        $data = $this->getCache($cache);
        if (empty($data)) {
            $this->db->select('*');
            $this->db->order_by('id', "ASC");
            $query = $this->db->get($this->_table);
            $data = $query->result_array();
            $this->setCache($cache, $data, 100);
        };
        return $data;
    }
}