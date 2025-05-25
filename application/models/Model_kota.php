<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_kota extends CI_Model
{
    public function get_all_kota() {
        return $this->db->select('kabupaten_kota, ongkir')->get('kota')->result();
    }
    
    public function get_ongkir_by_kota($kabupaten_kota) {
        $this->db->where('kabupaten_kota', $kabupaten_kota);
        return $this->db->get('kota')->row();
    }
    
}
