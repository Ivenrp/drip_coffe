<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RiwayatController extends CI_Controller {
    public function index() {
        $this->load->view('layouts/header');
        $this->load->view('riwayat');
        $this->load->view('layouts/footer');
    }
}
?>
