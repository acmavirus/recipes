<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Model extends CI_Model
{
    public $_controller;
    public $_method;
    public $table;

    public function __construct()
    {
        parent::__construct();
        $this->_controller = $this->router->fetch_class();
        $this->_method = $this->router->fetch_method();
        $this->table = strtolower(str_replace('_model', '', get_Class($this)));
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

    public function update($where, $data)
    {
        $this->db->where($where);
        $this->db->update($this->table, $data);
        return true;
    }

    function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    function delete($where)
    {
        $this->db->delete($this->table, $where);
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

    public function getDataBy($table, $param = [])
    {
        if (empty($table)) $table = $this->table;
        $cache = "cache_by_$table" . implode('_', $param);
        //$data = $this->getCache($cache);
        if (empty($data)) {
            $this->db->select('*');
            if (count($param) > 1) {
                foreach ($param as $item) {
                    $this->db->where($item);
                }
            } else $this->db->where($param);
            $this->db->order_by('id', "ASC");
            $query = $this->db->get($table);
            $data = $query->result_array();
            $this->setCache($cache, $data, 100);
        };
        if (count($data) == 1) {
            return (array) $query->row();
        } else {
            return $data;
        }
    }

    public function getDataByODR($table, $param = [], $order = ['id' => 'ASC'])
    {

        $cache = "cache_by_" . implode('_', $param);
        //$data = $this->getCache($cache);
        if (empty($data)) {
            $this->db->select('*');
            $this->db->where($param);
            if (!empty($order)) foreach ($order as $key => $value) {
                $this->db->order_by($key, $value);
            }
            $query = $this->db->get($table);
            $data = $query->result_array();
            $this->setCache($cache, $data, 100);
        }
        if (count($data) === 1) {
            return (array) $query->row();
        } else {
            return $data;
        }
    }

    public function getDataByLM($table, $param = '', $limit, $page = 1, $order = 'id', $search = null, $select = '*')
    {
        $this->db->select($select);
        $this->db->where($param);
        if (is_string($order)) {
            $this->db->order_by($order, "ASC");
        } else {
            foreach ($order as $key => $value) {
                $this->db->order_by($key, $value);
            }
        }
        if ($page == 0) {
            $offset = $page * $limit;
        } else {
            $offset = ($page - 1) * $limit;
        }
        if (empty($search)) $this->db->limit($limit, $offset);
        if (!empty($search)) {
            $query = $this->db->get($table)->result_array();
            $rs = [];
            if (!empty($query)) foreach ($query as $key => $value) {
                if (strpos($value[$search[0]], $search[1]) !== false) {
                    $rs[] = $value;
                }
            };
            return $rs;
        }
        $query = $this->db->get($table);
        return $query->result_array();
    }
}

class ADMIN_Model extends MY_Model
{
    public $_controller;
    public $_method;
    public $admin_table;
    public $table;

    public function __construct()
    {
        parent::__construct();
        $this->_controller = $this->router->fetch_class();
        $this->_method = $this->router->fetch_method();
        $this->admin_table = "admin_" . strtolower(str_replace('_model', '', get_Class($this)));
        $this->table = strtolower(str_replace('_model', '', get_Class($this)));
    }

    public function update($where, $data)
    {
        $this->db->where($where);
        $this->db->update($this->table, $data);
        return $this->db->affected_rows();
    }

    function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    function delete($where)
    {
        $this->db->delete($this->table, $where);
        return $this->db->affected_rows();
    }

    public function getByField($field, $value, $select = '*')
    {
        $this->db->select($select);
        $this->db->from($this->table);
        $this->db->where("$this->table.$field", $value);
        $query = $this->db->get();
        return $query->row();
    }

    public function getAll()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getDataBy($table, $param = [])
    {

        $cache = "cache_by_$table" . implode('_', $param);
        //$data = $this->getCache($cache);
        if (empty($data)) {
            $this->db->select('*');
            if (count($param) > 1) {
                foreach ($param as $item) {
                    $this->db->where($item);
                }
            } else $this->db->where($param);
            $this->db->order_by('id', "ASC");
            $query = $this->db->get($table);
            $data = $query->result_array();
            $this->setCache($cache, $data, 100);
        };
        if (count($data) == 1) {
            return (array) $query->row();
        } else {
            return $data;
        }
    }

    public function getDataByODR($table, $param = [], $order = ['id' => 'ASC'])
    {

        $cache = "cache_by_" . implode('_', $param);
        //$data = $this->getCache($cache);
        if (empty($data)) {
            $this->db->select('*');
            $this->db->where($param);
            if (!empty($order)) foreach ($order as $key => $value) {
                $this->db->order_by($key, $value);
            }
            $query = $this->db->get($table);
            $data = $query->result_array();
            $this->setCache($cache, $data, 100);
        }
        if (count($data) === 1) {
            return (array) $query->row();
        } else {
            return $data;
        }
    }

    public function getDataByLM($table, $param = '', $limit, $page = 1, $order = 'id', $search = null, $select = '*')
    {
        $this->db->select($select);
        $this->db->where($param);
        if (is_string($order)) {
            $this->db->order_by($order, "ASC");
        } else {
            foreach ($order as $key => $value) {
                $this->db->order_by($key, $value);
            }
        }
        if ($page == 0) {
            $offset = $page * $limit;
        } else {
            $offset = ($page - 1) * $limit;
        }
        if (empty($search)) $this->db->limit($limit, $offset);
        if (!empty($search)) {
            $query = $this->db->get($table)->result_array();
            $rs = [];
            if (!empty($query)) foreach ($query as $key => $value) {
                if (strpos($value[$search[0]], $search[1]) !== false) {
                    $rs[] = $value;
                }
            };
            return $rs;
        }
        $query = $this->db->get($table);
        return $query->result_array();
    }
}
