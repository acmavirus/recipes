<?php

class Page_model extends PUBLIC_Model
{
    protected $_table;
    function __construct()
    {
        parent::__construct();
        // define primary table
        $this->_table = 'page';
    }
}