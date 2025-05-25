<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelProduk extends CI_Model {

    public function insert_produk($data) {
        return $this->db->insert('produk', $data);
    }

    public function get_all_produk() {
         $this->db->order_by('id_produk', 'DESC'); // Menampilkan produk terbaru di atas
        return $this->db->get('produk')->result_array();
    }
    
    public function get_produk_by_id($id){
    return $this->db->get_where('produk', ['id_produk' => $id])->row_array();
    }

    public function updateProduk($id_produk)
{
    $data = [
        'nama_produk' => $this->input->post('nama_produk', true),
        'deskripsi' => $this->input->post('deskripsi', true),
        'harga' => $this->input->post('harga', true),
        'jumlah_produk' => $this->input->post('jumlah_produk', true)
    ];

    // Cek kalau ada upload gambar baru
    if (!empty($_FILES['gambar']['name'])) {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 2048; // 2MB

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('gambar')) {
            $upload_data = $this->upload->data();
            $data['gambar'] = $upload_data['file_name'];
        } else {
            echo $this->upload->display_errors();
            die;
        }
    }

    $this->db->where('id_produk', $id_produk);
    $this->db->update('produk', $data);
}



    public function delete_produk($id)
    {
        // Akan ikut hapus di tabel 'keranjang' jika FK-nya ON DELETE CASCADE
        return $this->db->delete('produk', ['id_produk' => $id]);
    }

    public function find ($id)
    {
        $result = $this->db->where('id_produk', $id)
                             ->limit(1)
                             ->get('produk');
        if($result->num_rows() > 0){
            return $result->row();
        }else{
            return array();
        }
    }

    public function kurangiJumlahProduk($id_produk, $jumlah_dikurangi)
{
    $produk = $this->get_produk_by_id($id_produk);

    if ($produk) {
        $jumlah_sekarang = $produk['jumlah_produk'];
        $jumlah_baru = $jumlah_sekarang - $jumlah_dikurangi;

        if ($jumlah_baru < 0) {
            $jumlah_baru = 0; // Hindari stok minus
        }

        $this->db->where('id_produk', $id_produk);
        return $this->db->update('produk', ['jumlah_produk' => $jumlah_baru]);
    }

    return false;
}

}
