<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->library('cart'); // <- Tambahkan ini
        $this->load->model('ModelProduk');
        $this->load->model('Model_keranjang');
        $this->load->library('session'); // untuk flashdata
        $this->load->helper('url');
        $this->load->model('Model_user_pesanan');
        $this->load->library('upload');
        $this->load->model('Ongkir_model');
        $this->load->model('Model_user_pesanan_detail');
    }
public function index()
{
    $data['title'] = 'Dashboard';

    // Ambil data user yang sedang login berdasarkan email di session
    $email = $this->session->userdata('email');
    $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();

    // Ambil semua pesanan user berdasarkan email
    $pesanan = $this->db->get_where('user_pesanan', ['email' => $email])->result();

    // Ambil detail produk untuk setiap pesanan
    foreach ($pesanan as $key => $p) {
        // Menggunakan fungsi yang mengembalikan array detail produk
        $detail_produk = $this->Model_user_pesanan->getDetailItemByPesananId($p->id);
        $pesanan[$key]->detail_produk = [];

        $total = 0;
        foreach ($detail_produk as $item) {
            $produk = $this->ModelProduk->get_produk_by_id($item['id_produk']); // Return row_array
            if ($produk) {
                $subtotal = $item['qty'] * $produk['harga'];
                $pesanan[$key]->detail_produk[] = [
                    'id'            => $produk['id_produk'],
                    'nama_produk'   => $produk['nama_produk'],
                    'qty'           => $item['qty'],
                    'harga'         => $produk['harga'],
                    'gambar'        => $produk['gambar'],
                    'subtotal'      => $subtotal
                ];
                $total += $subtotal;
            }
        }

        // Menyimpan total pesanan
        $pesanan[$key]->total = $total;
    }

    // Menyimpan data pesanan dalam array data
    $data['pesanan'] = $pesanan;

    // Tampilkan view dengan data lengkap
    $this->load->view('templates/user_header', $data);
    $this->load->view('user/dashboard', $data);
    $this->load->view('templates/user_footer');
}

    public function produk()
    {
        $this->load->model('ModelProduk'); // <-- load model Produk_model
    
        $data['title'] = 'Produk';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();
        $data['produk'] = $this->ModelProduk->get_all_produk(); // <-- ambil semua produk
    
        $this->load->view('templates/user_header', $data);
        $this->load->view('user/user_produk', $data); // <-- kirim $data (termasuk $produk)
        $this->load->view('templates/user_footer');
    }
    
    public function detail($id)
{
    $data['title'] = 'Detail Produk';
    $data['user'] = $this->db->get_where('user', [
        'email' => $this->session->userdata('email')
    ])->row_array();
    $this->load->model('ModelProduk');
    $data['produk'] = $this->ModelProduk->get_produk_by_id($id); // perbaiki di sini

    if (!$data['produk']) {
        show_404();
    }

    $this->load->view('templates/user_header', $data);
    $this->load->view('user/detail_produk', $data);
    $this->load->view('templates/user_footer');
}


public function beli_langsung()
{
    $id_produk = $this->input->post('id_produk');
    $jumlah = $this->input->post('jumlah') ?? 1;

    if (!$id_produk) {
        show_error('ID Produk tidak dikirim.');
    }

    $produk = $this->ModelProduk->get_produk_by_id($id_produk);
    if (!$produk) {
        show_404();
    }

    // Simpan ke session checkout_data (agar bisa digunakan di proses_checkout)
    $checkout_data = [[
        'id_user'    => $this->session->userdata('id_user'),
        'id_produk'  => $produk['id_produk'],
        'jumlah'     => $jumlah,
        'tanggal'    => date('Y-m-d H:i:s'),
    ]];
    $this->session->set_userdata('checkout_data', $checkout_data);

    // Redirect ke halaman review checkout (agar semua logika tetap konsisten)
    redirect('user/checkout_review');
}

   // Menampilkan halaman keranjang
