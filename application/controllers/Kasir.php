<?php
class Kasir extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('user_id') || $this->session->userdata('role') != 'kasir') {
            redirect('auth/login');
        }
        $this->load->model('Product_model');
        $this->load->model('Order_model');
        $this->load->model('Transaction_model');
    }
    
    public function index() {
        $data['orders'] = $this->Order_model->get_all_pending();
        $this->load->view('templates/header_kasir');
        $this->load->view('kasir/dashboard', $data);
        $this->load->view('templates/footer_kasir');
    }
    
    public function order_detail($order_id) {
        $data['order'] = $this->Order_model->get_with_items($order_id);
        $this->load->view('kasir/order_detail', $data);
    }
    
    public function add_item() {
        // AJAX: tambah item ke pesanan
    }
    
    public function remove_item() {
        // AJAX
    }
    
    public function print_struk($order_id) {
        // Generate PDF atau window.print
        $data['order'] = $this->Order_model->get_with_items($order_id);
        $this->load->view('kasir/struk', $data);
    }
    
    public function bayar($order_id) {
        // Proses pembayaran dan insert ke transactions
        $order = $this->Order_model->get($order_id);
        $data = [
            'order_id' => $order_id,
            'kasir_id' => $this->session->userdata('user_id'),
            'total' => $order['total'],
            'payment_method' => $this->input->post('payment_method'),
            'status' => 'paid'
        ];
        $this->Transaction_model->create($data);
        $this->Order_model->update_status($order_id, 'completed');
        redirect('kasir');
    }
}