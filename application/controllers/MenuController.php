<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MenuController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MenuModel', 'menuModel');
    }

    public function index()
    {
        $data['menus'] = $this->menuModel->getAllMenu();
        $this->load->view('layouts/header');
        // We will pass the data to menu view later if needed, wait, menu.php might expect $menus.
        $this->load->view('menu', $data);
        $this->load->view('layouts/footer');
    }

    public function getByCategory()
    {
        $category = $this->input->get('category') ?? 'semua';
        if ($category === 'semua') {
            $menus = $this->menuModel->getAllMenu();
        } else {
            $menus = $this->menuModel->getMenuByCategory($category);
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($menus));
    }
}
?>