public function keranjang()
{
    // Ambil email dari session
    $email = $this->session->userdata('email');

    // Cek jika user belum login
    if (!$email) {
        redirect('auth'); // Mengarahkan ke halaman login jika belum login
        return;
    }

    // Ambil data user berdasarkan email
    $user = $this->db->get_where('user', ['email' => $email])->row_array();

    // Jika user tidak ditemukan
    if (!$user) {
        show_error('Data user tidak ditemukan.', 403);
        return;
    }

    // Ambil id_user dari data user
    $id_user = $user['id_user'] ?? $user['id'] ?? null;
    if (!$id_user) {
        show_error('ID user tidak valid.', 403);
        return;
    }

    // Set judul halaman
    $data['title'] = 'Keranjang';
    $data['user'] = $user;

    // Ambil data keranjang dari model
    $this->load->model('Model_keranjang');
    $data['keranjang'] = $this->Model_keranjang->get_keranjang_user($id_user);

    // Tampilkan view keranjang
    $this->load->view('templates/user_header', $data);
    $this->load->view('user/keranjang', $data);
    $this->load->view('templates/user_footer');
}


// Menambahkan produk ke keranjang
public function tambah_keranjang()
{
    // Ambil ID user dari session
    $id_user = $this->session->userdata('id_user');

    // Jika ID user tidak ada, cari lewat email
    if (!$id_user) {
        $email = $this->session->userdata('email');
        if (!$email) {
            show_error('User belum login.', 403);
            return;
        }

        $user = $this->db->get_where('user', ['email' => $email])->row_array();
        if (!$user) {
            show_error('Data user tidak ditemukan.', 403);
            return;
        }

        // Mengambil ID user jika ditemukan
        $id_user = $user['id_user'] ?? $user['id'] ?? null;
    }

    if (!$id_user) {
        show_error('ID user tidak valid.', 403);
        return;
    }

    // Ambil input dari form
    $id_produk = $this->input->post('id_produk', true);
    $jumlah    = $this->input->post('jumlah', true);

    // Validasi input
    if (empty($id_produk) || empty($jumlah)) {
        $this->session->set_flashdata('message', '<div class="alert alert-danger">Produk atau jumlah tidak boleh kosong.</div>');
        redirect('user');  // Redirect ke halaman produk jika input tidak valid
        return;
    }

    // Cek apakah produk sudah ada di keranjang
    $this->load->model('Model_keranjang');
    $keranjang_exists = $this->Model_keranjang->cek_keranjang_exists($id_user, $id_produk);
    
    if ($keranjang_exists) {
        // Jika produk sudah ada, update jumlah produk
        $this->Model_keranjang->update_keranjang($id_user, $id_produk, $jumlah);
        $this->session->set_flashdata('message', '<div class="alert alert-success">Jumlah produk diperbarui di keranjang.</div>');
    } else {
        // Jika produk belum ada, tambahkan produk ke keranjang
        $data_keranjang = [
            'id_user'   => $id_user,
            'id_produk' => $id_produk,
            'jumlah'    => $jumlah
        ];
        $success = $this->Model_keranjang->tambah_ke_keranjang($data_keranjang);

        if ($success) {
            $this->session->set_flashdata('message', '<div class="alert alert-success">Produk berhasil ditambahkan ke keranjang.</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Gagal menambahkan produk ke keranjang.</div>');
        }
    }

    redirect('user/keranjang');  // Redirect kembali ke halaman keranjang
}

    
public function hapus_keranjang($id_keranjang)
{
    $this->load->model('Model_keranjang');
    $this->Model_keranjang->hapus_item($id_keranjang);
    redirect('user/keranjang');
}

// Update jumlah item di keranjang
public function update()
{
    $id_keranjang = $this->input->post('id');
    $qty = $this->input->post('qty');

    if ($id_keranjang && $qty > 0) {
        $this->Model_keranjang->update_qty($id_keranjang, $qty);
        $this->session->set_flashdata('success', 'Jumlah produk berhasil diperbarui.');
    } else {
        $this->session->set_flashdata('error', 'Jumlah tidak valid.');
    }

    redirect('user/keranjang');
}

// Hapus item dari keranjang
public function delete($id_keranjang)
{
    $this->Model_keranjang->hapus_item($id_keranjang);
    $this->session->set_flashdata('success', 'Produk berhasil dihapus dari keranjang.');
    redirect('user/keranjang');
}


