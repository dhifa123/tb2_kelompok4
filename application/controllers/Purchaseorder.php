<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Purchaseorder extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Load necessary models, libraries, helpers here if needed
        $this->load->model('Purchaseorder_model', 'purchaseOrder');
        $this->load->model('Produk_model', 'produk');
        $this->load->model('Produksupplier_model', 'produksupplier');
    }

    public function index()
    {
        $data['title'] = 'List Purchase Orders'; // Define title variable
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(); // Example of getting user data from session

        $data['purchase_orders'] = $this->purchaseOrder->getAllPurchaseOrders();
        // Load view with data
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data); // Pass $data to sidebar.php
        $this->load->view('templates/topbar', $data); // Pass $data to topbar.php
        $this->load->view('purchaseorder/index', $data); // Pass $data to index.php
        $this->load->view('templates/footer');
    }

    public function add()
    {
        $data['supplier_produk'] = $this->produksupplier->get_supplier_products(); // Correct model alias and method
        $data['title'] = 'Add Purchase Order';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // Load view with data
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('purchaseorder/add', $data);
        $this->load->view('templates/footer');
    }

    public function store()
{
    $supplier_id = $this->input->post('supplier');
    $produk_ids = $this->input->post('produk'); // Menangani multiple produk
    $quantity = $this->input->post('quantity');
    $harga = $this->input->post('harga');
    $total_po = $this->input->post('total_po');
    $total_tagihan = $this->input->post('total_tagihan');
    $po_date = $this->input->post('po_date');

    // Lakukan perulangan untuk setiap produk yang dipilih
    foreach ($produk_ids as $produk_id) {
        $data = [
            'supplier_id' => $supplier_id,
            'id_produk' => $produk_id,
            'Qty' => $quantity,
            'harga' => $harga,
            'tgl_po' => $po_date,
            // Add other fields as needed
        ];

        // Panggil model untuk melakukan insert
        if (!$this->purchaseOrder->insert_purchase_order($data)) {
            // Jika gagal, set flash data pesan error
            $this->session->set_flashdata('pesan', 'Gagal menambahkan Purchase Order.');
            redirect('purchaseorder/add');
            return; // Keluar dari method
        }
    }

    // Jika berhasil untuk semua produk, set flash data pesan sukses
    $this->session->set_flashdata('pesan', 'Purchase Order berhasil ditambahkan.');
    redirect('purchaseorder');
}
    public function get_products_by_supplier($supplier_id)
    {
        $products = $this->produksupplier->getProductsBySupplierId($supplier_id);
        echo json_encode($products);
    }
    public function get_product_price($produk_id, $supplier_id)
    {
        $product_price = $this->produksupplier->getProductPrice($produk_id, $supplier_id);
    
        if ($product_price) {
            echo json_encode(['price' => $product_price]);
        } else {
            echo json_encode(['price' => '']);
        }
    }
 

    // Redirect atau tampilkan pesan sukses setelah insert
}



?>
