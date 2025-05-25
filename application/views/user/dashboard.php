<!-- Banner -->
<div class="bg-dark text-white py-5">
  <div class="container">
    <div class="row align-items-center">
      <!-- Gambar di kiri -->
      <div class="col-md-5 mb-4 mb-md-0">
        <img src="<?= base_url('assets/css/home.jpg'); ?>" 
             alt="Banner Image" 
             class="img-fluid rounded shadow-sm" 
             style="max-height: 250px; object-fit: cover;">
      </div>
      <!-- Teks di kanan -->
      <div class="col-md-7 text-center text-md-start">
        <h1 class="display-4 fw-bold">Riwayat Transaksi</h1>
        <p class="lead">Konfirmasikan Pesanan Anda</p>
      </div>
    </div>
  </div>
</div>

<!-- Flash Message -->
<div class="container mt-4">
  <?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <?= $this->session->flashdata('success'); ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php elseif ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <?= $this->session->flashdata('error'); ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>
</div>

<!-- Riwayat Transaksi -->
<div class="container mt-3">
  <div class="card shadow-sm border-0 rounded-4">
    <div class="card-body">
      <h4 class="card-title mb-4 fw-semibold text-primary">
      </h4>

      <div class="table-responsive">
        <table id="transaksiTable" class="table table-bordered table-hover align-middle rounded shadow-sm">
          <thead class="table-dark text-white text-center">
            <tr>
              <th>ID</th>
              <th>Gambar</th>
              <th>Nama Produk</th>
              <th>Tanggal</th>
              <th>Total</th>
              <th>Status</th>
              <th>Opsi</th>
            </tr>
          </thead>
          <tbody class="table-group-divider">
            <?php foreach ($pesanan as $row): ?>
              <?php if (!empty($row->detail_produk)): ?>
                <?php foreach ($row->detail_produk as $produk): ?>
                  <tr class="text-center">
                    <td class="fw-medium"><?= htmlspecialchars($row->id); ?></td>
                    <td>
                      <img src="<?= base_url('uploads/' . ($produk['gambar'] ?? 'no-image.png')); ?>" 
                           class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                    </td>
                    <td><?= htmlspecialchars($produk['nama_produk'] ?? 'Nama produk tidak tersedia'); ?></td>
                    <td><?= date('d M Y', strtotime($row->tanggal_pesanan)); ?></td>
                    <td class="text-end text-nowrap">Rp <?= number_format($row->grand_total, 0, ',', '.'); ?></td>
                    <td>
                      <?php
                      $status = strtolower($row->status);
                      switch ($status) {
                        case 'diterima': $badgeClass = 'bg-warning text-dark'; break;
                        case 'proses': $badgeClass = 'bg-info text-white'; break;
                        case 'kirim': $badgeClass = 'bg-success text-white'; break;
                        case 'selesai': $badgeClass = 'bg-success text-white'; break;
                        default: $badgeClass = 'bg-secondary text-white';
                      }
                      ?>
                      <span class="badge <?= $badgeClass; ?> py-2 px-3 rounded-pill text-uppercase fw-semibold">
                        <?= ucfirst($status); ?>
                      </span>
                    </td>
                    <td>
                      <div class="d-flex justify-content-center gap-2">
                        <a href="<?= base_url('user/detail_pesanan/' . $row->id); ?>"
                          class="btn btn-sm btn-outline-primary rounded-pill">
                          <i class="bi bi-eye"></i> Detail
                        </a>

                    <?php if ($status === 'kirim'): ?>
                      <a href="<?= base_url('user/konfirmasi/' . $row->id); ?>"
                        class="btn btn-sm btn-outline-success rounded-pill"
                        onclick="return confirm('Apakah Anda yakin ingin mengonfirmasi bahwa produk sudah diterima?');">
                        <i class="bi bi-check-circle"></i> Konfirmasi
                      </a>
                    <?php elseif ($status === 'selesai'): ?>
                      <span class="badge bg-success text-white py-2 px-3 rounded-pill">Selesai</span>
                    <?php endif; ?>


                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr class="text-center">
                  <td colspan="7">Tidak ada detail produk untuk pesanan ini.</td>
                </tr>
              <?php endif; ?>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
