<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produksupplier extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Produksupplier_model', 'produkSupplier');
        $this->load->model('Supplier_model', 'Supplier');
    }

    public function index()
    {
        // Get user data from session
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        
        // Set page title
        $data['title'] = 'Daftar Produk Supplier';

        // Get product suppliers from model
        $data['produksupplier'] = $this->produkSupplier->getProductSupplier();

        // Load views with data
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('produksupplier/index', $data);
        $this->load->view('templates/footer');
        $this->load->model('Produksupplier_model', 'produk_supplier');

    }

    public function create()
    {
        // Get user data from session
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        
        // Set page title
        $data['title'] = 'Tambah Produk Supplier';

        // Get suppliers and products from models
        $data['supplier'] = $this->Supplier->getSuppliers();
        $data['produk'] = $this->produkSupplier->getProducts();

        // Load views with data
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('produksupplier/create', $data);
        $this->load->view('templates/footer');
    }

    public function store()
    {
        // Retrieve input data from form
        $supplier_id = $this->input->post('supplier');
        $product_ids = $this->input->post('product_name');
        $prices = $this->input->post('price');

        // Prepare data array for batch insertion
        $data = [];
        foreach ($product_ids as $key => $product_id) {
            if (!empty($product_id) && !empty($prices[$key])) {
                $data[] = [
                    'supplier_id' => $supplier_id,
                    'produk_id' => $product_id,
                    'price' => $prices[$key]
                ];
            }
        }

        // Insert data into database using model method
        if ($this->produkSupplier->insert_products($data)) {
            $this->session->set_flashdata('pesan', 'Data produk supplier berhasil disimpan.');
            redirect('produksupplier/create');
        } else {
            $this->session->set_flashdata('pesan', 'Gagal menyimpan data.');
            redirect('produksupplier/create');
        }
    }
    public function delete($id)
    {
        // Lakukan penghapusan produk supplier berdasarkan ID
        $delete = $this->produkSupplier->delete_produk_supplier($id);
        if ($delete) {
            $this->session->set_flashdata('pesan', 'Data produk supplier berhasil dihapus.');
        } else {
            $this->session->set_flashdata('pesan', 'Gagal menghapus data.');
        }
        redirect('produksupplier/index'); // Redirect ke halaman daftar produk supplier setelah penghapusan berhasil
    }
    
}
    
?>
