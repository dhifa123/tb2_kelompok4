<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produksupplier_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getProductSupplier()
    {
        $this->db->select('produk_supplier.id, produk_supplier.produk_id, produk_supplier.supplier_id, produk.Nama_barang, produk_supplier.price, produk.Qty');
        $this->db->from('produk_supplier');
        $this->db->join('produk', 'produk_supplier.produk_id = produk.id_produk');
        return $this->db->get()->result_array();
    }
    public function getProdukSupplierById($id)
    {
        // Ambil data produk supplier berdasarkan ID
        $query = $this->db->get_where('produk_supplier', array('id' => $id));
        return $query->row_array();
    }

    public function getProductSupplierByName($keyword)
    {
        $this->db->select('*');
        $this->db->from('supplier');
        $this->db->join('produk_supplier', 'supplier.id = produk_supplier.supplier_id');
        $this->db->join('produk', 'produk_supplier.produk_id = produk.id_produk');
        $this->db->where('supplier.Nama_Supplier', $keyword);
        return $this->db->get()->result_array();
    }

    public function insert_products($data)
    {
        return $this->db->insert_batch('produk_supplier', $data);
    }

    public function getProducts()
    {
        return $this->db->get('produk')->result_array();
    }
    public function getSupplierWithProducts()
{
    $query = "SELECT `supplier`.`id`, `supplier`.`Nama_Supplier`, `produk`.`id_produk`, `produk`.`Nama_barang`, `produk_supplier`.`price`
              FROM `supplier`
              JOIN `produk_supplier` ON `supplier`.`id` = `produk_supplier`.`supplier_id`
              JOIN `produk` ON `produk_supplier`.`produk_id` = `produk`.`id_produk`";
              
    return $this->db->query($query)->result_array();
}
public function delete_produk_supplier($id)
{
    // Query untuk menghapus data produk supplier berdasarkan ID
    return $this->db->delete('produk_supplier', array('id' => $id));
}
public function getProductsBySupplierId($supplier_id)
{
    $this->db->select('produk.id_produk, produk.Nama_barang');
    $this->db->from('produk_supplier');
    $this->db->join('produk', 'produk_supplier.produk_id = produk.id_produk');
    $this->db->where('produk_supplier.supplier_id', $supplier_id);
    return $this->db->get()->result_array();
}
public function get_supplier_products()
{
    // Your logic to get supplier products
    $this->db->select('*');
    $this->db->from('produk_supplier');
    $this->db->join('supplier', 'produk_supplier.supplier_id = supplier.id');
    $this->db->join('produk', 'produk_supplier.produk_id = produk.id_produk');
    return $this->db->get()->result_array();
}
public function getProductPrice($produk_id, $supplier_id)
    {
        $this->db->select('price');
        $this->db->where('produk_id', $produk_id);
        $this->db->where('supplier_id', $supplier_id);
        $query = $this->db->get('produk_supplier');

        if ($query->num_rows() == 1) {
            return $query->row()->price;
        } else {
            return null; // or handle error as needed
        }
    }
}
?>
