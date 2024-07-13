<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Get all suppliers
    public function getSuppliers() {
        return $this->db->get('supplier')->result_array();
    }

    // Insert a new supplier
    public function insert_supplier($data) {
        return $this->db->insert('supplier', $data);
    }

    // Get supplier by ID
    public function get_supplier_by_id($id) {
        return $this->db->get_where('supplier', ['id' => $id])->row_array();
    }

    // Update supplier data by ID
    public function update_supplier($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('supplier', $data);
    }

    // Delete supplier by ID
    public function delete_supplier($id) {
        $this->db->where('id', $id);
        return $this->db->delete('supplier');
    }
}
?>
