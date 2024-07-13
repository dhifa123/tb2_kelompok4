<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Produk_model', 'produkModel'); // Ensure the model name matches
    }

    public function index() {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Daftar Produk';
        $data['produk'] = $this->produkModel->getProduct();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('produk/index', $data);
        $this->load->view('templates/footer');
    }

    public function create() {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Tambah Produk';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('produk/create');
        $this->load->view('templates/footer');
    }
    
    public function store() {
        $data = array(
            'nama_barang' => $this->input->post('nama_barang'),
            'qty' => $this->input->post('qty')
        );
    
        $quantity = $this->input->post('qty');
        if (!$quantity) {
            $this->session->set_flashdata('error', 'Quantity harus diisi');
            redirect('produk/create');
            return;
        }

        $this->produkModel->insert_produk($data);
        
        redirect('produk/index');
    }

    public function edit($id_produk) {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Edit Produk';
        $data['produk'] = $this->produkModel->get_produk_by_id($id_produk);
    
        // Periksa apakah data produk ditemukan
        if (!$data['produk']) {
            // Handle jika data tidak ditemukan, bisa redirect atau tampilkan pesan error
            echo "Produk tidak ditemukan.";
            return;
        }
    
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('produk/edit', $data);
        $this->load->view('templates/footer');
    }
    
    


    public function update() {
        $id_produk = $this->input->post('id_produk');
        $data = array(
            'Nama_barang' => $this->input->post('Nama_barang'),
            'Qty' => $this->input->post('qty')
        );
        $this->produkModel->update_produk($id_produk, $data);
        redirect('produk/index');
    }


    public function delete($id_produk) {
        $delete = $this->produkModel->delete_produk($id_produk);
        if ($delete) {
            redirect('produk/index'); // Redirect ke halaman daftar produk setelah penghapusan berhasil
        } else {
            // Handle error jika penghapusan gagal
            echo "Gagal menghapus produk.";
        }
    }

}
?>
