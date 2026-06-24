<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Drip extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('MenuModel');
        $this->load->model('OrderModel');
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function index()
    {
        $this->home();
    }

    public function home()
    {
        $data['title'] = 'Home - DRIP* Coffee';
        $this->load->view('layouts/header', $data);
        $this->load->view('drip/home');
        $this->load->view('layouts/footer');
    }

    public function menu()
    {
        $data['menus'] = $this->MenuModel->getAllMenu();
        $data['title'] = 'Menu - DRIP* Coffee';

        $this->load->view('layouts/header', $data);
        $this->load->view('drip/menu', $data);
        $this->load->view('layouts/footer');
    }

    public function antrian()
    {
        $user_id = $this->session->userdata('user_id');
        $data['active_order'] = null;

        if ($user_id) {
            $data['active_order'] = $this->OrderModel->getActiveOrder();
        } else {
            $session_order = $this->session->userdata('current_order');
            if ($session_order) {
                $this->db->where('id', $session_order['id']);
                $data['active_order'] = $this->db->get('orders')->row_array();
            }
        }

        $data['title'] = 'Antrian - DRIP* Coffee';
        $this->load->view('layouts/header', $data);
        $this->load->view('drip/antrian', $data);
        $this->load->view('layouts/footer');
    }

    public function riwayat()
    {
        $user_id = $this->session->userdata('user_id');
        $data['orders'] = [];

        if ($user_id) {
            $data['orders'] = $this->OrderModel->getOrderHistory();
        }

        $data['title'] = 'Riwayat - DRIP* Coffee';
        $this->load->view('layouts/header', $data);
        $this->load->view('drip/riwayat', $data);
        $this->load->view('layouts/footer');
    }
}
