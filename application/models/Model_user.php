<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_user extends CI_Model {

    public function get_all_users() {
        $this->db->from('user');
        $this->db->where('role_id', 2); // hanya ambil customer dengan role_id 2
        return $this->db->get()->result();
    }

    public function get_admin_aktif() {
        return $this->db->get_where('user', ['role_id' => 1, 'is_active' => 1])->result();
    }

    public function insert_user($data) {
        return $this->db->insert('user', $data);
    }

    public function delete_admin($id) {
        return $this->db->delete('user', ['id' => $id, 'role_id' => 1]);
    }
}
