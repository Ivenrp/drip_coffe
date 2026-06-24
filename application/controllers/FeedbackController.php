<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FeedbackController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('FeedbackModel', 'feedbackModel');
    }

    public function index()
    {
        $data['feedbacks'] = $this->feedbackModel->getAllFeedback();
        $this->load->view('layouts/header');
        $this->load->view('kritik', $data);
        $this->load->view('layouts/footer');
    }

    public function submit()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $result = $this->feedbackModel->addFeedback($data);
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(['success' => $result]));
    }

    public function getAll()
    {
        $feedbacks = $this->feedbackModel->getAllFeedback();
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($feedbacks));
    }
}
?>