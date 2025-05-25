<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        // Load semua model yang dibutuhkan
        $this->load->model('ModelProduk');
        $this->load->model('Model_keranjang');

        // Cek jika user belum login
        if (!$this->session->userdata('email')) {
            redirect('auth');
        }
    }

    public function index()
    {
        $data = [];
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();

        $this->load->view('templates/user_header', $data);
        $this->load->view('user/dashboard', $data);
        $this->load->view('templates/user_footer');
    }

    public function detail($id)
    {
        $data = [];
        $data['title'] = 'Detail Produk';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();

        $data['produk'] = $this->ModelProduk->get_produk_by_id($id);
        if (!$data['produk']) {
            show_404();
        }

        $this->load->view('templates/user_header', $data);
        $this->load->view('user/detail_produk', $data);
        $this->load->view('templates/user_footer');
    }

    public function keranjang()
    {
        $data = [];
        $data['title'] = 'Keranjang';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();

        $data['keranjang'] = $this->Model_keranjang->get_keranjang_by_user($data['user']['id_user']);
        $this->load->view('templates/user_header', $data);
        $this->load->view('user/keranjang', $data);
        $this->load->view('templates/user_footer');
    }

    public function hapus_item($id_keranjang)
    {
        $this->Model_keranjang->hapus_item($id_keranjang);
        $this->session->set_flashdata('success', 'Produk berhasil dihapus dari keranjang.');
        redirect('user/keranjang');
    }

    public function update_jumlah($id_keranjang)
    {
        $jumlah = $this->input->post('jumlah');
        if ($jumlah < 1) {
            $this->session->set_flashdata('error', 'Jumlah tidak valid.');
        } else {
            $this->Model_keranjang->update_jumlah($id_keranjang, $jumlah);
            $this->session->set_flashdata('success', 'Jumlah produk berhasil diperbarui.');
        }
        redirect('user/keranjang');
    }

    public function checkout()
    {
        $data = [];
        $data['title'] = 'Checkout';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();
        $data['provinsi'] = $this->db->get('provinsi')->result();

        $produk_ids = $this->input->post('produk_id');
        $jumlahs = $this->input->post('jumlah');

        if (!$produk_ids || !$jumlahs || count($produk_ids) != count($jumlahs)) {
            $this->session->set_flashdata('error', 'Data checkout tidak valid.');
            redirect('user/keranjang');
        }

        $checkout_data = [];
        foreach ($produk_ids as $index => $id_produk) {
            $produk = $this->ModelProduk->get_produk_by_id($id_produk);
            if ($produk) {
                $checkout_data[] = [
                    'produk' => $produk,
                    'jumlah' => $jumlahs[$index]
                ];
            }
        }

        $this->session->set_userdata('checkout_data', $checkout_data);
        redirect('user/checkout_review');
    }

    public function checkout_review()
    {
        $data = [];
        $data['title'] = 'Review Checkout';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();
        $data['provinsi'] = $this->db->get('provinsi')->result();

        $checkout_data = $this->session->userdata('checkout_data');
        if (empty($checkout_data)) {
            $this->session->set_flashdata('error', 'Tidak ada data checkout ditemukan.');
            redirect('user/keranjang');
        }

        $data['checkout_data'] = $checkout_data;
        $this->load->view('templates/user_header', $data);
        $this->load->view('user/checkout_review', $data);
        $this->load->view('templates/user_footer');
    }

    public function detail_pesanan($id)
    {
        $data = [];
        $data['title'] = 'Detail Pesanan';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();

        $data['pesanan'] = $this->db->get_where('pesanan', ['id' => $id])->row_array();
        if (!$data['pesanan']) {
            show_404();
        }

        $data['detail'] = $this->db->get_where('pesanan_detail', ['id_pesanan' => $id])->result();

        $this->load->view('templates/user_header', $data);
        $this->load->view('user/detail_pesanan', $data);
        $this->load->view('templates/user_footer');
    }

    public function myprofile()
    {
        $data = [];
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();

        $this->load->view('templates/user_header', $data);
        $this->load->view('user/myprofile', $data);
        $this->load->view('templates/user_footer');
    }
}
