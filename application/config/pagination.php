<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    $config['num_links'] = 3;
    $config['enable_query_strings'] = TRUE;
    $config['use_page_numbers'] = TRUE;
    /*SET PARAM PAGE*/
    $config['page_query_string'] = FALSE;
    $config['query_string_segment'] = 'page';
    /*SET PARAM PAGE*/
    $config['reuse_query_string'] = false;

    $config['full_tag_open'] = '<ul class="pagination justify-content-center pagination-rounded mb-4">';
    $config['full_tag_close'] = '</ul><br/>';
    $config['first_tag_open'] = '<li class="page-item">';
    $config['first_tag_close'] = '</li>';
    $config['next_tag_open'] = '<li class="page-item next">';
    $config['next_tag_close'] = '';
    $config['prev_tag_open'] = '<li class="page-item pre">';
    $config['prev_tag_close'] = '';
    $config['cur_tag_open'] = '<li class="page-item active"><a href="" class="page-link">';
    $config['cur_tag_close'] = '</a>';
    $config['num_tag_open'] = '<li class="page-item">';
    $config['num_tag_close'] = '</li>';
    $config['last_tag_open'] = '<li class="page-item">';
    $config['last_tag_close'] = '</li>';
    $config['attributes'] = array('class' => 'page-link');
    $config['first_link'] = '&laquo;';
    $config['last_link'] = '&raquo;';
    $config['prev_link'] = '<span aria-hidden="true">&lsaquo;</span>';
    $config['next_link'] = '<span aria-hidden="true">&rsaquo;</span>';
    $config['display_pages'] = true;