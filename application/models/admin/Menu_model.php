<?php

class Menu_model extends ADMIN_Model
{
    private $_db;
    private $_db_group;
    function __construct()
    {
        parent::__construct();

        // define primary table
        $this->_db = 'admin_menu';
        $this->_db_group = 'admin_menu_group';
    }

    public function get_menu($group_id)
    {
        $this->db->select('*');
        $this->db->from($this->_db);
        $this->db->where('group_id', $group_id);
        $this->db->order_by('position', 'ASC');
        $query = $this->db->get();
        $res = $query->result();
        if ($res) {
            return $res;
        } else {
            return false;
        }
    }

    public function get_cmenu($parent_id, $group_id)
    {
        $this->db->select('*');
        $this->db->from($this->_db);
        $this->db->where('group_id', $group_id);
        $this->db->where('parent_id', $parent_id);
        $this->db->order_by('position', 'ASC');
        $query = $this->db->get();
        $res = $query->result();
        if ($res) {
            return $res;
        } else {
            return false;
        }
    }

    /**
     * Get group title
     *
     * @param int $group_id
     * @return string
     */
    public function get_menu_group_title($group_id)
    {
        $this->db->select('*');
        $this->db->from($this->_db_group);
        $this->db->where('id', $group_id);
        $query = $this->db->get();
        return $query->row();
    }

    /**
     * Get all items in menu group table
     *
     * @return array
     */
    public function get_menu_groups()
    {
        $this->db->select('*');
        $this->db->from($this->_db_group);
        $query = $this->db->get();
        return $query->result();
    }

    public function add_menu_group($data)
    {
        if ($this->db->insert($this->_db_group, $data)) {
            $response['status'] = 1;
            $response['id'] = $this->db->Insert_ID();
            return $response;
        } else {
            $response['status'] = 2;
            $response['msg'] = 'Add group error.';
            return $response;
        }
    }

    public function get_row($id)
    {
        $this->db->select('*');
        $this->db->from($this->_db);
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    /**
     * Get the highest position number
     *
     * @param int $group_id
     * @return string
     */
    public function get_last_position($group_id)
    {
        $pos = null;
        $this->db->select_max('position');
        $this->db->from($this->_db);
        $this->db->where('group_id', $group_id);
        $this->db->where('parent_id', '0');
        $query = $this->db->get();
        $data = $query->row();
        $pos = $data->position + 1;
        return $pos;
    }

    /**
     * Recursive method
     * Get all descendant ids from current id
     * save to $this->ids
     *
     * @param int $id
     */
    public function get_descendants($id)
    {
        $this->db->select('id');
        $this->db->from($this->_db);
        $this->db->where('parent_id', $id);
        $query = $this->db->get();
        $data = $query->row();

        $ids = null;
        if (!empty($data)) {
            foreach ($data as $v) {
                $ids[] = $v;
                $this->get_descendants($v);
            }
        }
    }

    //Delete the menu
    public function delete_menu($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->_db);
    }

    //Update MenuController Group
    public function update_menu_group($data, $id)
    {
        if ($this->db->update($this->_db_group, $data, 'id' . ' = ' . $id)) {
            return true;
        }
    }

    //Delete MenuController Group
    public function delete_menu_group($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->_db_group);
    }

    public function delete_menus($id)
    {
        $this->db->where('group_id', $id);
        return $this->db->delete($this->_db);
    }
}
