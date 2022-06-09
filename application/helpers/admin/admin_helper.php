<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


// -----------------------------------------------------------------------------
//leftMenu
if (!function_exists('leftMenu')) {
    function leftMenu()
    {
        // Get a reference to the controller object
        $ci = &get_instance();
        $ci->load->model('admin/menu_model');
        $ci->menu = new menu_model();
        // 
        $menu = $ci->menu->get_menu(1);
        $parent['menu'] = [];
        foreach ($menu as $key => $item) {
            if ($item->parent_id == 0) {
                $child_menu = $ci->menu->get_cmenu($item->id, 1);
                if (!empty($child_menu)) foreach ($child_menu as $pkey => $pitem) {
                    $pchild_menu = $ci->menu->get_cmenu($pitem->id, 1);
                    if (!empty($pchild_menu)) $child_menu[$pkey]->child = $pchild_menu;
                };
                if (!empty($child_menu)) $item->child = $child_menu;
                $parent['menu'][] = $item;
            }
        };
        $view = $ci->load->view('admin/_leftMenu', $parent, true);
        return $view;
    }
};

// -----------------------------------------------------------------------------
//myUsers
if (!function_exists('myUsers')) {
    function myUsers()
    {
        // Get a reference to the controller object
        $ci = &get_instance();
        $ci->load->model('admin/menu_model');
        $ci->menu = new menu_model();
        // 
        $data['user'] = $ci->session->userdata('logged_in');
        $view = $ci->load->view('admin/_avatar', $data, true);
        return $view;
    }
};