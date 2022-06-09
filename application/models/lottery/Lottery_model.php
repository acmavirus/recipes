<?php

class Lottery_model extends CI_Model
{
    protected $_category__table;
    protected $_category__keno;
    protected $_category__result;

    function __construct()
    {
        parent::__construct();
        // define primary table
        $this->_category__table = 'lottery_category';
        $this->_category__keno = 'lottery_keno';
        $this->_category__result = 'lottery_result';
    }
    // ================================ CATEGORY
    public function getById($category_id, $select = "*")
    {
        $this->db->select($select);
        $this->db->where('id', $category_id);
        $query = $this->db->get($this->_category__table);
        return $query->result_array();
    }
    // ================================ KENO

    // ================================ RESULT
    public function getByMonth($category_id, $year, $month, $select = "*")
    {
        $this->db->select($select);
        $this->db->where('category_id', $category_id);
        $this->db->where('displayed_time >=', "$year-$month-01");
        $this->db->where('displayed_time <=', date("Y-m-t", strtotime("$year-$month-15")));
        $query = $this->db->get($this->_category__result);
        return $query->result_array();
    }
    public function getByYear($category_id, $year, $select = "*")
    {
        $this->db->select($select);
        $this->db->where('category_id', $category_id);
        $this->db->where('displayed_time >=', "$year-01-01");
        $this->db->where('displayed_time <=', "$year-12-31");
        $query = $this->db->get($this->_category__result);
        return $query->result_array();
    }
    // ================================= FUNCTION
    public function returnData($category_id, $data)
    {
        $category = $this->getById($category_id, 'code');
        foreach ($data as $key => $value) {
            $data[$key] = array_merge((array) $category[0], (array) $value);
            if (!empty($data[$key]['weekday'])) $data[$key]['weekday'] = json_decode($data[$key]['weekday']);
            $data_result = json_decode($data[$key]['data_result']);
            $data[$key]['data_result'] = $data_result;
            unset($data[$key]['id']);
            unset($data[$key]['category_id']);
            $data[$key]['data_result_db'] = [];
            $data[$key]['data_result_2s'] = [];
            foreach ($data_result as $keyDR1 => $item) {
                foreach ($item as $keyDR2 => $item2) {
                    if ($keyDR1 == 0) {
                        $data[$key]['data_result_db'][] = $item2;
                    };
                    if ($keyDR1 >  0) {
                        $data[$key]['data_result_2s'][] = substr($item2, -2, 2);
                    };
                };
            };
            $data[$key]['data_result_head'] = [];
            foreach ($data_result as $keyDR1 => $item) {
                foreach ($item as $keyDR2 => $item2) {
                    if ($keyDR1 > 0) {
                        $data[$key]['data_result_head'][] = substr($item2, -2, 1);
                    };
                };
            };
            $data[$key]['data_result_tail'] = [];
            foreach ($data_result as $keyDR1 => $item) {
                foreach ($item as $keyDR2 => $item2) {
                    if ($keyDR1 > 0) {
                        $data[$key]['data_result_tail'][] = substr($item2, -1, 1);
                    };
                };
            };
        };
        return $data;
    }
}
