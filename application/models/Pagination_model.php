<?php
// models/Users.php
defined('BASEPATH') or exit('No direct script access allowed');

class Pagination_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function get_current_page_records($db, $limit, $start)
    {
        $this->db->limit($limit, $start);
        $query = $this->db->get($db);

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            return $data;
        }

        return false;
    }

    public function get_total($db)
    {
        return $this->db->count_all($db);
    }

    public function get_totalWhe($db, $where = [])
    {
        $this->db->select('COUNT(*) AS `numrows`');
        $this->db->where($where);
        $query = $this->db->get($db);
        return $query->row()->numrows;
    }
}
