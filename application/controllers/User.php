<?php
class User extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('user_id') || $this->session->userdata('role') != 'user') {
            redirect('auth/login');
        }
        $this->load->model('Product_model');
        $this->load->model('Order_model');
        $this->load->model('Feedback_model');
    }
    
    public function index() {
        $data['menus'] = $this->Product_model->get_all();
        $this->load->view('templates/header_user');
        $this->load->view('user/home', $data);
        $this->load->view('templates/footer_user');
    }
    
    public function menu() {
        $data['menus'] = $this->Product_model->get_all();
        $this->load->view('templates/header_user');
        $this->load->view('user/menu', $data);
        $this->load->view('templates/footer_user');
    }
    
    public function antrian() {
        $data['active_order'] = $this->Order_model->get_active_by_user($this->session->userdata('user_id'));
        $this->load->view('templates/header_user');
        $this->load->view('user/antrian', $data);
        $this->load->view('templates/footer_user');
    }
    
    public function riwayat() {
        $data['orders'] = $this->Order_model->get_history_by_user($this->session->userdata('user_id'));
        $this->load->view('templates/header_user');
        $this->load->view('user/riwayat', $data);
        $this->load->view('templates/footer_user');
    }
    
    public function kritik() {
        $data['feedbacks'] = $this->Feedback_model->get_all();
        $this->load->view('templates/header_user');
        $this->load->view('user/kritik', $data);
        $this->load->view('templates/footer_user');
    }
}