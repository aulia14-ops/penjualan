<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ongkir_model extends CI_Model {

    public function get_all_kabupaten() {
        return $this->db->get('ongkir')->result();
    }

    public function get_ongkir_by_kabupaten($kabupaten_kota) {
        $this->db->select('ongkir');
        $this->db->from('ongkir');
        $this->db->where('kabupaten_kota', $kabupaten_kota); // pastikan kolom ini sesuai
        $query = $this->db->get();

        return $query->row(); // hasilnya object dengan properti ->ongkir
    }
}
