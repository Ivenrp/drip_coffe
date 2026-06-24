<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'drip';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// User routes (public)
$route['menu'] = 'drip/menu';
$route['antrian'] = 'drip/antrian';
$route['riwayat'] = 'drip/riwayat';
$route['kritik'] = 'drip/kritik';
$route['submit_order_ajax'] = 'drip/submit_order_ajax';

// Auth routes
$route['auth/login'] = 'auth/login';
$route['auth/do_login'] = 'auth/do_login';
$route['auth/logout'] = 'auth/logout';

// Kasir & Admin (akan diisi nanti)
$route['kasir'] = 'kasir/index';
$route['admin'] = 'admin/index';
$route['admin/export'] = 'admin/export_pdf';