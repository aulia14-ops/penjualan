<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in(); // Pastikan helper login ini sudah dibuat
        $this->load->model('ModelProduk');
        $this->load->model('Model_user_pesanan');
        $this->load->library('session');
        $this->load->model('Model_user');
    }

  public function index()
{
    $data['title'] = 'Dashboard';
    $data['user'] = $this->db->get_where('user', [
        'email' => $this->session->userdata('email')
    ])->row_array();

    // Jumlah macam produk
    $data['jumlah'] = $this->db->count_all('produk');

    // Jumlah pesanan dengan status 'proses'
    $this->db->where('status', 'proses');
    $data['proses'] = $this->db->count_all_results('user_pesanan');

    // Jumlah pesanan dengan status 'kirim'
    $this->db->where('status', 'kirim');
    $data['kirim'] = $this->db->count_all_results('user_pesanan');

    // Jumlah pesanan dengan status 'dibatalkan'
    $this->db->where('status', 'dibatalkan');
    $data['dibatalkan'] = $this->db->count_all_results('user_pesanan');

    // Jumlah total stok produk
    $this->db->select_sum('jumlah_produk');
    $query = $this->db->get('produk');
    $data['jumlah_total'] = $query->row()->jumlah_produk ?? 0;

    // Total produk terjual
    $this->db->select_sum('pd.qty', 'total_qty');
    $this->db->from('user_pesanan_detail pd');
    $this->db->join('user_pesanan p', 'pd.id_pesanan = p.id');
    $this->db->where('p.status !=', 'dibatalkan');
    $query = $this->db->get();
    $data['produk_terjual'] = $query->row()->total_qty ?? 0;

    // Ambil 5 pesanan terbaru
    $this->db->select('*');
    $this->db->from('user_pesanan');
    $this->db->order_by('tanggal_pesanan', 'DESC');
    $this->db->limit(5);
    $data['pesanan_terbaru'] = $this->db->get()->result_array();


    // Load views
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('admin/index', $data);
    $this->load->view('templates/footer');
}


    public function data_customer() {
    $data['title'] = 'Data Customer';

    // Ambil user yang sedang login
    $data['user'] = $this->db->get_where('user', [
        'email' => $this->session->userdata('email')
    ])->row_array();

    // Ambil semua data customer
    $this->load->model('Model_user');
    $data['users'] = $this->Model_user->get_all_users();

    // Load view
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('admin/data_customer', $data);
    $this->load->view('templates/footer');
}

public function kelola_admin()
{
    $data['title'] = 'Kelola Admin';
    
    // Ambil data admin yang aktif
    $data['admin'] = $this->Model_user->get_admin_aktif();

    // Ambil data user yang sedang login
    $data['user'] = $this->db->get_where('user', [
        'email' => $this->session->userdata('email')
    ])->row_array();

    // Load view
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('admin/kelola_admin', $data);
    $this->load->view('templates/footer');
}

public function tambah_admin()
{
    $data['title'] = 'Tambah Admin';

    // Ambil user login untuk sidebar/topbar
    $data['user'] = $this->db->get_where('user', [
        'email' => $this->session->userdata('email')
    ])->row_array();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('admin/tambah_admin', $data);
    $this->load->view('templates/footer');
}

public function simpan_admin()
{
    $this->_rulesadmin();

    if ($this->form_validation->run() == FALSE) {
        $this->tambah_admin();
    } else {
        $data = [
            'name'         => $this->input->post('name', true),
            'email'        => $this->input->post('email', true),
            'image'        => 'default.jpg',
            'password'     => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'role_id'      => 1, // Admin
            'is_active'    => 1,
            'date_created' => time()
        ];

        $this->Model_user->insert_user($data);

        $this->session->set_flashdata('pesan', 
            '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                Data Admin Berhasil Ditambahkan!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');

        redirect('admin/kelola_admin');
    }
}

public function delete_admin($id)
{
    $this->Model_user->delete_admin($id);

    $this->session->set_flashdata('pesan', 
        '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Admin berhasil dihapus!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>');

    redirect('admin/kelola_admin');
}

