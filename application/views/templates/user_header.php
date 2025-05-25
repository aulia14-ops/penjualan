<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
</head>
<body>
<?php 
    $CI = &get_instance(); // Ambil instance CodeIgniter
    $role_id = $CI->session->userdata('role_id'); 
    $name = $CI->session->userdata('name') ?? 'User';
    $image = $CI->session->userdata('image') ?? 'default.jpg';
?>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
    <div class="container">
        <a class="navbar-brand" href="<?= base_url(); ?>">
            <i class="fas fa-glasses me-2"></i>Optik Mahandra
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item me-2">
                    <a class="nav-link <?= ($this->uri->segment(2) == 'index' || $this->uri->segment(2) == '') ? 'fw-bold' : '' ?>" href="<?= base_url('user/index'); ?>">
                        <i class="fas fa-home fa-fw me-1"></i> Beranda
                    </a>
                </li>
                <li class="nav-item me-2">
                    <a class="nav-link <?= ($this->uri->segment(2) == 'produk') ? 'fw-bold' : '' ?>" href="<?= base_url('user/produk'); ?>">
                        <i class="fas fa-shopping-bag fa-fw me-1"></i> All Produk
                    </a>
                </li>
                <li class="nav-item me-3">
                    <a class="nav-link position-relative <?= ($this->uri->segment(2) == 'keranjang') ? 'fw-bold' : '' ?>" href="<?= base_url('user/keranjang'); ?>">
                        <i class="fas fa-shopping-cart fa-fw"></i>
                    </a>
                </li>
                <li class="nav-item me-2">
                    <a class="nav-link user-profile-link <?= ($this->uri->segment(2) == 'myprofile') ? 'fw-bold' : '' ?>" href="<?= base_url('user/myprofile'); ?>">
                        <span class="d-none d-lg-inline me-2"><?= isset($user['name']) ? $user['name'] : 'Guest'; ?></span>
                        <img class="rounded-circle" src="<?= base_url('assets/img/profile/') . $user['image']; ?>" alt="User Profile" width="32" height="32" style="object-fit: cover;">
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link logout-link" href="logout" data-bs-toggle="modal" data-bs-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-fw me-1"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Logout Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="logoutModalLabel">Konfirmasi Logout</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-4">
                <div class="text-center mb-3">
                    <i class="fas fa-sign-out-alt fa-3x text-muted mb-3"></i>
                    <p class="mb-0">Apakah Anda yakin ingin keluar dari sistem?</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Batal</button>
                <a class="btn btn-primary px-4" href="<?= base_url('auth/logout'); ?>">Logout</a>
            </div>
        </div>
    </div>
</div>

<div class="container mt-4">
    <!-- Content section -->
</div>

<!-- Bootstrap Bundle JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>