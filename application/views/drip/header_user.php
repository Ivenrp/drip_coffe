<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DRIP* — Good Coffee Vibes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
    <style>
        body { user-select: none; }
        input, textarea, select { user-select: text !important; }
    </style>
</head>
<body>
<!-- Ticker & Navbar sama seperti sebelumnya -->
<nav class="navbar navbar-expand-lg sticky-top bg-cream border-bottom">
    <div class="container-fluid px-4">
        <div class="nav-logo" onclick="location.href='<?= base_url('user') ?>'">DRIP<span>*</span></div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="<?= base_url('user') ?>">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= base_url('user/menu') ?>">Menu</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= base_url('user/antrian') ?>">Antrian</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= base_url('user/riwayat') ?>">Riwayat</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= base_url('user/kritik') ?>">Kritik</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= base_url('auth/logout') ?>">Logout</a></li>
            </ul>
        </div>
        <div class="cart-bubble ms-3" onclick="toggleCart()">
            🛒 keranjang <span class="count" id="cartCount">0</span>
        </div>
    </div>
</nav>
<div class="page-container">