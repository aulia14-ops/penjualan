<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('ModelProduk');
        $this->load->database();
    }

    public function index() {
        $this->db->order_by('id_produk', 'DESC'); // Ganti dengan 'id_produk' jika tidak ada kolom 'created_at'
        $this->db->limit(6);
        $data['produk'] = $this->ModelProduk->get_all_produk();
        $this->load->view('home/index', $data);
    }
}