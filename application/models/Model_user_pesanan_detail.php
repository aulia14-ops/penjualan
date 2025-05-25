<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_user_pesanan_detail extends CI_Model
{
    public function insert_detail($data)
     {
        // Hitung subtotal jika belum dihitung
        if (!isset($data['subtotal'])) {
            $data['subtotal'] = $data['qty'] * $data['harga'];
        }

        return $this->db->insert('user_pesanan_detail', $data);
     }
     
    
}
