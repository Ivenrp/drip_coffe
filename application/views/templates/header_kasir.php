<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kasir Dashboard - DRIP*</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">DRIP* Kasir</a>
        <div class="d-flex">
            <span class="navbar-text me-3 text-white">Hello, <?= htmlspecialchars($this->session->userdata('name')) ?></span>
            <a href="<?= site_url('auth/logout') ?>" class="btn btn-outline-light btn-sm">Logout</a>
        </div>
    </div>
</nav>