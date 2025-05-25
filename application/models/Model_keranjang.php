<?php
class Model_keranjang extends CI_Model
{
    // Menambahkan produk ke keranjang
    public function tambah_ke_keranjang($data)
    {
        return $this->db->insert('keranjang', $data);
    }

    // Mendapatkan data keranjang berdasarkan user
    public function get_keranjang_user($id_user)
    {
        $this->db->select('k.*, p.nama_produk, p.harga, p.gambar');
        $this->db->from('keranjang k');
        $this->db->join('produk p', 'k.id_produk = p.id_produk');
        $this->db->where('k.id_user', $id_user);

        $query = $this->db->get();

        // Debug log query (opsional, bisa dihapus jika tidak digunakan)
        log_message('debug', 'SQL Query: ' . $this->db->last_query());

        return $query->result();
    }

    // Menghapus item berdasarkan ID keranjang
    public function hapus_item($id_keranjang)
    {
        return $this->db->delete('keranjang', ['id_keranjang' => $id_keranjang]);
    }

    // Memperbarui jumlah item di keranjang
    public function update_qty($id_keranjang, $qty)
    {
        if ($qty <= 0) {
            return false;
        }

        return $this->db->update('keranjang', ['jumlah' => $qty], ['id_keranjang' => $id_keranjang]);
    }

    // Mengosongkan seluruh keranjang untuk user tertentu
    public function kosongkan_keranjang($id_user)
    {
        return $this->db->delete('keranjang', ['id_user' => $id_user]);
    }

    // Cek apakah produk sudah ada di keranjang
    public function cek_keranjang_exists($id_user, $id_produk)
    {
        $this->db->where('id_user', $id_user);
        $this->db->where('id_produk', $id_produk);
        $query = $this->db->get('keranjang');
        return $query->num_rows() > 0;
    }

    // Menambahkan jumlah produk jika sudah ada di keranjang
    public function update_keranjang($id_user, $id_produk, $jumlah)
    {
        $this->db->set('jumlah', 'jumlah+' . (int)$jumlah, FALSE);
        $this->db->where('id_user', $id_user);
        $this->db->where('id_produk', $id_produk);
        return $this->db->update('keranjang');
    }

    // Model_keranjang - Tambahkan fungsi untuk menghapus produk berdasarkan id_user dan id_produk
public function hapus_item_by_produk($id_user, $id_produk)
{
    $this->db->where('id_user', $id_user);
    $this->db->where('id_produk', $id_produk);
    return $this->db->delete('keranjang');
}
}
