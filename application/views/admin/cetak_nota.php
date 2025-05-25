<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Nota Pesanan</title>
    <!-- My Style -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/cetak_nota.css'); ?>">
</head>
<body onload="window.print()">
    <div class="nota-container">
        <h2>Optik Mahandra</h2>
        <p><small>Tanggal: <?= date('d M Y', strtotime($user_pesanan['tanggal_pesanan'])); ?></small></p>
        <hr>
        <p><strong>Nama:</strong> <?= htmlspecialchars($user_pesanan['nama_lengkap']); ?></p>
        <p><strong>No. HP:</strong> <?= htmlspecialchars($user_pesanan['no_hp']); ?></p>
        <p><strong>Alamat:</strong> <?= htmlspecialchars($user_pesanan['alamat_lengkap']); ?></p>
        <p><strong>Kurir:</strong> <?= htmlspecialchars($user_pesanan['kurir']); ?></p>
        <p><strong>Ongkir:</strong> Rp <?= number_format($user_pesanan['ongkir'], 0, ',', '.'); ?></p>
        <p><strong>ID Pesanan:</strong> <?= htmlspecialchars($user_pesanan['id']); ?></p>

        <?php if (!empty($user_pesanan_detail)): ?>
        <table>
            <thead>
                <tr>
                    <th class="text-left">Produk</th>
                    <th class="text-center">Qty</th>
                    <th class="text-left">Jenis Lensa</th>
                    <th class="text-right">Harga Produk</th>
                    <th class="text-right">Harga Lensa</th>
                    <th class="text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($user_pesanan_detail as $item): ?>
                <tr>
                    <td>
                        <strong><?= htmlspecialchars($item['nama_produk'] ?? '-'); ?></strong>
                    </td>

                    <td class="text-center"><?= $item['qty']; ?></td>
                    <td class="text-left"><?= htmlspecialchars($user_pesanan['lensa'] ?? '-'); ?></td>
                    <td class="text-right">Rp <?= number_format($item['harga'], 0, ',', '.'); ?></td>
                    <td class="text-right">Rp <?= number_format($user_pesanan['harga_lensa'] ?? 0, 0, ',', '.'); ?></td>
                    <td class="text-right">Rp <?= number_format($item['subtotal'], 0, ',', '.'); ?></td>
                </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="5" class="text-right total">Subtotal Produk:</td>
                    <td class="text-right total">Rp <?= number_format($user_pesanan['grand_total'] - $user_pesanan['ongkir'], 0, ',', '.'); ?></td>
                </tr>
                <tr>
                    <td colspan="5" class="text-right total">Ongkir:</td>
                    <td class="text-right total">Rp <?= number_format($user_pesanan['ongkir'], 0, ',', '.'); ?></td>
                </tr>
                <tr>
                    <td colspan="5" class="text-right total">Total Bayar:</td>
                    <td class="text-right total">Rp <?= number_format($user_pesanan['grand_total'], 0, ',', '.'); ?></td>
                </tr>
            </tbody>
        </table>
        <?php endif; ?>

        <div class="footer">
            <hr>
            <p>Terima kasih atas pesanan Anda!</p>
        </div>
    </div>
</body>
</html>
