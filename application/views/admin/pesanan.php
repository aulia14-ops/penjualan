<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg">

            <!-- Notifikasi Error -->
            <?php if (validation_errors()): ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>

            <!-- Flash Message -->
            <?= $this->session->flashdata('message'); ?>

            <!-- Tabel Data Pesanan dengan Tampilan yang Diperbaiki -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive" style="overflow-x: auto;">
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0" style="min-width: 1200px;">
                            <thead class="thead-dark">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-center" width="3%">No</th>
                                    <th class="text-center" width="6%">ID</th>
                                    <th class="text-center" width="10%">Nama Pemesan</th>
                                    <th class="text-center" width="15%">Tanggal</th>
                                    <th class="text-center" width="15%">Total Bayar</th>
                                    <th class="text-center" width="18%">Status</th>
                                    <th class="text-center" width="20%">Nomor Resi</th>
                                    <th class="text-center" width="6%">Detail Pesanan</th>
                                    <th class="text-center" width="7%">Bukti Pembayaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($user_pesanan)): ?>
                                    <?php $i = 1; foreach ($user_pesanan as $psn): ?>
                                        <tr>
                                            <td class="text-center align-middle"><?= $i++; ?></td>
                                            <td class="align-middle"><?= htmlspecialchars($psn['id']); ?></td>
                                            <td class="align-middle text-nowrap"><?= htmlspecialchars($psn['nama_lengkap']); ?></td>
                                            <td class="text-center align-middle"><?= date('d M Y ', strtotime($psn['tanggal_pesanan'])); ?></td>
                                            <td class="text-right align-middle px-3"><span class="font-weight-bold">Rp <?= number_format($psn['grand_total'], 0, ',', '.'); ?></span></td>
                                            <td class="align-middle">
                                                <form action="<?= base_url('admin/update_status/' . $psn['id']); ?>" method="post">
                                                    <div class="input-group mb-2">
                                                        <select name="status" class="form-control">
                                                            <option value="diterima" <?= $psn['status'] == 'diterima' ? 'selected' : ''; ?>>Diterima</option>
                                                            <option value="proses" <?= $psn['status'] == 'proses' ? 'selected' : ''; ?>>Proses</option>
                                                            <option value="kirim" <?= $psn['status'] == 'kirim' ? 'selected' : ''; ?>>Kirim</option>
                                                            <option value="selesai" <?= $psn['status'] == 'selesai' ? 'selected' : ''; ?>>Selesai</option>
                                                             <option value="dibatalkan" <?= $psn['status'] == 'dibatalkan' ? 'selected' : ''; ?>>Dibatalkan</option>
                                                        </select>
                                                        <div class="input-group-append">
                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <?php if ($psn['status'] == 'diterima'): ?>
                                                            <span class="badge bg-warning text-dark w-100 py-2 px-3">DITERIMA</span>
                                                        <?php elseif ($psn['status'] == 'proses'): ?>
                                                            <span class="badge bg-primary text-white w-100 py-2 px-3">PROSES</span>
                                                        <?php elseif ($psn['status'] == 'kirim'): ?>
                                                            <span class="badge bg-info text-white w-100 py-2 px-3">DIKIRIM</span>
                                                        <?php elseif ($psn['status'] == 'selesai'): ?>
                                                            <span class="badge bg-success text-white w-100 py-2 px-3">SELESAI</span>
                                                        <?php elseif ($psn['status'] == 'dibatalkan'): ?>
                                                            <span class="badge bg-danger text-white w-100 py-2 px-3">DIBATALKAN</span>
                                                        <?php else: ?>
                                                            <span class="badge bg-secondary text-white w-100 py-2 px-3"><?= strtoupper($psn['status']); ?></span>
                                                        <?php endif; ?>
                                                    </div>

                                                </form>
                                            </td>

                                            <!-- Kolom input nomor resi dengan layout yang diperbaiki -->
                                            <td class="align-middle">
                                                <form action="<?= base_url('admin/update_resi/' . $psn['id']); ?>" method="post">
                                                    <div class="input-group">
                                                        <input type="text" name="no_resi" class="form-control" value="<?= htmlspecialchars($psn['no_resi'] ?? ''); ?>" placeholder="Isi nomor resi">
                                                        <div class="input-group-append">
                                                            <button type="submit" class="btn btn-success">Simpan</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </td>

                                            <td class="text-center align-middle">
                                                <a href="<?= base_url('admin/detail_pesanan/' . $psn['id']); ?>" class="btn btn-info">
                                                    <i class="fas fa-info-circle"></i> Detail
                                                </a>
                                            </td>
                                            
                                            <td class="text-center align-middle">
                                                <?php if (!empty($psn['bukti_pembayaran'])): ?>
                                                    <a href="<?= base_url('uploads/bukti_pembayaran/' . $psn['bukti_pembayaran']); ?>" target="_blank" class="btn btn-primary">
                                                        <i class="fas fa-file-image"></i> Lihat
                                                    </a>
                                                <?php else: ?>
                                                    <span class="badge badge-danger w-100 py-2 px-2">BELUM ADA</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="9" class="text-center text-muted py-5">
                                            <i class="fas fa-folder-open fa-3x mb-3"></i>
                                            <p class="mb-0">Tidak ada data pesanan ditemukan.</p>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>