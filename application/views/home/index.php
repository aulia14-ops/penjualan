<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Optik Mahandra</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,400;0,500;0,700;1,700&display=swap" rel="stylesheet">

    <!-- My Style -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">

    <!-- FatherIcon -->
    <script src="https://unpkg.com/feather-icons"></script>
</head>
<body>
    <!-- Navbar Start-->
    <nav class="navbar">
        <a href="#" class="navbar-logo"><span>Optik</span>_Mahandra</a>

        <div class="navbar-nav">
            <a href="#home">Home</a>
            <a href="#about">Tentang Kami</a>
            <a href="#menu">Cara Order</a>
            <a href="#products">Produk</a>
            <a href="#contact">Kontak</a>
            <a href="<?php echo site_url('auth'); ?>">Login</a>
        </div>

        <div class="navbar-extra">
            <a href="#" id="hamburger-menu"><i data-feather="menu"></i></a>
        </div>
    </nav>
    <!-- Navbar end-->

    <!-- Hero Section Start -->
    <section class="hero" id="home">
        <main class="content">
            <h1>OPTIK <span>MAHANDRA</span></h1>
            <p>Frame 30% Lensa 10%!</p>
            <p>Jangan sampai terlewatkan diskon menariknya</p>
            <?php if ($this->session->userdata('logged_in')): ?>
                <a href="<?= base_url('checkout') ?>" class="cta">Beli Sekarang</a>
            <?php else: ?>
                <a href="<?= base_url('auth') ?>" class="cta">Beli Sekarang</a>
            <?php endif; ?>
        </main>
    </section>
    <!-- Hero Section End -->

    <!-- About Section Start -->
    <section id="about" class="about">
        <h2><span>Tentang</span> Kami</h2>
        <div class="row">
            <div class="about-img">
                <img src="<?= base_url('assets/css/home.jpg') ?>" alt="Tentang Kami">
            </div> 
            <div class="content">
                <h3>Kenapa memilih kacamata kami?</h3>
                <p> Optik Mahandra hadir untuk memberikan solusi terbaik bagi kebutuhan kacamata dan lensa anda dengan kualitas premium dan harga terjangkau.</p>
                <p> Dengan pengalaman lebih dari 10 tahun, kami menyediakan berbagai pilihan frame dan lensa berkualitas dengan garansi resmi dan layanan terbaik.</p>
                <p> Kunjungi toko kami atau belanja online untuk mendapatkan penawaran menariknya.</p>
            </div>
        </div>
    </section>
    <!-- About Section End -->

    <!-- Cara Order Section start -->
    <section id="menu" class="menu">
        <h2><span>Cara</span> Order</h2>
        <p>Berikut langkah-langkah untuk melakukan pemesanan:</p>
        <div class="row">
            <div class="menu-card">
                <div class="menu-card-icon"><i class="fas fa-user-plus"></i></div>
                <h3 class="menu-card-title">1. Registrasi / Login</h3>
                <p class="menu-card-description">Masuk atau buat akun terlebih dahulu.</p>
            </div>
            <div class="menu-card">
                <div class="menu-card-icon"><i class="fas fa-search"></i></div>
                <h3 class="menu-card-title">2. Pilih Produk</h3>
                <p class="menu-card-description">Lihat dan pilih produk yang Anda inginkan.</p>
            </div>
            <div class="menu-card">
                <div class="menu-card-icon"><i class="fas fa-shopping-bag"></i></div>
                <h3 class="menu-card-title">3. Klik Beli</h3>
                <p class="menu-card-description">Klik tombol "Beli" untuk langsung membeli.</p>
            </div>
            <div class="menu-card">
               <div class="menu-card-icon"><i class="fas fa-shopping-cart"></i></div>
                <h3 class="menu-card-title">4. Tambah ke Keranjang</h3>
                <p class="menu-card-description">Atau tambahkan ke keranjang untuk membeli lebih dari satu.</p>
            </div>
            <div class="menu-card">
              <div class="menu-card-icon"><i class="fas fa-clipboard-list"></i></div>
                <h3 class="menu-card-title">5. Isi Form Data Diri</h3>
                <p class="menu-card-description">Lengkapi informasi diri untuk pengiriman.</p>
            </div>
            <div class="menu-card">
               <div class="menu-card-icon"><i class="fas fa-glasses"></i></div>
                <h3 class="menu-card-title">6. Pilih Jenis Lensa</h3>
                <p class="menu-card-description">Sesuaikan lensa sesuai kebutuhan Anda.</p>
            </div>
            <div class="menu-card">
            <div class="menu-card-icon"><i class="fas fa-notes-medical"></i></div>
            <h3 class="menu-card-title">7. Catatan & Resep Dokter</h3>
            <p class="menu-card-description">Unggah catatan atau resep dokter jika ada.</p>
            </div>
            <div class="menu-card">
                <div class="menu-card-icon"><i class="fas fa-money-check-alt"></i></div>
                <h3 class="menu-card-title">8. Transfer & Upload Bukti</h3>
                <p class="menu-card-description">Pilih metode pembayaran dan upload bukti transfer.</p>
            </div>
            <div class="menu-card">
                <div class="menu-card-icon"><i class="fas fa-check-circle"></i></div>
                <h3 class="menu-card-title">9. Klik Bayar Sekarang</h3>
                <p class="menu-card-description">Pastikan semua benar, lalu klik "Bayar Sekarang".</p>
            </div>
            <div class="menu-card">
            <div class="menu-card-icon"><i class="fas fa-clipboard-check"></i></div>
            <h3 class="menu-card-title">10. Konfirmasi Pesanan</h3>
            <p class="menu-card-description">Setelah transaksi selesai, akses halaman Riwayat Transaksi untuk melakukan konfirmasi penerimaan pesanan guna menyelesaikan proses pembelian.</p>
        </div>
        </div>
    </section>
    <!-- Cara Order Section end -->

    <!-- Product Section Start -->
    <section id="products" class="products">
        <h2><span>Produk</span> Kami</h2>
        <p>Semua produk terbaik tersedia di sini.</p>
        <div class="row">
            <?php if (!empty($produk)): ?>
                <?php foreach ($produk as $p) : ?>
                    <div class="product-card">
                        <img src="<?= base_url('uploads/' . $p['gambar']) ?>" alt="<?= htmlspecialchars($p['nama_produk']) ?>">
                        <div class="product-content">
                            <h3 class="product-title"><?= htmlspecialchars($p['nama_produk']) ?></h3>
                            <p class="product-price">Rp <?= number_format($p['harga'], 0, ',', '.') ?></p>
                            
                            <div class="product-quantity">
                                <input 
                                    type="number" 
                                    id="jumlah-<?= $p['id_produk'] ?>" 
                                    value="1" 
                                    min="1"
                                    class="quantity-input"
                                    onchange="updateQuantity(<?= $p['id_produk'] ?>, this.value)">
                            </div>
                            
                            <div class="product-buttons">
                                <a href="<?= base_url('user/detail/' . $p['id_produk']) ?>" class="btn-detail">
                                    <i data-feather="eye"></i>
                                </a>
                                
                                <form action="<?= base_url('user/beli_langsung') ?>" method="post" style="margin: 0;">
                                    <input type="hidden" name="id_produk" value="<?= $p['id_produk'] ?>">
                                    <input type="hidden" name="jumlah" value="1" id="jumlah-beli-<?= $p['id_produk'] ?>">
                                    <button type="submit" class="btn-buy">
                                        <i data-feather="shopping-bag"></i> Beli
                                    </button>
                                </form>
                                
                                <form action="<?= base_url('user/tambah_keranjang') ?>" method="post" style="margin: 0;">
                                    <input type="hidden" name="id_produk" value="<?= $p['id_produk'] ?>">
                                    <input type="hidden" name="jumlah" value="1" id="jumlah-keranjang-<?= $p['id_produk'] ?>">
                                    <button type="submit" class="btn-cart">
                                        <i data-feather="shopping-cart"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center">Tidak ada produk tersedia.</p>
            <?php endif; ?>
        </div>
    </section>
    <!-- Product Section End -->