public function checkout()
{
    $data['provinsi'] = $this->db->get('provinsi')->result();
    $id_user = $this->session->userdata('id_user');
    $produk_ids = $this->input->post('produk_id');
    $jumlahs = $this->input->post('jumlah');

    // Validasi input produk dan jumlah
    if (!$produk_ids || !$jumlahs || count($produk_ids) != count($jumlahs)) {
        $this->session->set_flashdata('error', 'Data checkout tidak valid.');
        redirect('user/keranjang');
    }

    $data_checkout = [];
    foreach ($produk_ids as $index => $id_produk) {
        $jumlah = (int) $jumlahs[$index];
        if ($jumlah <= 0) continue;

        $data_checkout[] = [
            'id_user'    => $id_user,
            'id_produk'  => $id_produk,
            'jumlah'     => $jumlah,
            'tanggal'    => date('Y-m-d H:i:s'),
        ];
    }

    if (empty($data_checkout)) {
        $this->session->set_flashdata('error', 'Tidak ada item yang valid untuk checkout.');
        redirect('user/keranjang');
    }

    $this->session->set_userdata('checkout_data', $data_checkout);

    // Ganti redirect ke checkout_review
    redirect('user/checkout_review');
}

public function checkout_review()
{
    $data['provinsi'] = $this->db->get('provinsi')->result();
    $checkout_data = $this->session->userdata('checkout_data');

    if (empty($checkout_data)) {
        $this->session->set_flashdata('error', 'Tidak ada data checkout ditemukan.');
        redirect('user/keranjang');
    }

    $this->load->model('ModelProduk');
    $this->load->model('Ongkir_model');

    $checkout_items = [];
    $total = 0;

    foreach ($checkout_data as $item) {
        $produk = $this->ModelProduk->get_produk_by_id($item['id_produk']); // return row_array
        if ($produk) {
            $subtotal = $item['jumlah'] * $produk['harga'];
            $checkout_items[] = [
                'id'     => $produk['id_produk'],
                'name'   => $produk['nama_produk'],
                'qty'    => $item['jumlah'],
                'price'  => $produk['harga'],
                'gambar' => $produk['gambar']
            ];
            $total += $subtotal;
        }
    }

    // Ambil ongkir jika kota dipilih (via POST)
    $ongkir = 0;
    $kota = $this->input->post('kota');
    if ($kota) {
        $ongkir_data = $this->Ongkir_model->get_ongkir_by_kabupaten($kota);
        if ($ongkir_data) {
            $ongkir = $ongkir_data->ongkir;
        }
    }

    // Masukkan semua data yang dibutuhkan ke array
    $data['checkout_items'] = $checkout_items;
    $data['total'] = $total;
    $data['kota'] = $kota;
    $data['ongkir'] = $ongkir;

    // Kirim ke view
    $this->load->view('user/checkout', $data);
}

public function proses_checkout()
{
    // Validasi form
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
    $this->form_validation->set_rules('no_hp', 'No. HP', 'required');
    $this->form_validation->set_rules('alamat_lengkap', 'Alamat Lengkap', 'required');
    $this->form_validation->set_rules('provinsi', 'Provinsi', 'required');
    $this->form_validation->set_rules('kota', 'Kota', 'required');
    $this->form_validation->set_rules('tanggal', 'Tanggal Pesanan', 'required');
    $this->form_validation->set_rules('kurir', 'Layanan Kurir', 'required');
    $this->form_validation->set_rules('pembayaran', 'Metode Pembayaran', 'required');

    if ($this->form_validation->run() == FALSE) {
        $this->checkout();
    } else {
        // Ambil data form
        $data_pesanan = [
            'email' => $this->input->post('email'),
            'nama_lengkap' => $this->input->post('nama'),
            'no_hp' => $this->input->post('no_hp'),
            'alamat_lengkap' => $this->input->post('alamat_lengkap'),
            'provinsi' => $this->input->post('provinsi'),
            'kota' => $this->input->post('kota'),
            'tanggal_pesanan' => $this->input->post('tanggal'),
            'kurir' => $this->input->post('kurir'),
            'pembayaran' => $this->input->post('pembayaran'),
            'lensa' => implode(", ", $this->input->post('lensa')),
            'harga_lensa' => $this->input->post('harga_lensa_hidden'),
            'catatan' => $this->input->post('catatan'),
            'ongkir' => $this->input->post('ongkir'),
            'grand_total' => $this->input->post('grand_total'),
        ];

       // Upload bukti pembayaran
        $upload_bukti = '';
        if ($_FILES['bukti_pembayaran']['name']) {
            $config['upload_path'] = './uploads/bukti_pembayaran/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 2048;
            $this->upload->initialize($config);

            if ($this->upload->do_upload('bukti_pembayaran')) {
                $upload_bukti = $this->upload->data('file_name');
                $data_pesanan['bukti_pembayaran'] = $upload_bukti;
            }
        }

        // Upload resep dokter
        $upload_resep = '';
        if ($_FILES['gambar_resep']['name']) {
            $config['upload_path'] = './uploads/gambar_resep/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 2048;
            $this->upload->initialize($config);

            if ($this->upload->do_upload('gambar_resep')) {
                $upload_resep = $this->upload->data('file_name');
                $data_pesanan['gambar_resep'] = $upload_resep;
            } else {
                $error = $this->upload->display_errors();
                log_message('error', 'Upload resep gagal: ' . $error);
            }
        }


        // Simpan pesanan
        $this->load->model('Model_user_pesanan');
        $id_pesanan = $this->Model_user_pesanan->insert_pesanan($data_pesanan);

        // Ambil data checkout dari session
        $checkout_data = $this->session->userdata('checkout_data');

        // Siapkan model
        $this->load->model('Model_user_pesanan_detail');
        $this->load->model('ModelProduk');
        $this->load->model('Model_keranjang');
        $id_user = $this->session->userdata('id_user');

        // Simpan detail pesanan dan kurangi stok
        foreach ($checkout_data as $item) {
            $produk = $this->ModelProduk->get_produk_by_id($item['id_produk']);
            $harga = $produk ? $produk['harga'] : 0;

            $this->Model_user_pesanan_detail->insert_detail([
                'id_pesanan' => $id_pesanan,
                'id_produk' => $item['id_produk'],
                'qty' => $item['jumlah'],
                'harga' => $harga,
                'subtotal' => $harga * $item['jumlah']
            ]);

            // Kurangi stok produk
            $this->ModelProduk->kurangiJumlahProduk($item['id_produk'], $item['jumlah']);

            // Hapus dari keranjang
            $this->Model_keranjang->hapus_item_by_produk($id_user, $item['id_produk']);
        }

        // Hapus session checkout
        $this->session->unset_userdata('checkout_data');

        // Tampilkan pesan sukses
        $this->session->set_flashdata('success', 'Pesanan Anda berhasil diproses!');
        redirect('user/index');
    }
}




