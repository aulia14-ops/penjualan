<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data Transaksi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
     <link rel="stylesheet" href="<?php echo base_url('assets/css/laporan.css'); ?>">
</head>
<body>
    <div class="container mt-5 print-container">
        <!-- Judul dan navigasi -->
        <h3>Laporan Data Transaksi</h3>
        <nav aria-label="breadcrumb" class="breadcrumb"></nav>
        
        <!-- Header khusus print -->
        <div class="print-only print-header">
            <h4>LAPORAN DATA TRANSAKSI</h4>
            <p>Tanggal Cetak: <span id="tanggal-cetak"></span></p>
        </div>
        
        <!-- Tombol print -->
        <div class="mb-3 btn-print">
            <button class="btn btn-primary" onclick="cetakLaporan()">Print</button>
        </div>
        
        <!-- Tabel data -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" cellspacing="0">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Tanggal Pesanan</th>
                                <th>Email</th>
                                <th>Nama Pemesan</th>
                                <th>No. HP</th>
                                <th>Provinsi</th>
                                <th>Kota</th>
                                <th>Alamat Lengkap</th>
                                <th>Lensa</th>
                                <th>Harga Lensa</th>
                                <th>Catatan</th>
                                <th>Kurir</th>
                                <th>Ongkir</th>
                                <th>Pembayaran</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Nomor Resi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- PHP loop data akan diletakkan di sini -->
                            <?php foreach ($laporan_pesanan as $pesanan): ?>
                                <tr>
                                    <td><?php echo $pesanan->id; ?></td>
                                    <td><?php echo $pesanan->tanggal_pesanan; ?></td>
                                    <td><?php echo $pesanan->email; ?></td>
                                    <td><?php echo $pesanan->nama_lengkap; ?></td>
                                    <td><?php echo $pesanan->no_hp; ?></td>
                                    <td><?php echo $pesanan->provinsi; ?></td>
                                    <td><?php echo $pesanan->kota; ?></td>
                                    <td><?php echo $pesanan->alamat_lengkap; ?></td>
                                    <td><?php echo $pesanan->lensa; ?></td>
                                    <td><?php echo $pesanan->harga_lensa; ?></td>
                                    <td><?php echo $pesanan->catatan; ?></td>
                                    <td><?php echo $pesanan->kurir; ?></td>
                                    <td><?php echo $pesanan->ongkir; ?></td>
                                    <td><?php echo $pesanan->pembayaran; ?></td>
                                    <td><?php echo $pesanan->grand_total; ?></td>
                                    <td><?php echo $pesanan->status; ?></td>
                                    <td><?php echo $pesanan->no_resi; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- Footer print -->
        <div class="print-only footer-print">
            <div>Halaman <span class="pageNumber"></span></div>
        </div>
    </div>
    
    <script>
        // Fungsi untuk mencetak dengan persiapan
        function cetakLaporan() {
            // Set tanggal cetak
            document.getElementById('tanggal-cetak').textContent = formatDate(new Date());
            
            // Cetak dokumen
            window.print();
        }
        
        // Format tanggal Indonesia
        function formatDate(date) {
            const options = { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            };
            return date.toLocaleDateString('id-ID', options);
        }
        
        // Tambahkan nomor halaman saat cetak
        window.onload = function() {
            // Cek jika dokumen memiliki data
            const table = document.getElementById('dataTable');
            if (!table || table.rows.length <= 1) {
                // Jika tidak ada data, tampilkan pesan
                const container = document.querySelector('.card-body');
                if (container) {
                    container.innerHTML = '<div class="alert alert-info">Belum ada data laporan untuk ditampilkan.</div>';
                }
            }
        };
    </script>
</body>
</html>