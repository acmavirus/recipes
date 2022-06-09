<?php

class Page_model extends MY_Model
{
    private $_db;
    private $_db_group;
    function __construct()
    {
        parent::__construct();

        // define primary table
        $this->_db = 'page';
        $this->_db_group = '';
    }
}