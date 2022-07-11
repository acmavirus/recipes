<?php

class Post_cardriving_model extends PUBLIC_Model
{

    function __construct()
    {
        parent::__construct();
        $this->_table = 'post_cardriving';
    }

    public function all()
    {
        $this->db->select('1');
        $this->db->from($this->_table);
        return $this->db->count_all_results();
    }
}
