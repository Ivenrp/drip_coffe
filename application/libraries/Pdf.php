<?php
require_once FCPATH.'vendor/autoload.php';
use Dompdf\Dompdf;
class Pdf {
    public function loadHtml($html) {
        $this->dompdf = new Dompdf();
        $this->dompdf->loadHtml($html);
    }
    public function render() {
        $this->dompdf->render();
    }
    public function stream($filename) {
        $this->dompdf->stream($filename);
    }
}