<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_user_pesanan_lensa extends CI_Model
{
    protected $table = 'user_pesanan_lensa';

    public function insert_lensa($data)
    {
        $this->db->insert_batch($this->table, $data); // Insert multiple lensa
    }

    public function get_by_pesanan($pesanan_id)
    {
        return $this->db->get_where($this->table, ['user_pesanan_id' => $pesanan_id])->result_array();
    }
}
