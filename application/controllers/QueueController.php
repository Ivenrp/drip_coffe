<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class QueueController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('QueueModel', 'queueModel');
    }

    public function index()
    {
        $this->load->view('layouts/header');
        $this->load->view('antrian');
        $this->load->view('layouts/footer');
    }

    public function getStatus()
    {
        $activeOrder = $this->session->userdata('current_order') ?? null;
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($activeOrder));
    }

    public function updateStatus()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $result = $this->queueModel->updateOrderStatus($data['order_id'], $data['status']);
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(['success' => $result]));
    }
}
?>