private function _rulesadmin()
{
    $this->load->library('form_validation');
    $this->form_validation->set_rules('name', 'Nama', 'required|trim');
    $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
        'is_unique' => 'Email ini sudah terdaftar!'
    ]);
    $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
}




    public function produk()
    {
        $data['title'] = 'Daftar Produk';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();

        $data['produk'] = $this->ModelProduk->get_all_produk();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/produk', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Produk';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/tambah_produk', $data);
        $this->load->view('templates/footer');
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

        $data['produk'] = $this->ModelProduk->get_produk_by_id($id);

        if (!$data['produk']) {
            show_404();
        }

        $data['title'] = 'Edit Produk';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/edit_produk', $data);
        $this->load->view('templates/footer');
    }

    public function proses_edit()
    {
        $id = $this->input->post('id_produk');

        if (!$id || !$this->ModelProduk->ambil_id_produk($id)) {
            redirect(base_url('admin/produk'));
        }

        $this->ModelProduk->proses_edit($id);
        redirect(base_url('admin/produk'));
    }

    public function update_produk($id_produk)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nama_produk', 'Product Name', 'required');
        $this->form_validation->set_rules('deskripsi', 'Description', 'required');
        $this->form_validation->set_rules('harga', 'Price', 'required|numeric');
        $this->form_validation->set_rules('jumlah_produk', 'Product Quantity', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->edit_produk($id_produk);
        } else {
            $this->ModelProduk->updateProduk($id_produk); // Memanggil model untuk update produk
            $this->session->set_flashdata('message', '<div class="alert alert-success">Product updated successfully!</div>');
            redirect('admin/produk'); // Arahkan ke daftar produk
        }
    }

    public function pesanan()
{
    $data['title'] = 'Data Pesanan';
    $data['user'] = $this->db->get_where('user', [
        'email' => $this->session->userdata('email')
    ])->row_array();

    // Pastikan model sudah diload di constructor: $this->load->model('Model_user_pesanan');
    $data['user_pesanan'] = $this->Model_user_pesanan->getAllPesanan();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('admin/pesanan', $data);
    $this->load->view('templates/footer');
}

