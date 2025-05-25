<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelProduk');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index()
    {
        $data['title'] = 'Data Produk';
        $data['produk'] = $this->ModelProduk->get_all_produk();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/produk', $data);
        $this->load->view('templates/footer');
        
    }

    public function tambah()
    {
        $this->form_validation->set_rules('nama_produk', 'Product Name', 'required');
        $this->form_validation->set_rules('deskripsi', 'Description', 'required');
        $this->form_validation->set_rules('harga', 'Price', 'required|numeric');
        $this->form_validation->set_rules('jumlah', 'Product Quantity', 'required|integer');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 2048;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('gambar')) {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('admin/produk');
            } else {
                $upload_data = $this->upload->data();
                $gambar = $upload_data['file_name'];

                $data = [
                    'nama_produk' => $this->input->post('nama_produk'),
                    'deskripsi' => $this->input->post('deskripsi'),
                    'harga' => $this->input->post('harga'),
                    'jumlah_produk' => $this->input->post('jumlah'),
                    'gambar' => $gambar
                ];

                $this->ModelProduk->insert_produk($data);
                $this->session->set_flashdata('message', '<div class="alert alert-success">Product updated successfully!</div>');
                redirect('admin/produk');
            }
        }
    }

   public function edit($id)
{
    // Validasi form
    $this->form_validation->set_rules('nama_produk', 'Product Name', 'required');
    $this->form_validation->set_rules('deskripsi', 'Description', 'required');
    $this->form_validation->set_rules('harga', 'Price', 'required|numeric');
    $this->form_validation->set_rules('jumlah', 'Product Quantity', 'required|integer');

    if ($this->form_validation->run() == FALSE) {
        // Jika validasi gagal, arahkan kembali ke form edit dengan data produk
        $data['title'] = 'Edit Product';
        $data['produk'] = $this->ModelProduk->get_produk_by_id($id);

        if (!$data['produk']) {
            show_404(); // Jika produk tidak ditemukan
        }

        $this->load->view('templates/header', $data);
        $this->load->view('admin/edit_produk', $data);
        $this->load->view('templates/footer');
    } else {
        // Data input dari form
        $updateData = [
            'nama_produk'    => $this->input->post('nama_produk', true),
            'deskripsi'      => $this->input->post('deskripsi', true),
            'harga'          => $this->input->post('harga', true),
            'jumlah_produk'  => $this->input->post('jumlah', true),
        ];

        // Cek jika ada file gambar yang diupload
        if (!empty($_FILES['gambar']['name'])) {
            $config['upload_path']   = './uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size']      = 2048; // 2MB

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('gambar')) {
                $upload_data = $this->upload->data();
                $updateData['gambar'] = $upload_data['file_name'];

                // (Optional) Hapus gambar lama
                $produk = $this->ModelProduk->get_produk_by_id($id);
                if (!empty($produk['gambar'])) {
                    $old_image = FCPATH . 'uploads/' . $produk['gambar'];
                    if (file_exists($old_image)) {
                        unlink($old_image);
                    }
                }
            } else {
                // Jika upload gagal, tampilkan error
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('admin/produk');
            }
        }

        // Update ke database
        $this->ModelProduk->update_produk($id, $updateData);

        $this->session->set_flashdata('message', '<div class="alert alert-success">Product updated successfully!</div>');
        redirect('admin/produk');
    }
}

   // Fungsi untuk menghapus produk
   public function hapus($id = NULL)
{
    // Validasi ID
    if ($id === NULL) {
        $this->session->set_flashdata('error', '<div class="alert alert-danger">ID produk tidak ditemukan.</div>');
        redirect('admin/produk');
    }

    // Ambil data produk dari model
    $produk = $this->ModelProduk->get_produk_by_id($id);
    if (!$produk) {
        $this->session->set_flashdata('error', '<div class="alert alert-danger">Produk tidak ditemukan.</div>');
        redirect('admin/produk');
    }

    // Hapus gambar dari folder uploads jika ada
    if (!empty($produk['gambar'])) {
        $gambar_path = FCPATH . 'uploads/' . $produk['gambar'];
        if (file_exists($gambar_path)) {
            unlink($gambar_path); // hapus gambar dari file system
        }
    }

    // Hapus produk dari database
    $this->ModelProduk->delete_produk($id); // pastikan method ini memang menghapus dari tabel produk

    // Tampilkan pesan sukses
    $this->session->set_flashdata('message', '<div class="alert alert-success">Produk berhasil dihapus.</div>');

    // Redirect ke halaman produk
    redirect('admin/produk');
}

    }
   
   

?>
