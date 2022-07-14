<?php

defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('main_menu')) {
    function main_menu()
    {
        // config
        $html = '';
        // database
        $ci = &get_instance();
        // Get data from db
        $ci->db->select("*");
        $ci->db->where(["parent_id" => 0]);
        $ci->db->where(["group_id" => 1]);
        $ci->db->order_by('position', 'ASC');
        $query = $ci->db->get('admin_menu');
        $listItem = $query->result_array();
        // match
        if (!empty($listItem)) foreach ($listItem as $key => $value) {
            // Get data from db
            $ci->db->select("*");
            $ci->db->where(["parent_id" => $value['id']]);
            $query = $ci->db->get('admin_menu');
            // match
            if (count($query->result_array()) > 0) {
                $listItem[$key]['child'] = $query->result_array();
                $html .= '<li class="has-children"> <a href="javascript:void(0)" class="waves-effect waves-dark"> <span class="pcoded-micon"><i class="feather icon-film"></i></span> <span class="pcoded-mtext">';
                $html .= $value['title'] . '</span></a>';
                $html .= '<ul class="submenu overflow-auto" style="height: 200px;">';
                if (count($query->result_array()) > 0) foreach ($query->result_array() as $k => $v) {
                    $html .= general_main_menu_noChild($v);
                };
                $html .= '</ul></li>';
            } else {
                $html .= general_main_menu_noChild($value);
            };
        }
        echo $html;
    }

    function general_main_menu_noChild($item)
    {
        $root_noChild = '<li class="nav-item">
        <a href="' . base_url($item['url']) . '" class="nav-link text-decoration-none">' . $item['icon'] . ' ';
        $root_noChilde = '</a></li>';
        $html = $root_noChild;
        $html .= $item['title'];
        $html .= $root_noChilde;
        return $html;
    }
}

if (!function_exists('foot_menu')) {
    function foot_menu()
    {
        // config
        $html = '';
        // database
        $ci = &get_instance();
        // Get data from db
        $ci->db->select("*");
        $ci->db->where(["parent_id" => 0]);
        $ci->db->where(["group_id" => 13]);
        $ci->db->order_by('position', 'ASC');
        $query = $ci->db->get('admin_menu');
        $listItem = $query->result_array();
        // match
        if (!empty($listItem)) foreach ($listItem as $key => $value) {
            // Get data from db
            $ci->db->select("*");
            $ci->db->where(["parent_id" => $value['id']]);
            $query = $ci->db->get('admin_menu');
            // match
            if (count($query->result_array()) > 0) {
                $listItem[$key]['child'] = $query->result_array();
                $html .= '<li class="pcoded-hasmenu"> <a href="javascript:void(0)" class="waves-effect waves-dark"> <span class="pcoded-micon"><i class="feather icon-film"></i></span> <span class="pcoded-mtext">';
                $html .= $value['title'] . '</span></a>';
                $html .= '<ul class="pcoded-submenu">';
                if (count($query->result_array()) > 0) foreach ($query->result_array() as $k => $v) {
                    $html .= general_foot_menu_noChild($v);
                };
                $html .= '</ul></li>';
            } else {
                $html .= general_foot_menu_noChild($value);
            };
        }
        echo $html;
    }

    function general_foot_menu_noChild($item)
    {
        $root_noChild = '<li class="nav-item">
        <a href="' . base_url($item['url']) . '" class="nav-link text-decoration-none">' . $item['icon'] . ' ';
        $root_noChilde = '</a></li>';
        $html = $root_noChild;
        $html .= $item['title'];
        $html .= $root_noChilde;
        return $html;
    }
}
