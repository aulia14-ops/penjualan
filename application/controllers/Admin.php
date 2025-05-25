<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_user');
        $this->load->model('ModelProduk');
        $this->load->model('model_user_pesanan');
        is_logged_in(); // helper function to verify login
    }

    public function index()
    {
        $data = array();
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();

        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/admin_footer');
    }

    public function data_customer()
    {
        $data = array();
        $data['title'] = 'Data Customer';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();
        $data['customers'] = $this->Model_user->get_all_customers();

        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/data_customer', $data);
        $this->load->view('templates/admin_footer');
    }

    public function kelola_admin()
    {
        $data = array();
        $data['title'] = 'Kelola Admin';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();
        $data['admin'] = $this->Model_user->get_admin_aktif();

        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/kelola_admin', $data);
        $this->load->view('templates/admin_footer');
    }

    public function tambah_admin()
    {
        $data = array();
        $data['title'] = 'Tambah Admin';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();

        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/tambah_admin', $data);
        $this->load->view('templates/admin_footer');
    }

    public function produk()
    {
        $data = array();
        $data['title'] = 'Daftar Produk';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();
        $data['produk'] = $this->ModelProduk->get_all_produk();

        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/produk', $data);
        $this->load->view('templates/admin_footer');
    }

    public function tambah()
    {
        $data = array();
        $data['title'] = 'Tambah Produk';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();

        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/tambah_produk', $data);
        $this->load->view('templates/admin_footer');
    }

    public function proses_tambah()
    {
        $this->ModelProduk->proses_tambah();
        redirect(base_url('admin/produk'));
    }

    public function hapus($id = NULL)
    {
        if ($id === NULL || !$this->ModelProduk->ambil_id_produk($id)) {
            redirect(base_url('admin/produk'));
        }
        $this->ModelProduk->hapus($id);
        redirect(base_url('admin/produk'));
    }

    public function edit_produk($id = NULL)
    {
        if ($id === NULL) {
            redirect(base_url('admin/produk'));
        }
        $data = array();
        $data['produk'] = $this->ModelProduk->get_produk_by_id($id);
        if (!$data['produk']) {
            show_404();
        }
        $data['title'] = 'Edit Produk';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();

        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/edit_produk', $data);
        $this->load->view('templates/admin_footer');
    }

    public function proses_edit_produk()
    {
        $id = $this->input->post('id_produk');
        if (!$id || !$this->ModelProduk->ambil_id_produk($id)) {
            redirect(base_url('admin/produk'));
        }
        $this->ModelProduk->proses_edit($id);
        redirect(base_url('admin/produk'));
    }

    public function pesanan()
    {
        $data = array();
        $data['title'] = 'Data Pesanan';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();
        $data['pesanan'] = $this->model_user_pesanan->get_all_pesanan();

        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/pesanan', $data);
        $this->load->view('templates/admin_footer');
    }

    public function detail_pesanan($id)
    {
        $data = array();
        $data['title'] = 'Detail Pesanan';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();
        $data['pesanan'] = $this->model_user_pesanan->getPesananById($id);

        if (!$data['pesanan']) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Pesanan tidak ditemukan.</div>');
            redirect('admin/pesanan');
        }

        $data['detail'] = $this->model_user_pesanan->getDetailItemByPesananId($id);

        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/detail_pesanan', $data);
        $this->load->view('templates/admin_footer');
    }

    public function cetak_nota($id = null)
    {
        if ($id === null) {
            show_404();
            return;
        }
        $data = array();
        $data['user_pesanan'] = $this->model_user_pesanan->getPesananById($id);
        $data['user_pesanan_detail'] = $this->model_user_pesanan->getDetailItemByPesananId($id);

        $this->load->view('admin/cetak_nota', $data);
    }

    public function laporan()
    {
        $data = array();
        $data['title'] = 'Laporan Pesanan';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();
        $data['laporan_pesanan'] = $this->model_user_pesanan->get_laporan();

        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/laporan', $data);
        $this->load->view('templates/admin_footer');
    }

    public function myprofile()
    {
        $data = array();
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();

        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/myprofile', $data);
        $this->load->view('templates/admin_footer');
    }

    public function editprofile()
    {
        $data = array();
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();

        $upload_image = $_FILES['image']['name'];

        if ($upload_image) {
            $config = array();
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size']      = 2048;
            $config['upload_path']   = './assets/img/profile/';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $old_image = $data['user']['image'];
                if ($old_image && $old_image != 'default.jpg') {
                    @unlink(FCPATH . 'assets/img/profile/' . $old_image);
                }

                $new_image = $this->upload->data('file_name');
                $this->db->set('image', $new_image);
            }
        }

        $this->db->update('user');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile has been updated!</div>');
        redirect('admin/myprofile');
    }

    public function changePassword()
    {
        $data = array();
        $data['title'] = 'Change Password';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();

        $current_password = $this->input->post('current_password');
        $new_password = htmlspecialchars($this->input->post('new_password1', true));

        if (!password_verify($current_password, $data['user']['password'])) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong current password!</div>');
            redirect('admin/changepassword');
        } else {
            if ($current_password == $new_password) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">New password cannot be the same as current password!</div>');
                redirect('admin/changepassword');
            }

            $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
            $this->db->set('password', $password_hash);
            $this->db->where('email', $this->session->userdata('email'));
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password changed!</div>');
            redirect('admin/changepassword');
        }
    }
}
