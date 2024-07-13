<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Purchaseorder_model extends CI_Model
{

    // application/models/Purchaseorder_model.php

    // application/models/Purchaseorder_model.php

// application/models/Purchaseorder_model.php

public function getAllPurchaseOrders()
{
    $this->db->select('purchase_orders.id, purchase_orders.supplier_id, supplier.Nama_Supplier, produk.Nama_barang, purchase_orders.Qty, purchase_orders.harga, purchase_orders.tgl_po');
    $this->db->from('purchase_orders');
    $this->db->join('produk', 'produk.id_produk = purchase_orders.id_produk', 'left');
    $this->db->join('supplier', 'supplier.id = purchase_orders.supplier_id', 'left'); // Join dengan tabel supplier
    // Tambahkan join atau kondisi lain sesuai kebutuhan
    $query = $this->db->get();
    return $query->result_array();
}


    public function insert_purchase_order($data)
    {
        // Menyimpan data pembelian ke dalam tabel purchase_orders
        return $this->db->insert('purchase_orders', $data);
    }

    

    // Tambahkan method lain sesuai kebutuhan

}
?>
