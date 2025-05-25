<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center bg-gradient-primary">
            <h6 class="m-0 font-weight-bold text-white">
                <i class="fas fa-info-circle mr-2"></i>Detail Pesanan <?= $user_pesanan['id']; ?>
            </h6>
            <div class="d-flex">
                    <a href="<?= base_url('admin/cetak_nota/' . $user_pesanan['id']); ?>" class="btn btn-success btn-icon-split mr-2">
                        <span class="icon text-white-50">
                            <i class="fas fa-print"></i>
                        </span>
                        <span class="text">Print Nota</span>
                    </a>
                    <a href="<?= base_url('admin/pesanan'); ?>" class="btn btn-light btn-icon-split">
                        <span class="icon text-gray-600">
                            <i class="fas fa-arrow-left"></i>
                        </span>
                        <span class="text">Kembali</span>
                    </a>
            </div>

        </div>

        <div class="card-body">
            <?php if (!empty($user_pesanan)): ?>
                <!-- CSS untuk styling halaman detail -->
                <link rel="stylesheet" href="<?= base_url('assets/css/detail_pesanan.css'); ?>">
                
                <div class="row">
                    <div class="col-lg-7">
                        <div class="detail-pesanan mb-4">
                            <div class="info-section">
                                <h5 class="info-header"><i class="fas fa-user mr-2"></i>Informasi Pelanggan</h5>
                                <div class="info-item">
                                    <div class="info-label">Nama Lengkap</div>
                                    <div class="info-value"><?= htmlspecialchars($user_pesanan['nama_lengkap']); ?></div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Email</div>
                                    <div class="info-value"><?= htmlspecialchars($user_pesanan['email']); ?></div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">No. HP</div>
                                    <div class="info-value"><?= htmlspecialchars($user_pesanan['no_hp']); ?></div>
                                </div>
                            </div>
                            
                            <div class="info-section">
                                <h5 class="info-header"><i class="fas fa-map-marker-alt mr-2"></i>Alamat Pengiriman</h5>
                                <div class="info-item">
                                    <div class="info-label">Alamat Lengkap</div>
                                    <div class="info-value"><?= htmlspecialchars($user_pesanan['alamat_lengkap']); ?></div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Kota</div>
                                    <div class="info-value"><?= htmlspecialchars($user_pesanan['kota']); ?></div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Provinsi</div>
                                    <div class="info-value"><?= htmlspecialchars($user_pesanan['provinsi']); ?></div>
                                </div>
                            </div>
                            
                            <div class="info-section">
                                <h5 class="info-header"><i class="fas fa-shipping-fast mr-2"></i>Informasi Pengiriman</h5>
                                <div class="info-item">
                                    <div class="info-label">Kurir</div>
                                    <div class="info-value"><?= htmlspecialchars($user_pesanan['kurir']); ?></div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Ongkir</div>
                                    <div class="info-value">Rp <?= number_format($user_pesanan['ongkir'], 0, ',', '.'); ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-5">
                        <div class="detail-pesanan mb-4">
                            <div class="info-section">
                                <h5 class="info-header"><i class="fas fa-clipboard-list mr-2"></i>Informasi Pesanan</h5>
                                <div class="info-item">
                                    <div class="info-label">ID Pesanan</div>
                                    <div class="info-value font-weight-bold"><?= $user_pesanan['id']; ?></div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Tanggal Pesanan</div>
                                    <div class="info-value"><?= date('d M Y', strtotime($user_pesanan['tanggal_pesanan'])); ?></div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Pembayaran</div>
                                    <div class="info-value"><?= htmlspecialchars($user_pesanan['pembayaran']); ?></div>
                                </div>
                            </div>
                            
                            <div class="info-section">
                                <h5 class="info-header"><i class="fas fa-glasses mr-2"></i>Informasi Lensa</h5>
                                <div class="info-item">
                                    <div class="info-label">Lensa</div>
                                    <div class="info-value"><?= htmlspecialchars($user_pesanan['lensa']); ?></div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Harga Lensa</div>
                                    <div class="info-value">Rp <?= number_format($user_pesanan['harga_lensa'], 0, ',', '.'); ?></div>
                                </div>
                            </div>

                            <?php if(!empty($user_pesanan['catatan'])): ?>
                            <div class="info-section">
                                <h5 class="info-header"><i class="fas fa-sticky-note mr-2"></i>Catatan</h5>
                                <div class="info-item">
                                    <div class="info-value w-100 font-italic">
                                        "<?= htmlspecialchars($user_pesanan['catatan']); ?>"
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>

                            <?php if (!empty($user_pesanan['gambar_resep'])): ?>
                            <div class="info-section">
                                <h5 class="info-header"><i class="fas fa-file-medical mr-2"></i>Resep Kacamata</h5>
                                <div class="text-center">
                                    <img src="<?= base_url('uploads/gambar_resep/' . $user_pesanan['gambar_resep']); ?>" 
                                         alt="Gambar Resep" class="img-fluid rounded shadow-sm" style="max-height: 300px;">
                                </div>
                            </div>
                            <?php endif; ?>

                            <div class="total-section mt-3">
                                <span class="text-uppercase">Total Bayar</span>: Rp <?= number_format($user_pesanan['grand_total'], 0, ',', '.'); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>
                
                <div class="card shadow mb-4">
                    <div class="card-header py-3 bg-gradient-info">
                        <h6 class="m-0 font-weight-bold text-white">
                            <i class="fas fa-shopping-cart mr-2"></i>Detail Produk yang Dipesan
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <?php if (!empty($user_pesanan_detail)): ?>
                                <table class="table table-bordered product-table">
                                    <thead>
                                        <tr class="text-center">
                                            <th width="15%">Gambar</th>
                                            <th width="30%">Nama Produk</th>
                                            <th width="15%">Jumlah</th>
                                            <th width="20%">Harga Satuan</th>
                                            <th width="20%">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($user_pesanan_detail as $item): ?>
                                            <tr>
                                                <td class="text-center">
                                                    <img src="<?= base_url('uploads/' . ($item['gambar'] ?? 'no-image.png')); ?>" 
                                                         alt="<?= htmlspecialchars($item['nama_produk']); ?>" 
                                                         class="product-image">
                                                </td>
                                                <td>
                                                    <strong><?= htmlspecialchars($item['nama_produk']); ?></strong>
                                                </td>
                                                <td class="text-center font-weight-bold"><?= $item['qty']; ?></td>
                                                <td class="text-right">Rp <?= number_format($item['harga'], 0, ',', '.'); ?></td>
                                                <td class="text-right font-weight-bold">Rp <?= number_format($item['qty'] * $item['harga'], 0, ',', '.'); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <tr class="bg-light">
                                            <td colspan="4" class="text-right font-weight-bold">Subtotal Produk:</td>
                                            <td class="text-right font-weight-bold">
                                                <?php
                                                $subtotal = 0;
                                                foreach ($user_pesanan_detail as $item) {
                                                    $subtotal += ($item['qty'] * $item['harga']);
                                                }
                                                echo 'Rp ' . number_format($subtotal, 0, ',', '.');
                                                ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle mr-2"></i>Tidak ada data detail produk.
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle mr-2"></i>Data pesanan tidak ditemukan.
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
