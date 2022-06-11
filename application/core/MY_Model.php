<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function session($type, $data)
    {
        switch ($type) {
            case 'set':
                $this->session->set_userdata($data);
                break;
            case 'remove':
                $this->session->unset_userdata($data);
                break;
        }
    }

    public function setCacheFile($timeOut = 1)
    {
        $this->output->cache($timeOut);
    }
    public function setCache($key, $data, $timeOut = 3600)
    {
        $this->cache->save($key, $data, $timeOut);
    }

    public function getCache($key)
    {
        return $this->cache->get($key);
    }

    public function deleteCache($key = null)
    {
        if (!empty($key)) {
            return $this->cache->delete($key);
        } else return $this->cache->clean();
    }

    public function update($db, $where, $data)
    {
        $this->db->where($where);
        $this->db->update($db, $data);
        return true;
    }

    function insert($data)
    {
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();
    }

    function delete($where)
    {
        $this->db->delete($this->_table, $where);
        return true;
    }
}

class PUBLIC_Model extends MY_Model
{
    public $_controller;
    public $_method;
    public $_dbprefix;
    public $table;

    public function __construct()
    {
        parent::__construct();

        $this->_dbprefix = $this->db->dbprefix;
        $this->_controller = $this->router->fetch_class();
        $this->_method = $this->router->fetch_method();
        $this->table = strtolower(str_replace('_model', '', get_Class($this)));
    }

    public function getByField($field, $value, $select = '*')
    {
        $this->db->select($select);
        $this->db->from($this->table);
        $this->db->where("$this->table.$field", $value);
        $query = $this->db->get()->row();
        return $query;
    }

    public function getAllByField($field, $value, $select = '*')
    {
        $this->db->select($select);
        $this->db->from($this->table);
        $this->db->where("$this->table.$field", $value);
        $query = $this->db->get()->result();
        return $query;
    }

    public function getData($args = array(), $returnType = "object")
    {
        $this->db->from($this->table);
        $this->_where($args);
        $query = $this->db->get();
        if ($returnType !== "object") return $query->result_array(); //Check kiểu data trả về
        else return $query->result();
    }

    private function _where($args = array(), $typeQuery = null)
    {
        $this->_where_before($args, $typeQuery);
        $this->_where_custom($args);
    }

    private function _where_before($args = array(), $typeQuery = false)
    {
        $page = 1;
        $limit = 10;
        extract($args);
        if ($typeQuery === 'count' && empty($search)) $this->db->select('1');

        if (isset($is_featured))
            $this->db->where("$this->table.is_featured", $is_featured);

        if (isset($is_status))
            $this->db->where("$this->table.is_status", $is_status);

        if (!empty($keyword))
            $this->db->like("$this->table.title", $keyword);

        if (!empty($search)) {
            foreach ($this->column_search as $i => $item) {
                if ($i == 0) {
                    $this->db->group_start();
                    $this->db->like($item, $search, 'both', false);
                    $this->db->or_like($item, $search, 'both', false);
                } else {
                    $this->db->or_like($item, $search, 'both', false);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
        }

        if (!empty($id))
            $this->db->where("$this->table.id", $id);
        if (!empty($category_id))
            $this->db->where("$this->table.category_id", $category_id);
        if (!empty($post_id))
            $this->db->where("$this->table.post_id", $post_id);

        if (!empty($slug)) {
            $this->db->where('slug', $slug);
        }

        if (!empty($in))
            $this->db->where_in("$this->table.id", $in);

        if (!empty($or_in))
            $this->db->or_where_in("$this->table.id", $or_in);

        if (!empty($not_in))
            $this->db->where_not_in("$this->table.id", $not_in);

        if (!empty($or_not_in))
            $this->db->or_where_not_in("$this->table.id", $or_not_in);

        if (!empty($created_time))
            $this->db->like("$this->table.created_time", $created_time);

        if (!empty($random))
            $this->db->order_by('rand()');

        if (!empty($author))
            $this->db->where("$this->table.author", $author);

        if (!empty($offset))
            $this->db->offset($offset);


        $this->_get_datatables_query();

        if ($typeQuery == false) {
            if (!empty($order) && is_array($order)) {
                foreach ($order as $k => $v)
                    $this->db->order_by($k, $v);
            }
            $offset = ($page - 1) * $limit;
            $this->db->limit($limit, $offset);
        }
    }

    private function _where_custom($args = array())
    {
        extract($args);
        if (!empty($store_id)) $this->db->where("$this->table.store_id", $store_id);
    }

    /*Hàm xử lý các tham số truyền từ Datatables Jquery*/
    private function _get_datatables_query()
    {
        $query = $this->input->post('query');
        if (!empty($query['generalSearch'])) {
            $keyword = $query['generalSearch'];
            $fieldSearch = '';
            foreach ($this->column_search as $i => $item) {
                if ($i == 0) {
                    $this->db->group_start();
                    $this->db->like($item, $keyword, 'both', false);
                    $this->db->or_like($item, $keyword, 'both', false);
                } else {
                    $this->db->or_like($item, $keyword, 'both', false);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
        }

        if ($this->input->post('sort')) {
            $sort = $this->input->post('sort');
            $this->db->order_by($sort['field'], $sort['sort']);
        }
    }
}
