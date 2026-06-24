<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DRIP* — Good Coffee Vibes</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,300;0,400;0,600;0,700;0,800;0,900;1,300;1,400&family=DM+Mono:ital,wght@0,300;0,400;1,300&display=swap"
        rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
    <script>
        const SITE_URL = "<?= site_url() ?>";
    </script>
</head>

<body>

    <!-- TICKER -->
    <div class="ticker">
        <div class="ticker-inner" id="tickerInner">
            <span class="ticker-item">☕ DRIP* COFFEE — PURWOKERTO</span>
            <span class="ticker-item">✦ OPEN 07:00–22:00</span>
            <span class="ticker-item">✦ SEMUA DIPILIH DENGAN SERIUS</span>
            <span class="ticker-item">✦ V60 · POUR OVER · ESPRESSO</span>
            <span class="ticker-item">☕ DRIP* COFFEE — PURWOKERTO</span>
            <span class="ticker-item">✦ OPEN 07:00–22:00</span>
            <span class="ticker-item">✦ SEMUA DIPILIH DENGAN SERIUS</span>
            <span class="ticker-item">✦ V60 · POUR OVER · ESPRESSO</span>
        </div>
    </div>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg sticky-top bg-cream border-bottom">
        <div class="container-fluid px-4">
            <div class="nav-logo" style="cursor:pointer;" onclick="showPage('home')">DRIP<span>*</span></div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav gap-2">
                    <li class="nav-item"><a class="nav-link <?= $this->uri->segment(1) == '' ? 'active' : '' ?>" href="<?= site_url() ?>">home</a></li>
                    <li class="nav-item"><a class="nav-link <?= $this->uri->segment(1) == 'menu' ? 'active' : '' ?>" href="<?= site_url('menu') ?>">menu</a></li>
                    <li class="nav-item"><a class="nav-link <?= $this->uri->segment(1) == 'antrian' ? 'active' : '' ?>" href="<?= site_url('antrian') ?>">antrian</a></li>
                    <li class="nav-item"><a class="nav-link <?= $this->uri->segment(1) == 'riwayat' ? 'active' : '' ?>" href="<?= site_url('riwayat') ?>">riwayat</a></li>
                    <li class="nav-item"><a class="nav-link <?= $this->uri->segment(1) == 'kritik' ? 'active' : '' ?>" href="<?= site_url('kritik') ?>">kritik</a></li>
                </ul>
            </div>
            <div class="cart-bubble ms-3" onclick="toggleCart()">
                🛒 keranjang
                <span class="count" id="cartCount">0</span>
            </div>
            <?php if ($this->session->userdata('user_id')): ?>
                <div class="d-flex align-items-center gap-2 ms-3">
                    <a href="<?= site_url('dashboard') ?>" class="btn btn-dark btn-sm d-flex align-items-center gap-2">
                        <i class="fa-solid fa-user"></i> <?= htmlspecialchars($this->session->userdata('name')) ?>
                    </a>
                    <a href="<?= site_url('auth/logout') ?>" class="btn btn-outline-danger btn-sm" title="Logout">
                        <i class="fa-solid fa-power-off"></i>
                    </a>
                </div>
            <?php else: ?>
                <a href="<?= site_url('auth/login') ?>" class="btn btn-outline-dark ms-3 btn-sm d-flex align-items-center gap-2">
                    <i class="fa-solid fa-right-to-bracket"></i> Login
                </a>
            <?php endif; ?>
        </div>
    </nav>

    <!-- Page Container -->
    <div class="page-container">