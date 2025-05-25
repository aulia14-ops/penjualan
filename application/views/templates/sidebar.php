<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('dashboard'); ?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-glasses"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Optik Mahandra</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <?php if ($user['role_id'] == 1) : ?>
    <!-- Heading -->
        <div class="sidebar-heading">
            Administrator
        </div>

        <!-- Nav Item - Dashboard -->
        <li class="nav-item <?= $title == 'Dashboard' ? 'active' : ''; ?>">
            <a class="nav-link d-block <?= $title == 'Dashboard' ? 'fw-bold' : ''; ?>" href="<?= base_url('admin'); ?>">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>

         <!-- Nav Item - Data Customer -->
        <li class="nav-item <?= $title == 'Data Customer' ? 'active' : ''; ?>">
            <a class="nav-link d-block <?= $title == 'Data Customer' ? 'fw-bold' : ''; ?>" href="<?= base_url('admin/data_customer'); ?>">
                <i class="fas fa-user"></i>
                <span>Data Customer</span>
            </a>
        </li>

         <!-- Nav Item - Kelola Admin -->
        <li class="nav-item <?= $title == 'Kelola Admin' ? 'active' : ''; ?>">
            <a class="nav-link d-block <?= $title == 'Kelola Admin' ? 'fw-bold' : ''; ?>" href="<?= base_url('admin/kelola_admin'); ?>">
                <i class="fas fa-user"></i>
                <span>Kelola Admin</span>
            </a>
        </li>

        <!-- Nav Item - Kelola Produk -->
        <li class="nav-item <?= $title == 'Kelola Produk' ? 'active' : ''; ?>">
            <a class="nav-link d-block <?= $title == 'Kelola Produk' ? 'fw-bold' : ''; ?>" href="<?= base_url('admin/produk'); ?>">
                <i class="fas fa-box"></i>
                <span>Kelola Produk</span>
            </a>
        </li>

        <!-- Nav Item - Kelola Pesanan -->
        <li class="nav-item <?= $title == 'Kelola Pesanan' ? 'active' : ''; ?>">
            <a class="nav-link d-block <?= $title == 'Kelola Pesanan' ? 'fw-bold' : ''; ?>" href="<?= base_url('admin/pesanan'); ?>">
                <i class="fas fa-shopping-cart"></i>
                <span>Kelola Pesanan</span>
            </a>
        </li>

        <!-- Nav Item - Laporan Pesanan -->
        <li class="nav-item <?= $title == 'Laporan Pesanan' ? 'active' : ''; ?>">
            <a class="nav-link d-block <?= $title == 'Laporan Pesanan' ? 'fw-bold' : ''; ?>" href="<?= base_url('admin/laporan'); ?>">
                <i class="fas fa-chart-bar"></i>
                <span>Laporan Pesanan</span>
            </a>
        </li>

<?php else : ?>
    <!-- Heading -->
    <div class="sidebar-heading">
        Customer
    </div>
<?php endif; ?>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Profile Admin
</div>

<!-- Nav Item - My Profile -->
<li class="nav-item <?= $title == 'My Profile' ? 'active' : ''; ?>">
    <a class="nav-link d-block <?= $title == 'My Profile' ? 'fw-bold' : ''; ?>" href="<?= base_url('admin/myprofile'); ?>">
        <i class="fas fa-user"></i>
        <span>My Profile</span>
    </a>
</li>

<!-- Nav Item - Edit Profile -->
<li class="nav-item <?= $title == 'Edit Profile' ? 'active' : ''; ?>">
    <a class="nav-link d-block <?= $title == 'Edit Profile' ? 'fw-bold' : ''; ?>" href="<?= base_url('admin/editprofile'); ?>">
        <i class="fas fa-user-edit"></i>
        <span>Edit Profile</span>
    </a>
</li>

<!-- Nav Item - Change Password -->
<li class="nav-item <?= $title == 'Change Password' ? 'active' : ''; ?>">
    <a class="nav-link d-block <?= $title == 'Change Password' ? 'fw-bold' : ''; ?>" href="<?= base_url('admin/changepassword'); ?>">
        <i class="fas fa-key"></i>
        <span>Change Password</span>
    </a>
</li>

    <!-- Nav Item - Logout -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('auth/logout'); ?>" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
