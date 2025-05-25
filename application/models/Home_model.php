<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('ModelProduk'); // Pastikan model dimuat
    }

    public function index() {
        // Cek apakah user sudah login
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login'); // redirect ke halaman login
        }

        $data['produk'] = $this->ModelProduk->get_all_produk(); // Ambil semua produk
        $this->load->view('home/index', $data); // Kirim data ke view
    }
}
