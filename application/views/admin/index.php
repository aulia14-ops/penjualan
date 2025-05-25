<div class="container-fluid">
    <!-- Judul Halaman -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">

        <!-- Card: Total Produk -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Produk</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_total; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-box fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card: Produk dalam Proses -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Produk dalam Proses</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $proses; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-spinner fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card: Produk Terkirim -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Produk Terkirim</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $kirim; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-truck fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card: Produk Terjual -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Produk Terjual</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $produk_terjual; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div> <!-- /.row -->

    <!-- Daftar Pesanan Terbaru -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-primary text-white">
            <h6 class="m-0 font-weight-bold">Pesanan Terbaru</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th>Nama</th>
                            <th>Tanggal Pesan</th>
                            <th>Status</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($pesanan_terbaru)) : ?>
                            <?php foreach ($pesanan_terbaru as $p) : ?>
                                <tr>
                                    <td><?= htmlspecialchars($p['nama_lengkap']); ?></td>
                                    <td><?= date('d-m-Y', strtotime($p['tanggal_pesanan'])); ?></td>
                                    <td>
                                        <span class="badge badge-<?= 
                                                $p['status'] == 'proses' ? 'warning' :
                                                ($p['status'] == 'kirim' ? 'info' :
                                                ($p['status'] == 'selesai' ? 'success' :
                                                ($p['status'] == 'diterima' ? 'primary' : 'secondary'))) ?>">
                                                <?= ucfirst($p['status']); ?>
                                            </span>

                                    </td>
                                    <td>Rp <?= number_format($p['grand_total'], 0, ',', '.'); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="4" class="text-center text-muted">Belum ada pesanan.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="mt-3 text-right">
                <a href="<?= base_url('admin/pesanan'); ?>" class="btn btn-sm btn-primary">Lihat Semua Pesanan</a>
            </div>
        </div>
    </div>

</div> <!-- /.container-fluid -->
