<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelProduk');
        $this->load->library(['form_validation', 'upload', 'session']);
        $this->load->helper(['url', 'form']);
    }

    public function index()
    {
        $data = array();
        $data['title'] = 'Data Produk';
        $data['produk'] = $this->ModelProduk->get_all_produk();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('produk/index', $data); // Sesuaikan dengan struktur view Anda
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $this->form_validation->set_rules('nama', 'Nama Produk', 'required');
        $this->form_validation->set_rules('harga', 'Harga Produk', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Tambah Produk';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('produk/tambah', $data);
            $this->load->view('templates/footer');
        } else {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 2048;

            $this->upload->initialize($config);

            if (!$this->upload->do_upload('gambar')) {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('produk/tambah');
            } else {
                $upload_data = $this->upload->data();
                $gambar = $upload_data['file_name'];

                $data = [
                    'nama' => $this->input->post('nama'),
                    'harga' => $this->input->post('harga'),
                    'gambar' => $gambar
                ];

                $this->ModelProduk->insert_produk($data);
                $this->session->set_flashdata('success', 'Produk berhasil ditambahkan.');
                redirect('produk');
            }
        }
    }

    public function edit($id = NULL)
    {
        if ($id === NULL) {
            $this->session->set_flashdata('error', 'ID produk tidak ditemukan.');
            redirect('produk');
        }

        $data['produk'] = $this->ModelProduk->get_produk_by_id($id);
        if (!$data['produk']) {
            show_404();
        }

        $this->form_validation->set_rules('nama', 'Nama Produk', 'required');
        $this->form_validation->set_rules('harga', 'Harga Produk', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Edit Produk';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('produk/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $gambar = $data['produk']['gambar'];

            if (!empty($_FILES['gambar']['name'])) {
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 2048;

                $this->upload->initialize($config);

                if (!$this->upload->do_upload('gambar')) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('produk/edit/' . $id);
                } else {
                    if (!empty($gambar) && file_exists('./uploads/' . $gambar)) {
                        unlink('./uploads/' . $gambar);
                    }
                    $upload_data = $this->upload->data();
                    $gambar = $upload_data['file_name'];
                }
            }

            $update_data = [
                'nama' => $this->input->post('nama'),
                'harga' => $this->input->post('harga'),
                'gambar' => $gambar
            ];

            $this->ModelProduk->update_produk($id, $update_data);
            $this->session->set_flashdata('success', 'Produk berhasil diperbarui.');
            redirect('produk');
        }
    }

    public function hapus($id)
    {
        $produk = $this->ModelProduk->get_produk_by_id($id);
        if (!$produk) {
            show_404();
        }

        if (!empty($produk['gambar']) && file_exists('./uploads/' . $produk['gambar'])) {
            unlink('./uploads/' . $produk['gambar']);
        }

        $this->ModelProduk->delete_produk($id);
        $this->session->set_flashdata('success', 'Produk berhasil dihapus.');
        redirect('produk');
    }
}
