<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends Admin_Controller
{
    public $_menu;
    public $_page;
    public $_category;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Category_model');
        $this->load->model('admin/menu_model');
        $this->_category = new Category_model();
        $this->_menu = new menu_model();
        $this->_page = 'menu';
    }

    private function __loadTable()
    {
        $data['menu_groups'] = $menu_groups = $this->_menu->get_menu_groups();
        $fields = $this->db->field_data('admin_menu_group');
        $fields = $this->array_group_by($fields, function ($a) {
            return $a->name;
        });
        $data['listkey'] = array_keys($fields);
        return $this->load->view("$this->template_admin/$this->_page/_table", $data, true);
    }

    public function index($group_id = 1)
    {
        $data = array_merge([
            'breadcrumb' => $this->__breadcrumb(),
            'page' => $this->_page
        ], $this->___root());
        // ==>> START CODE <<== //
        $menu = $this->_menu->get_menu($group_id);
        $data['listmenu'] = [];
        foreach ($menu as $key => $item) {
            if ($item->parent_id == 0) {
                $child_menu = $this->_menu->get_cmenu($item->id, 1);
                if (!empty($child_menu)) foreach ($child_menu as $pkey => $pitem) {
                    $pchild_menu = $this->_menu->get_cmenu($pitem->id, 1);
                    if (!empty($pchild_menu)) $child_menu[$pkey]->child = $pchild_menu;
                };
                if (!empty($child_menu)) $item->child = $child_menu;
                $data['listmenu'][] = $item;
            }
        };
        $data['group_id'] = $group_id;
        $data['group_title'] = $this->_menu->get_menu_group_title($group_id);
        $data['menu_groups'] = $this->_menu->get_menu_groups();
        $data['category'] = $this->_category->getData([
            'limit' => 1000
        ]);
        // ==>> END CODE <<== //
        $data['main'] = $this->load->view("$this->template_admin/$this->_page/index", $data, true);
        $this->__loadadminview('admin/dashboard', $data);
    }

    public function groupmanage()
    {
        $data = array_merge([
            'breadcrumb' => $this->__breadcrumb(),
            'page' => 'menu'
        ], $this->___root());
        // ==>> START CODE <<== //
        $data['menu_groups'] = $menu_groups = $this->_menu->get_menu_groups();
        $fields = $this->db->field_data('admin_menu_group');
        $fields = $this->array_group_by($fields, function ($a) {
            return $a->name;
        });
        $data['listkey'] = array_keys($fields);

        // ==>> END CODE <<== //
        $data['main'] = $this->load->view("$this->template_admin/$this->_page/manage", $data, true);
        $this->__loadadminview('admin/dashboard', $data);
    }

    // ==>> START ITEM FUNC <<== //

    public function add()
    {
        $title = $this->input->post('title');
        if ($title) {
            $data['title'] = $this->input->post('title');
            $data['icon'] = $this->input->post('icon');
            if (!empty($data['title'])) {
                $data['url'] = $this->input->post('url');
                //                $data['class'] = $this->input->post('class');
                $data['group_id'] = $this->input->post('group_id');
                if ($this->db->insert('admin_menu', $data)) {
                    $data['id'] = $this->db->Insert_ID();
                    $response['status'] = 1;
                    $li_id = 'menu-' . $data['id'];
                    $response['li'] = '<li id="' . $li_id . '" class="sortable">' . $this->get_labels($data) . '</li>';
                    $response['li_id'] = $li_id;
                } else {
                    $response['status'] = 2;
                    $response['msg'] = 'Add menu error.';
                }
            } else {
                $response['status'] = 3;
            }
            header('Content-type: application/json');
            echo json_encode($response);
        }
    }

    public function edit($id)
    {
        $data['row'] = $this->_menu->get_row($id);
        $data['menu_groups'] = $this->_menu->get_menu_groups();
        $this->load->view("$this->template_admin/menu/edit", $data);
    }

    public function save()
    {
        $title = $this->input->post('title');
        if ($title) {
            $data['title'] = trim($_POST['title']);
            if (!empty($data['title'])) {
                $data['id'] = $this->input->post('id');
                $data['url'] = $this->input->post('url');
                $data['icon'] = $this->input->post('icon');
                $this->db->update('admin_menu', $data, 'id' . ' = ' . $data['id']);
                header('Content-type: application/json');
                echo json_encode($data);
            }
        }
    }

    public function delete()
    {
        $id = $this->input->post('id');
        if ($id) {
            $this->_menu->get_descendants($id);
            if (!empty($this->ids)) {
                $ids = implode(', ', $this->ids);
                $id = "$id, $ids";
            }

            $res = $this->_menu->delete_menu($id);
            if ($res) {
                $response['success'] = true;
            } else {
                $response['success'] = false;
            }
            header('Content-type: application/json');
            echo json_encode($response);
        }
    }

    // ==>> END ITEM FUNC <<== //
    // ==>> START GROUP FUNC <<== //

    public function group_add()
    {
        if (isset($_POST['title'])) {
            $data['title'] = $this->input->post('title');
            if (!empty($data['title'])) {
                if ($this->db->insert('admin_menu_group', $data)) {
                    echo $this->__loadTable();
                }
            }
        }
    }

    public function group_edit()
    {
        $id = $this->input->post('id');
        $title = $this->input->post('title');
        if ($title) {
            $data['title'] = $title;
            $res = $this->_menu->update_menu_group($data, $id);
            if ($res) {
                echo $this->__loadTable();
            }
        }
    }

    public function group_delete()
    {
        $id = $this->input->post('id');
        if ($id) {
            if ($id == 1) {
                $response['success'] = false;
                $response['msg'] = 'Cannot delete Group ID = 1';
            } else {
                $delete = $this->_menu->delete_menu_group($id);
                if ($delete) {
                    $del = $this->_menu->delete_menus($id);
                    echo $this->__loadTable();
                }
            }
        }
    }
    // ==>> END GROUP FUNC <<== //

    public function save_position()
    {
        $menu = $this->input->post('menu');
        if (!empty($menu)) {
            //adodb_pr($menu);
            $menu = $this->input->post('menu');
            foreach ($menu as $k => $v) {
                if ($v == 'null') {
                    $menu2[0][] = $k;
                } else {
                    $menu2[$v][] = $k;
                }
            }
            $success = 0;
            if (!empty($menu2)) {
                foreach ($menu2 as $k => $v) {
                    $i = 1;
                    foreach ($v as $v2) {
                        $data['parent_id'] = $k;
                        $data['position'] = $i;
                        if ($this->db->update('admin_menu', $data, 'id' . ' = ' . $v2)) {
                            $success++;
                        }
                        $i++;
                    }
                }
            }
        }
    }
    // ==>> PRIVATE FUNC <<== //
    private function get_labels($row)
    {
        $label = '
        <div class="ns-row" style="background-color: #000;">
            <div class="ns-title ui-sortable-handle">' . $row['title'] . '</div>
            <div class="ns-url">' . $row['url'] . '</div>
            <input class="ns-icon d-none" value="' . htmlentities($row['icon']) . '</i>">
            <div class="actions">
            <a href="#" class="edit-menu" title="Edit" data-bs-toggle="modal" data-bs-target="#modalEditItem">
            <i class="mdi mdi-pencil"></i>
            </a>
            <a href="#" class="delete-menu" title="Delete" data-bs-toggle="modal" data-bs-target="#modalDeleteItem">
            <i class="mdi mdi-delete-empty"></i>
            </a><input type="hidden" name="menu_id" value="' . $row['id'] . '"></div></div>';
        return $label;
    }
}
