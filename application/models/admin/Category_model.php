<?php

class Category_model extends MY_Model
{
    private $_db;
    private $_db_group;
    function __construct()
    {
        parent::__construct();

        // define primary table
        $this->_db = 'category';
        $this->_db_group = '';
    }
}