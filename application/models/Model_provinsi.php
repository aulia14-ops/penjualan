<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_provinsi extends CI_Model
{
    protected $table = 'provinsi';

    public function get_all()
    {
        return $this->db->get($this->table)->result_array();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row_array();
    }
}
