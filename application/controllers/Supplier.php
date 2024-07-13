<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Supplier_model', 'supplierModel');
    }

    public function index() {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Daftar Supplier';
        $data['supplier'] = $this->supplierModel->getSuppliers();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('supplier/index', $data);
        $this->load->view('templates/footer');
    }

    public function create() {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Tambah Supplier';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('supplier/add'); // Memuat view create.php
        $this->load->view('templates/footer');
    }
    
    public function store() {
        // Validasi form
        $this->form_validation->set_rules('nama_supplier', 'Nama Supplier', 'required');
        $this->form_validation->set_rules('no_telp', 'Nomor Telepon', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, tampilkan kembali form dengan error
            $this->load->view('supplier/create');
        } else {
            // Jika validasi berhasil, simpan data ke database
            $data = array(
                'Nama_Supplier' => $this->input->post('nama_supplier'),
                'no_telp' => $this->input->post('no_telp'),
                'Alamat_Supllier' => $this->input->post('alamat')
            );

            $this->supplierModel->insert_supplier($data);

            // Tampilkan pesan sukses
            $this->session->set_flashdata('pesan', 'Data supplier berhasil disimpan.');
            redirect('supplier'); // Redirect ke halaman daftar supplier
        }
    }

    public function edit($id) {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Edit Supplier';
        $data['supplier'] = $this->supplierModel->get_supplier_by_id($id);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('supplier/edit', $data);
        $this->load->view('templates/footer');
    }

    public function update() {
        $id = $this->input->post('id');
        $data = array(
            'Nama_Supplier' => $this->input->post('Nama_Supplier'),
            'no_telp' => $this->input->post('no_telp'),
            'alamat' => $this->input->post('alamat')
        );
        $this->supplierModel->update_supplier($id, $data);
        redirect('supplier');
    }
    public function delete($id) {
        // Call delete_supplier() method from Supplier_model
        $result = $this->supplierModel->delete_supplier($id);

        if ($result) {
            // Redirect or set flash message for successful deletion
            redirect('supplier/index');
        } else {
            // Handle deletion failure
            echo "Failed to delete supplier!";
        }
    }
    
}
?>
