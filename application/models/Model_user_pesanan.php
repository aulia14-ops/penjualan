<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_user_pesanan extends CI_Model {

    // Insert pesanan
    public function insert_pesanan($data)
    {
        $this->db->insert('user_pesanan', $data);
        return $this->db->insert_id(); // id_user_pesanan
    }

    // Insert detail pesanan
    public function insert_detail_pesanan($data)
    {
        $this->db->insert('user_pesanan_detail', $data);
    }

    // Ambil semua pesanan
    public function getAllPesanan()
    {
        $this->db->where('status !=', 'dibatalkan');
        $this->db->order_by('tanggal_pesanan', 'DESC'); // Atau 'id' jika ingin berdasarkan ID
        return $this->db->get('user_pesanan')->result_array();
    }


    // Ambil data pesanan berdasarkan ID
    public function getPesananById($id)
    {
        return $this->db->get_where('user_pesanan', ['id' => $id])->row_array();
    }

    // Ambil semua item produk yang termasuk dalam 1 pesanan
    public function getDetailItemByPesananId($id)
    {
        return $this->db->get_where('user_pesanan_detail', ['id_pesanan' => $id])->result_array();
    }

    // Fungsi untuk mengambil pesanan beserta detail produk
   public function get_pesanan_with_details($id_pesanan) 
{
    $this->db->select('user_pesanan.*, user_pesanan_detail.nama_produk, user_pesanan_detail.qty, user_pesanan_detail.harga, user_pesanan_detail.gambar');
    $this->db->from('user_pesanan');
    $this->db->join('user_pesanan_detail', 'user_pesanan_detail.id_pesanan = user_pesanan.id');
    $this->db->where('user_pesanan.id', $id_pesanan);
    return $this->db->get()->result_array();
}

public function update_status($id_pesanan, $data)
{
    $this->db->where('id', $id_pesanan);
    return $this->db->update('user_pesanan', $data);
}

public function update_resi($id_pesanan, $data)
{
    $this->db->where('id', $id_pesanan); // sesuaikan dengan primary key Anda
    $this->db->update('user_pesanan', $data);
}

 public function get_laporan() { 
    $this->db->select('id, tanggal_pesanan, email, nama_lengkap, no_hp, provinsi, kota, alamat_lengkap, lensa, harga_lensa, catatan, kurir, ongkir, pembayaran, grand_total, status, no_resi');
    $this->db->from('user_pesanan');
    $this->db->where('status', 'Selesai'); // Hanya ambil pesanan dengan status Selesai
    $this->db->order_by('tanggal_pesanan', 'DESC');
    $query = $this->db->get();
    return $query->result();
}




}
