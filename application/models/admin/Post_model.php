<?php

class Post_model extends ADMIN_Model
{
    private $_db;
    private $_db_group;
    function __construct()
    {
        parent::__construct();

        // define primary table
        $this->_db = 'posts';
        $this->_db_group = '';
    }
}