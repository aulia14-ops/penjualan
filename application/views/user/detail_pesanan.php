<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Pemesanan</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- My Style -->
     <link rel="stylesheet" href="<?php echo base_url('assets/css/user_detail.css'); ?>">
                
</head>
<body>
  <div class="container py-4">
    <div class="card shadow-sm border-0 rounded-4 detail-card">
      <div class="card-header bg-white border-0 pt-3 pb-0">
        <div class="d-flex justify-content-between align-items-center">
          <h5 class="mb-0">
            <i class="bi bi-receipt text-primary me-2"></i>
            <span class="fw-semibold">Detail Pemesanan</span>
          </h5>
        </div>
      </div>
      <div class="card-body p-3 p-md-4">
        <!-- Informasi Utama -->
        <div class="mb-4">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
              <h6 class="text-secondary mb-1">Kode Pesanan:</h6>
              <h5 class="fw-bold mb-0"><?= $pesanan->id; ?></h5>
            </div>
            <div class="text-end">
              <h6 class="text-secondary mb-1">Total:</h6>
              <h5 class="fw-bold text-success mb-0">Rp <?= number_format($pesanan->grand_total, 0, ',', '.'); ?></h5>
            </div>
          </div>
          <p class="mb-0 text-secondary">
            <i class="bi bi-calendar3 me-1"></i> <?= date('d M Y', strtotime($pesanan->tanggal_pesanan)); ?>
          </p>
        </div>

        <!-- Data Pemesan -->
        <h6 class="section-title"><i class="bi bi-person me-2"></i>Data Pemesan</h6>
        <div class="mb-4">
          <div class="detail-item">
            <div class="detail-label">Nama</div>
            <div class="detail-value"><?= htmlspecialchars($pesanan->nama_lengkap); ?></div>
          </div>
          <div class="detail-item">
            <div class="detail-label">Email</div>
            <div class="detail-value"><?= htmlspecialchars($pesanan->email); ?></div>
          </div>
          <div class="detail-item">
            <div class="detail-label">No HP</div>
            <div class="detail-value"><?= htmlspecialchars($pesanan->no_hp); ?></div>
          </div>
          <div class="detail-item">
            <div class="detail-label">Alamat</div>
            <div class="detail-value"><?= $pesanan->alamat_lengkap; ?>, <?= $pesanan->kota; ?>, <?= $pesanan->provinsi; ?></div>
          </div>
        </div>

        <!-- Detail Produk -->
        <h6 class="section-title"><i class="bi bi-eyeglasses me-2"></i>Detail Produk</h6>
        <div class="mb-4">
          <div class="detail-item">
            <div class="detail-label">Tipe Lensa</div>
            <div class="detail-value"><?= $pesanan->lensa; ?></div>
          </div>
          <div class="detail-item">
            <div class="detail-label">Harga Lensa</div>
            <div class="detail-value">Rp <?= number_format($pesanan->harga_lensa, 0, ',', '.'); ?></div>
          </div>
          <div class="detail-item">
            <div class="detail-label">Catatan</div>
            <div class="detail-value"><?= $pesanan->catatan ?: '<em class="text-muted">Tidak ada catatan</em>'; ?></div>
          </div>
        </div>
        <?php if (!empty($pesanan->gambar_resep)): ?>
          <!-- Resep Kacamata -->
          <h6 class="section-title"><i class="bi bi-file-earmark-image me-2"></i>Resep Kacamata</h6>
          <div class="text-center mb-4">
            <img src="<?= base_url('uploads/gambar_resep/' . $pesanan->gambar_resep); ?>" 
                alt="Gambar Resep Kacamata" 
                class="img-fluid rounded shadow-sm" 
                style="max-height: 300px;">
          </div>
        <?php endif; ?>
        <!-- Pengiriman & Pembayaran -->
        <h6 class="section-title"><i class="bi bi-truck me-2"></i>Pengiriman</h6>
        <div class="mb-4">
          <div class="detail-item">
            <div class="detail-label">Kurir</div>
            <div class="detail-value"><?= $pesanan->kurir; ?></div>
          </div>
          <div class="detail-item">
            <div class="detail-label">Ongkos Kirim</div>
            <div class="detail-value">Rp <?= number_format($pesanan->ongkir, 0, ',', '.'); ?></div>
          </div>
          <?php if (!empty($pesanan->no_resi)): ?>
            <div class="detail-item">
              <div class="detail-label">Nomor Resi</div>
              <div class="detail-value">
                <span class="fw-bold"><?= htmlspecialchars($pesanan->no_resi); ?></span>
              </div>
            </div>
          <?php endif; ?>
        </div>

        <!-- Pembayaran -->
        <h6 class="section-title"><i class="bi bi-credit-card me-2"></i>Pembayaran</h6>
        <div class="mb-4">
          <div class="detail-item">
            <div class="detail-label">Metode</div>
            <div class="detail-value"><?= $pesanan->pembayaran; ?></div>
          </div>
          <div class="detail-item">
            <div class="detail-label">Status</div>
            <div class="detail-value"><span class="badge bg-success">Lunas</span></div>
          </div>
        </div>

        <!-- Bukti Pembayaran -->
        <?php if ($pesanan->bukti_pembayaran): ?>
          <h6 class="section-title"><i class="bi bi-image me-2"></i>Bukti Pembayaran</h6>
          <div class="text-center mb-3">
            <img src="<?= base_url('uploads/bukti_pembayaran/' . $pesanan->bukti_pembayaran); ?>" 
                 alt="Bukti Pembayaran" 
                 class="img-fluid rounded shadow-sm" 
                 style="max-height: 200px;">
          </div>
        <?php endif; ?>

        <!-- Tombol Aksi -->
        <div class="d-flex gap-2 mt-4">
          <a href="<?= base_url('user/index'); ?>" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
          </a>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>