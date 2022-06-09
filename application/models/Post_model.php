<?php

class Post_model extends PUBLIC_Model
{

    function __construct()
    {
        parent::__construct();
        $this->_table = 'post';
    }
}
