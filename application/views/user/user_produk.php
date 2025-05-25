<!-- Banner -->
<div class="bg-dark text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <!-- Gambar di kiri -->
            <div class="col-md-5 mb-4 mb-md-0">
                <img src="<?= base_url('assets/css/home.jpg') ?>"
             
                     alt="Banner Image" 
                     class="img-fluid rounded shadow-sm" 
                     style="max-height: 250px; object-fit: cover;">
            </div>
            <!-- Teks di kanan -->
            <div class="col-md-7 text-center text-md-start">
                <h1 class="display-4 fw-bold">Produk</h1>
                <p class="lead">All Produk</p>
            </div>
        </div>
    </div>
</div>

<!-- Menu Section Start -->
<section id="menu" class="menu my-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2><span class="text-primary">Produk</span> Kami</h2>
            <p class="text-muted">Semua produk terbaik tersedia di sini.</p>
        </div>
        
        <div class="row justify-content-center">
            <?php foreach ($produk as $p) : ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <img src="<?= base_url('uploads/' . $p['gambar']) ?>" 
                            class="card-img-top img-fluid" 
                            alt="<?= htmlspecialchars($p['nama_produk']) ?>" 
                            style="height: 200px; object-fit: cover;">
                        <div class="card-body text-center d-flex flex-column">
                            <h5 class="card-title"><?= htmlspecialchars($p['nama_produk']) ?></h5>
                            <p class="card-text text-primary fw-bold mb-4">
                                Rp <?= number_format($p['harga'], 0, ',', '.') ?>
                            </p>
                            <div class="mt-auto">
                            <div class="d-flex justify-content-center mb-4"> <!-- Hapus margin bawah jika tak perlu -->
                                <input 
                                    type="number" 
                                    id="jumlah-<?= $p['id_produk'] ?>" 
                                    value="1" 
                                    min="1"
                                    class="form-control form-control-sm text-center"
                                    style="width: 60px;"> <!-- Lebar kecil dan tetap readable -->
                            </div>
                                <!-- Tombol-tombol aksi -->
                                <div class="d-flex justify-content-center gap-2">
                                    <!-- Tombol Detail -->
                                    <a href="<?= base_url('user/detail/' . $p['id_produk']) ?>" class="btn btn-primary btn-sm" title="Detail Produk">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>

                                    <!-- Tombol Beli Langsung -->
                                    <form action="<?= base_url('user/beli_langsung') ?>" method="post" class="m-0">
                                        <input type="hidden" name="id_produk" value="<?= $p['id_produk'] ?>">
                                        <input type="hidden" name="jumlah" value="1" id="jumlah-beli-<?= $p['id_produk'] ?>">
                                        <button type="submit" class="btn btn-success btn-sm" title="Beli Sekarang">
                                            <i class="bi bi-bag-fill"></i> Beli
                                        </button>
                                    </form>

                                    <!-- Tombol Tambah ke Keranjang -->
                                    <form action="<?= base_url('user/tambah_keranjang') ?>" method="post" class="m-0">
                                        <input type="hidden" name="id_produk" value="<?= $p['id_produk'] ?>">
                                        <input type="hidden" name="jumlah" value="1" id="jumlah-keranjang-<?= $p['id_produk'] ?>">
                                        <button type="submit" class="btn btn-warning btn-sm" title="Tambah ke Keranjang">
                                            <i class="fas fa-cart-shopping"></i>
                                        </button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<!-- Menu Section End -->