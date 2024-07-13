<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getProduct() {
        return $this->db->get('produk')->result_array();
    }

    public function insert_produk($data) {
        return $this->db->insert('produk', $data);
    }

    public function get_produk_by_id($id_produk) {
        return $this->db->get_where('produk', ['id_produk' => $id_produk])->row_array();
    }
    
    public function update_produk($id_produk, $data) {
        $this->db->where('id_produk', $id_produk);
        return $this->db->update('produk', $data);
    }


    public function delete_produk($id_produk) {
        $this->db->trans_begin();

        // Hapus terlebih dahulu semua entri yang terkait di tabel terkait (jika ada)
        // Contoh: Hapus dari tabel produk_supplier, purchase_orders, dll.

        // Hapus produk dari tabel produk
        $this->db->delete('produk', array('id_produk' => $id_produk));

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function get_nama_qty($id_produk) {
        $this->db->select('nama_barang, qty');
        $query = $this->db->get_where('produk', ['id_produk' => $id_produk]);
        return $query->row_array();
    }

}
?>
