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
                <h1 class="display-4 fw-bold">Keranjang Belanja</h1>
                <p class="lead">Lihat dan periksa kembali pesanan Anda sebelum checkout.</p>
            </div>
        </div>
    </div>
</div>

<div class="container mt-4">
    <h4 class="mb-4">Keranjang Belanja Anda</h4>

    <!-- Notifikasi (jika ada) -->
    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $this->session->flashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php elseif ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $this->session->flashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle text-center">
            <thead class="table-primary">
                <tr>
                    <th>Gambar</th>
                    <th>Nama Produk</th>
                    <th>Harga Satuan</th>
                    <th>Jumlah</th>
                    <th>Total Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($keranjang)): ?>
                    <?php 
                        $totalBelanja = 0; 
                        foreach ($keranjang as $item): 
                            $subtotal = $item->harga * $item->jumlah;
                            $totalBelanja += $subtotal;
                    ?>
                        <tr class="align-middle">
                            <td>
                                <img src="<?= base_url('uploads/' . $item->gambar) ?>" 
                                     alt="<?= $item->nama_produk ?>" 
                                     class="img-thumbnail" 
                                     style="max-width: 60px;">
                            </td>
                            <td><?= htmlspecialchars($item->nama_produk) ?></td>
                            <td>Rp <?= number_format($item->harga, 0, ',', '.') ?></td>
                            <td>
                                <!-- Form update jumlah -->
                                <form action="<?= base_url('user/update') ?>" method="post" class="d-flex gap-2 justify-content-center">
                                    <input type="hidden" name="id" value="<?= $item->id_keranjang ?>">
                                    <input type="number" name="qty" value="<?= $item->jumlah ?>" min="1" class="form-control form-control-sm text-center" style="width: 70px;">
                                    <button type="submit" class="btn btn-sm btn-outline-primary">Update</button>
                                </form>
                            </td>
                            <td>Rp <?= number_format($subtotal, 0, ',', '.') ?></td>
                            <td>
                                <div class="btn-group">
                                    <!-- Tombol hapus -->
                                    <a href="<?= base_url('user/delete/' . $item->id_keranjang) ?>" 
                                       class="btn btn-sm btn-outline-danger" 
                                       onclick="return confirm('Yakin ingin menghapus item ini?')">
                                        <i class="bi bi-trash"></i> Hapus
                                    </a>
                                    <!-- Tombol beli langsung -->
                                    <form action="<?= base_url('user/checkout') ?>" method="post" class="d-inline">
                                        <input type="hidden" name="produk_id[]" value="<?= $item->id_produk ?>">
                                        <input type="hidden" name="jumlah[]" value="<?= $item->jumlah ?>">
                                        <button type="submit" class="btn btn-sm btn-outline-success">
                                            <i class="bi bi-cart-check"></i> Beli
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                    <tr class="table-light fw-bold">
                        <td colspan="4" class="text-end">Total Belanja:</td>
                        <td colspan="2" class="text-start">Rp <?= number_format($totalBelanja, 0, ',', '.') ?></td>
                    </tr>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted">Keranjang belanja kosong.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Tombol Checkout Semua (form terpisah) -->
    <?php if (!empty($keranjang)): ?>
    <form action="<?= base_url('user/checkout') ?>" method="post">
        <?php foreach ($keranjang as $item): ?>
            <input type="hidden" name="produk_id[]" value="<?= $item->id_produk ?>">
            <input type="hidden" name="jumlah[]" value="<?= $item->jumlah ?>">
        <?php endforeach; ?>
        <div class="d-flex justify-content-end mt-3">
            <button type="submit" class="btn btn-success px-4 py-2 shadow-sm rounded-pill">
                <i class="bi bi-cart-check me-2"></i> Checkout Semua
            </button>
        </div>
    </form>
    <?php endif; ?>
</div>