// Fungsi untuk menampilkan detail pesanan
    public function detail_pesanan($id)
    {
        $data['title'] = 'Detail Pesanan';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();

        // Ambil data pesanan berdasarkan ID
        $data['user_pesanan'] = $this->Model_user_pesanan->getPesananById($id);

        // Ambil detail produk dari pesanan
        $detail_items = $this->Model_user_pesanan->getDetailItemByPesananId($id);

        $data['user_pesanan_detail'] = []; // Inisialisasi array detail produk
        $total = 0;

        foreach ($detail_items as $item) {
            $produk = $this->ModelProduk->get_produk_by_id($item['id_produk']); // return row_array
            if ($produk) {
                $subtotal = $item['qty'] * $produk['harga'];
                $data['user_pesanan_detail'][] = [
                    'id'     => $produk['id_produk'],
                    'nama_produk' => $produk['nama_produk'],
                    'qty'    => $item['qty'],
                    'harga'  => $produk['harga'],
                    'gambar' => $produk['gambar'],
                    'subtotal' => $subtotal
                ];
                $total += $subtotal;
            }
        }

        $data['total'] = $total;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/detailpesanan', $data);
        $this->load->view('templates/footer');
    }


  public function update_status($id)
{
    $status = $this->input->post('status');

    // Ambil data pesanan lama
    $pesanan = $this->db->get_where('user_pesanan', ['id' => $id])->row();

    if (!$pesanan) {
        $this->session->set_flashdata('message', '<div class="alert alert-danger">Pesanan tidak ditemukan.</div>');
        redirect('admin/pesanan');
        return;
    }

    // Jika status berubah menjadi 'dibatalkan'
    if ($status === 'dibatalkan') {
        // Ambil detail pesanan terkait
        $detail_items = $this->db->get_where('user_pesanan_detail', ['id_pesanan' => $id])->result();

        foreach ($detail_items as $item) {
            // Kembalikan stok produk
            $this->db->set('jumlah_produk', 'jumlah_produk + ' . (int)$item->qty, FALSE);
            $this->db->where('id_produk', $item->id_produk);
            $this->db->update('produk');
        }

        // Hapus detail pesanan
        $this->db->delete('user_pesanan_detail', ['id_pesanan' => $id]);

        // Hapus pesanan utama
        $this->db->delete('user_pesanan', ['id' => $id]);

        $this->session->set_flashdata('message', '<div class="alert alert-warning">Pesanan berhasil dibatalkan dan data dihapus.</div>');
        redirect('admin/pesanan');
        return;
    }

    // Kalau status bukan dibatalkan, cukup update biasa
    $this->db->set('status', $status);
    $this->db->where('id', $id);
    $this->db->update('user_pesanan');

    $this->session->set_flashdata('message', '<div class="alert alert-success">Status pesanan berhasil diperbarui.</div>');
    redirect('admin/pesanan');
}



    public function update_resi($id_pesanan)
        {
            // Ambil nomor resi dari input
            $no_resi = $this->input->post('no_resi');
            $data = ['no_resi' => $no_resi];

            // Panggil fungsi update_resi pada model
            $this->Model_user_pesanan->update_resi($id_pesanan, $data);

            // Set flash message dan redirect
            $this->session->set_flashdata('success', 'Nomor resi berhasil diperbarui');
            redirect('admin/pesanan');
        }

    public function cetak_nota($id = null)
{
    if ($id === null) {
        show_404(); // Atau redirect ke halaman lain
        return;
    }

    $this->load->model('model_user_pesanan');

    $data['user_pesanan'] = $this->model_user_pesanan->getPesananById($id);
    $data['user_pesanan_detail'] = $this->model_user_pesanan->getDetailItemByPesananId($id);
    $detail_items = $this->Model_user_pesanan->getDetailItemByPesananId($id);

        $data['user_pesanan_detail'] = []; // Inisialisasi array detail produk
        $total = 0;

        foreach ($detail_items as $item) {
            $produk = $this->ModelProduk->get_produk_by_id($item['id_produk']); // return row_array
            if ($produk) {
                $subtotal = $item['qty'] * $produk['harga'];
                $data['user_pesanan_detail'][] = [
                    'id'     => $produk['id_produk'],
                    'nama_produk' => $produk['nama_produk'],
                    'qty'    => $item['qty'],
                    'harga'  => $produk['harga'],
                    'subtotal' => $subtotal
                ];
                $total += $subtotal;
            }
        }

    if (!$data['user_pesanan']) {
        show_404();
        return;
    }

    $this->load->view('admin/cetak_nota', $data);
}



    public function laporan()
    {
         $data['laporan_pesanan'] = $this->Model_user_pesanan->get_laporan();
        $data['title'] = 'Laporan Pesanan';
        
        // Ambil data user dari session
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();

        // Load views
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/laporan', $data);  // DI SINI error terjadi jika $data['laporan'] tidak disiapkan
        $this->load->view('templates/footer');
    }
    

    public function myprofile()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();
    
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/myprofile', $data);  // Updated to reflect the correct path
        $this->load->view('templates/footer');
    }
    
    public function editprofile()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();
    
        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');
    
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/editprofile', $data);  // Updated to reflect the correct path
            $this->load->view('templates/footer');
        } else {
            $name = htmlspecialchars($this->input->post('name', true)); // Prevent XSS
            $email = $this->session->userdata('email'); // Ensure email cannot be changed
    
            $upload_image = $_FILES['image']['name'];
    
            if ($upload_image) {
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
                } else {
                    echo $this->upload->display_errors();
                }
            }
    
            $this->db->set('name', $name);
            $this->db->where('email', $email);
            $this->db->update('user');
    
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile has been updated!</div>');
            redirect('admin/myprofile');  // Redirect to the admin dashboard or relevant page
        }
    }
    
    public function changePassword()
    {
        $data['title'] = 'Change Password';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();
    
        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[6]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[6]|matches[new_password1]');
    
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/changepassword', $data);  // Updated to reflect the correct path
            $this->load->view('templates/footer');
        } else {
            $current_password = htmlspecialchars($this->input->post('current_password', true)); // Prevent XSS
            $new_password = htmlspecialchars($this->input->post('new_password1', true));
            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong current password!</div>');
                redirect('admin/changepassword');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">New password cannot be the same as current password!</div>');
                    redirect('admin/changepassword');
                } else {
                    // Password is valid
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
    
                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');
    
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password changed!</div>');
                    redirect('admin/changepassword');  // Redirect to the admin dashboard or relevant page
                }
            }
        }
    }
    
}