<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesanan_model extends CI_Model {
    public function get_all() {
        return $this->db->get('pesanan')->result();
    }

    // Fungsi untuk menyimpan pesanan ke database
    public function simpan_pesanan($data) {
        return $this->db->insert('pesanan', $data);
    }

    // Fungsi untuk mengambil pesanan berdasarkan ID (misalnya)
    public function get_pesanan_by_id($id_pesanan) {
        return $this->db->get_where('pesanan', ['id_pesanan' => $id_pesanan])->row_array();
    }
}