<!-- Contact Section Start -->
<section id="contact" class="contact">
  <h2><span>Kontak</span> Kami</h2>
  <p>Silakan hubungi kami untuk informasi lebih lanjut atau untuk membuat janji temu dengan tim optik profesional kami. Temukan lokasi kami pada peta berikut:</p>

  <div class="row">
    <iframe 
      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3955.637410101586!2d109.3891932!3d-7.4455989!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6550bb6793df6d%3A0x69a4a4455363af35!2sMahandra%20Kacamata%20Softlen%20Center!5e0!3m2!1sid!2sid!4v1714468325271!5m2!1sid!2sid"
      allowfullscreen=""
      loading="lazy"
      referrerpolicy="no-referrer-when-downgrade"
      class="map">
    </iframe>
  </div>
</section>
<!-- Contact Section End -->

<!-- Footer Section Start -->
<footer>
<!-- Tambahkan ini di <head> jika belum -->
<script src="https://unpkg.com/feather-icons"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<!-- Bagian Sosial Media -->
<div class="socials">
  <a href="https://www.instagram.com/optik_mahandra" target="_blank" title="Instagram">
    <i class="fab fa-instagram"></i> <span>@optik_mahandra</span>
  </a>
  <a href="https://wa.me/6281234567890" target="_blank" title="WhatsApp">
    <i class="fab fa-whatsapp"></i> <span>+62 856-5944-5602</span>
  </a>
  <a href="https://www.facebook.com/OptikMahanda" target="_blank" title="Facebook">
    <i class="fab fa-facebook-f"></i> <span>Optik Mahandra</span>
  </a>
</div>

        <div class="links">
            <a href="#home">Home</a>
            <a href="#about">Tentang Kami</a>
            <a href="#menu">Cara Order</a>
            <a href="#products">Produk</a>
            <a href="#contact">Kontak</a>        
        </div>        

        <div class="credit">
            <p>Created by <a href="">Optik Mahandra</a>. | &copy; 2025.</p>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Scripts -->
    <script>
        feather.replace();
        
        // Hamburger menu toggle
        const navbarNav = document.querySelector('.navbar-nav');
        document.querySelector('#hamburger-menu').onclick = () => {
            navbarNav.classList.toggle('active');
        };
        
        // Hide hamburger menu when clicking outside
        const hamburger = document.querySelector('#hamburger-menu');
        document.addEventListener('click', function(e) {
            if(!hamburger.contains(e.target) && !navbarNav.contains(e.target)) {
                navbarNav.classList.remove('active');
            }
        });
        
        // Update quantity for forms
        function updateQuantity(productId, value) {
            document.getElementById('jumlah-beli-' + productId).value = value;
            document.getElementById('jumlah-keranjang-' + productId).value = value;
        }
    </script>
</body>
</html>