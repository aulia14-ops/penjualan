<!-- Banner -->
<div class="bg-dark text-white text-center py-5">
    <h1 class="display-4"><?= $produk['nama_produk'] ?></h1>
</div>

<!-- Detail Produk Section -->
<section id="produk-detail" class="py-5">
    <div class="container">
        <div class="row align-items-center">
            <!-- Kolom gambar produk -->
            <div class="col-md-6">
                <img src="<?= base_url('uploads/' . $produk['gambar']) ?>" 
                     class="img-fluid rounded shadow" 
                     alt="<?= $produk['nama_produk'] ?>">
            </div>
            <!-- Kolom detail produk -->
            <div class="col-md-6">
                <h2 class="mb-3"><?= $produk['nama_produk'] ?></h2>
                <h4 class="text-primary mb-3">IDR <?= number_format($produk['harga'], 0, ',', '.') ?></h4>
                <p><?= $produk['deskripsi'] ?></p>
                <div class="mt-4">
                    <!-- Form untuk Beli Langsung -->
                    <form action="<?= base_url('user/beli_langsung') ?>" method="post" class="d-inline">
                        <input type="hidden" name="id_produk" value="<?= $produk['id_produk'] ?>">
                        <input type="hidden" name="jumlah" value="1">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-bag-fill"></i> Beli
                        </button>
                    </form>
                    
                    <!-- Form untuk Tambah ke Keranjang -->
                    <form action="<?= base_url('user/tambah_keranjang') ?>" method="post" class="d-inline">
                        <input type="hidden" name="id_produk" value="<?= $produk['id_produk'] ?>">
                        <input type="number" name="jumlah" value="1" min="1" style="width: 60px;">
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-cart-shopping"></i>
                        </button>
                    </form>
                </div>
            </div>
            <!-- Tombol Back -->
            <div class="mt-3">
                <a href="<?= base_url('user/produk'); ?>" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>
        </div>
    </div>
</section>