public function get_kota_by_provinsi()
{
    $id_provinsi = $this->input->post('id_provinsi');
    $data = $this->db->get_where('kota', ['id_provinsi' => $id_provinsi])->result();
    echo json_encode($data);
}

public function detail_pesanan($id)
{
    $data['title'] = 'Detail Pesanan';

    // Ambil data user yang sedang login
    $data['user'] = $this->db->get_where('user', [
        'email' => $this->session->userdata('email')
    ])->row_array();

    // Ambil data pesanan berdasarkan ID dan email user (untuk keamanan)
    $data['pesanan'] = $this->db->get_where('user_pesanan', [
        'id' => $id,
        'email' => $this->session->userdata('email')
    ])->row();

    // Tampilkan 404 jika tidak ditemukan
    if (!$data['pesanan']) {
        show_404();
    }

    // Load view detail pesanan
    $this->load->view('templates/user_header', $data);
    $this->load->view('user/detail_pesanan', $data);
    $this->load->view('templates/user_footer');
}

public function konfirmasi($id_pesanan)
{
    // Load model pesanan
    $this->load->model('Model_user_pesanan');

    // Ambil data pesanan berdasarkan ID
    $pesanan = $this->Model_user_pesanan->getPesananById($id_pesanan);

    // Cek apakah pesanan ditemukan
    if ($pesanan) {
        // Normalisasi status ke huruf kecil untuk konsistensi perbandingan
        $status = strtolower($pesanan['status']);

        // Jika status masih "dikirim", izinkan konfirmasi
        if ($status === 'kirim') {
            // Update status menjadi "selesai"
            $this->Model_user_pesanan->update_status($id_pesanan, ['status' => 'selesai']);
            $this->session->set_flashdata('success', 'Pesanan berhasil dikonfirmasi sebagai selesai.');
        } else {
            $this->session->set_flashdata('error', 'Pesanan tidak bisa dikonfirmasi. Status saat ini: ' . ucfirst($status) . '.');
        }
    } else {
        $this->session->set_flashdata('error', 'Data pesanan tidak ditemukan.');
    }

    // Redirect ke dashboard
    redirect('user/index');
}

// Fungsi untuk menampilkan profil pengguna
public function myprofile()
{
    $data['title'] = 'My Profile';
    $data['user'] = $this->db->get_where('user', [
        'email' => $this->session->userdata('email')
    ])->row_array();

    $this->load->view('templates/user_header', $data);
    $this->load->view('user/myprofile', $data);  // Updated to reflect the correct path
    $this->load->view('templates/footer');
}

}
