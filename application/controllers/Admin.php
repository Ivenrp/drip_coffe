<?php
use Dompdf\Dompdf;
use Dompdf\Options;

class Admin extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('user_id') || $this->session->userdata('role') != 'admin') {
            redirect('auth/login');
        }
        $this->load->model('Product_model');
        $this->load->model('Transaction_model');
        $this->load->model('User_model');
        $this->load->model('Order_model');
    }
    
    public function index() {
        // Dashboard admin: chart, laba
        $data['total_income'] = $this->Transaction_model->get_summary(date('Y-m-01'), date('Y-m-t'))['total'] ?? 0;
        $data['daily_data'] = $this->Transaction_model->get_daily_summary(date('Y-m-d'));
        $this->load->view('templates/header_admin');
        $this->load->view('admin/dashboard', $data);
        $this->load->view('templates/footer_admin');
    }
    
    public function products() {
        $data['products'] = $this->Product_model->get_all();
        $this->load->view('templates/header_admin');
        $this->load->view('admin/products', $data);
        $this->load->view('templates/footer_admin');
    }
    
    public function add_product() {
        // Upload gambar
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('image')) {
            $upload_data = $this->upload->data();
            $image_url = base_url('uploads/' . $upload_data['file_name']);
        } else {
            $image_url = null;
        }
        $data = [
            'name' => $this->input->post('name'),
            'category' => $this->input->post('category'),
            'price' => $this->input->post('price'),
            'emoji' => $this->input->post('emoji'),
            'description' => $this->input->post('description'),
            'image_url' => $image_url
        ];
        $this->Product_model->create($data);
        redirect('admin/products');
    }
    
    public function edit_product($id) {
        // Similar
    }
    
    public function delete_product($id) {
        $this->Product_model->delete($id);
        redirect('admin/products');
    }
    
     public function export_pdf() {
        // Ambil data laporan
        $data['orders'] = $this->Order_model->get_all_orders();
        $data['total_revenue'] = $this->Order_model->sum_revenue();
        $data['total_orders'] = $this->Order_model->count_all();

        // Load view laporan (HTML)
        $html = $this->load->view('admin/laporan_pdf', $data, TRUE);

        // Konfigurasi DOMPDF
        $options = new Options();
        $options->set('defaultFont', 'sans-serif');
        $dompdf = new Dompdf($options);

        // Load HTML ke DOMPDF
        $dompdf->loadHtml($html);

        // (Opsional) Set ukuran kertas dan orientasi
        $dompdf->setPaper('A4', 'landscape');

        // Render PDF
        $dompdf->render();

        // Output ke browser (download)
        $dompdf->stream("laporan_penjualan_" . date('Y-m-d') . ".pdf", array("Attachment" => 1));
        // Attachment = 1 => download, 0 => tampil di browser
    }
    
    public function users() {
        $data['users'] = $this->User_model->get_all();
        $this->load->view('templates/header_admin');
        $this->load->view('admin/users', $data);
        $this->load->view('templates/footer_admin');
    }
}