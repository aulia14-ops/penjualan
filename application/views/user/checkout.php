<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Pemesanan</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/checkout.css') ?>" type="text/css">
</head>
<body>
<form action="<?= base_url('user/proses_checkout') ?>" method="post" enctype="multipart/form-data">
    <div class="form-container">
        <!-- Form Pesanan -->
        <div class="form-section">
            <div class="form-title">PESANAN</div>

            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-input" required>
            </div>

            <div class="form-group">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama" class="form-input" required>
            </div>

            <div class="form-group">
                <label class="form-label">No. HP</label>
                <input type="tel" name="no_hp" class="form-input" required>
            </div>

            <div class="form-group">
                <label class="form-label">Tanggal Pesanan</label>
                <input type="date" name="tanggal" class="form-input" id="tanggalPesanan" readonly>
            </div>


            <script>
                // Set tanggal hari ini otomatis
                const tanggalInput = document.getElementById('tanggalPesanan');
                const today = new Date().toISOString().split('T')[0];
                tanggalInput.value = today;
            </script>

            <div class="form-group">
                <label class="form-label">Alamat Lengkap</label>
                <input type="text" name="alamat_lengkap" class="form-input" required>
            </div>

           <!-- Provinsi -->
            <div class="form-group">
                <label class="form-label">Provinsi</label>
                <select id="provinsi" name="provinsi" class="form-input" required>
                    <option value="">- Pilih Provinsi -</option>
                    <?php foreach ($provinsi as $row): ?>
                        <option value="<?= $row->id ?>"><?= $row->nama_provinsi ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Kota -->
            <div class="form-group">
                <label class="form-label">Kota/Kabupaten</label>
                <select id="kota" name="kota" class="form-input" required>
                    <option value="">- Pilih Kota/Kabupaten -</option>
                </select>
            </div>




           <!-- Lensa -->
            <div class="form-group">
                <label class="form-label fw-bold mb-2">Pilih Jenis Lensa:</label>
                
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="lensa[]" value="Minus" id="lensaMinus" onchange="updateHarga()">
                    <label class="form-check-label" for="lensaMinus">
                        Minus 1 sampai 6 – <strong>Rp250.000</strong>
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="lensa[]" value="Plus" id="lensaPlus" onchange="updateHarga()">
                    <label class="form-check-label" for="lensaPlus">
                        Plus 1 sampai 6 – <strong>Rp250.000</strong>
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="lensa[]" value="Antiradiasi" id="lensaAntiradiasi" onchange="updateHarga()">
                    <label class="form-check-label" for="lensaAntiradiasi">
                        Antiradiasi – <strong>Rp100.000</strong>
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="lensa[]" value="Photocromic" id="lensaPhotocromic" onchange="updateHarga()">
                    <label class="form-check-label" for="lensaPhotocromic">
                        Photocromic – <strong>Rp150.000</strong>
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="lensa[]" value="Bluecromic" id="lensaBluecromic" onchange="updateHarga()">
                    <label class="form-check-label" for="lensaBluecromic">
                        Bluecromic – <strong>Rp120.000</strong>
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="lensa[]" value="Cylinder" id="lensaCylinder" onchange="updateHarga()">
                    <label class="form-check-label" for="lensaCylinder">
                        Cylinder 1 sampai 6 – <strong>Rp100.000</strong>
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="lensa[]" value="Progresif" id="lensaProgresif" onchange="updateHarga()">
                    <label class="form-check-label" for="lensaProgresif">
                        Progresif – <strong>Rp200.000</strong>
                    </label>
                </div>
            </div>


            <div class="form-group">
                <label class="form-label">Harga Lensa</label>
                <input type="text" name="harga_lensa" id="hargaLensa" class="form-input" readonly>
                <input type="hidden" name="harga_lensa_hidden" id="hargaLensaHidden">
            </div>


        <div class="form-group">
            <label class="form-label">Catatan/Resep Dokter (Jika Perlu)</label>
            <input type="text" name="catatan" class="form-input">
             <small class="form-text text-muted">
               Contoh penulisan: R: -0,25&nbsp;&nbsp;Cyl: -0,25&nbsp;&nbsp;Axis: 30&nbsp;&nbsp;Pd 58<br>
               L: -0,50&nbsp;&nbsp;Cyl: -0,25&nbsp;&nbsp;Axis: 20
            </small>
        </div>


        <div class="form-group">
            <label class="form-label">Upload Gambar Resep Dokter (Opsional)</label>
            <input type="file" name="gambar_resep" accept="image/*" class="form-input">
        </div>


            <div class="form-row">
                <div class="form-group half">
                    <label class="form-label">Layanan</label>
                  <input type="text" name="kurir_display" value="TIKI" readonly class="form-input" style="background:#f0f0f0; cursor: default;">
                    <!-- input hidden yang dikirim -->
                    <input type="hidden" name="kurir" value="TIKI">
                </div>
            </div>


            <!-- Pembayaran -->
            <div class="form-group">
                <label class="form-label">Pembayaran</label>
                <select name="pembayaran" class="form-input">
                    <option value="DANA">DANA  0856-5944-5602 a.n JIHAN NUR FAUZIAH</option>
                    <option value="BRI"> Bank BRI - 6821-01-012614-53-8 a.n JIHAN NUR FAUZIAH</option>
                    <option value="MANDIRI">Bank MANDIRI - 1800014069753 a.n JIHAN NUR FAUZIAH</option>
                </select>
            </div>

            <!-- Bukti Pembayaran -->
            <div class="form-group">
                <label class="form-label">Bukti Pembayaran</label>
                <input type="file" name="bukti_pembayaran" accept="image/*" class="form-input">
            </div>
        </div>

        <!-- Detail Pesanan -->
<div class="form-section">
    <div class="form-title">DETAIL PESANAN</div>

    <?php if (!empty($checkout_items) && is_array($checkout_items)): ?>
        <?php foreach ($checkout_items as $item): ?>
            <div class="product-item">
                <?php if (isset($item['gambar'])): ?>
                    <img src="<?= base_url('uploads/' . $item['gambar']); ?>" alt="<?= $item['name']; ?>" class="product-image">
                <?php else: ?>
                    <img src="<?= base_url('uploads/no-image.png'); ?>" alt="Gambar tidak tersedia" class="product-image">
                <?php endif; ?>
                <div class="product-details">
                    <p>Nama Produk: <strong><?= htmlspecialchars($item['name']) ?></strong></p>
                    <p>Jumlah: <strong><?= $item['qty'] ?></strong></p>
                    <p>Harga Satuan: <strong>Rp <?= number_format($item['price'], 0, ',', '.') ?></strong></p>
                    <p>Subtotal: <strong>Rp <?= number_format($item['qty'] * $item['price'], 0, ',', '.') ?></strong></p>
                </div>
            </div>
            <hr>
        <?php endforeach; ?>
    <?php elseif (!empty($keranjang) && is_array($keranjang)): ?>
        <?php foreach ($keranjang as $item): ?>
            <div class="product-item">
                <?php if (isset($item['gambar'])): ?>
                    <img src="<?= base_url('uploads/img/' . $item['gambar']); ?>" alt="<?= $item['name']; ?>" class="product-image">
                <?php else: ?>
                    <img src="<?= base_url('uploads/img/no-image.png'); ?>" alt="Gambar tidak tersedia" class="product-image">
                <?php endif; ?>
                <div class="product-details">
                    <p>Nama Produk: <strong><?= htmlspecialchars($item['name']) ?></strong></p>
                    <p>Jumlah: <strong><?= $item['qty'] ?></strong></p>
                    <p>Harga Satuan: <strong>Rp <?= number_format($item['price'], 0, ',', '.') ?></strong></p>
                    <p>Subtotal: <strong>Rp <?= number_format($item['qty'] * $item['price'], 0, ',', '.') ?></strong></p>
                </div>
            </div>
            <hr>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Tidak ada produk untuk checkout.</p>
    <?php endif; ?>

   <!-- Ongkir -->
<div class="form-group">
    <label class="form-label">Ongkir</label>
    <input type="text" id="ongkir_display" class="form-input" readonly>
    <input type="hidden" name="ongkir" id="ongkir">
</div>

<!-- JQuery & AJAX -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$('#provinsi').on('change', function () {
    let id_provinsi = $(this).val();
    $('#kota').html('<option value="">Memuat...</option>');
    
    $.ajax({
        url: "<?= base_url('user/get_kota_by_provinsi') ?>",
        type: "POST",
        data: {id_provinsi: id_provinsi},
        dataType: "json",
        success: function (data) {
            let options = '<option value="">- Pilih Kota/Kabupaten -</option>';
            data.forEach(function (item) {
                options += `<option value="${item.nama_kota}" data-ongkir="${item.ongkir}">${item.nama_kota}</option>`;
            });
            $('#kota').html(options);
        }
    });
});

$('#kota').on('change', function () {
    let ongkir = $('option:selected', this).data('ongkir');
    $('#ongkir_display').val('Rp ' + parseInt(ongkir).toLocaleString('id-ID'));
    $('#ongkir').val(ongkir);
});
</script>

    <div class="form-group">
        <label class="form-label">Total Semua</label>
        <input type="text" name="grand_total_display" id="grandTotalDisplay" class="form-input" readonly>
        <input type="hidden" name="grand_total" id="grandTotal">
    </div>

</div>
    <!-- Submit Button Section -->

    <button type="submit" class="button-submit" id="submitBtn">
        <span>Bayar Sekarang</span>
    </button>

    </div>
</form>

<script>
    // Update harga lensa dan hitung ulang total
    function updateHarga() {
        const hargaMap = {
            "Minus": 250000,
            "Plus": 250000,
            "Antiradiasi": 100000,
            "Photocromic": 150000,
            "Bluecromic": 120000,
            "Cylinder": 100000,
            "Progresif": 200000
        };

        let totalHarga = 0;

        // Menambahkan harga lensa yang dipilih
        document.querySelectorAll('input[name="lensa[]"]:checked').forEach((checkbox) => {
            const value = checkbox.value;
            if (hargaMap[value]) {
                totalHarga += hargaMap[value];
            }
        });

        // Update harga lensa
        document.getElementById('hargaLensa').value = 'Rp ' + totalHarga.toLocaleString('id-ID');
        document.getElementById('hargaLensaHidden').value = totalHarga;

        updateGrandTotal(); // Hitung ulang total
    }
</script>

<!-- Memanggil file kota.js -->
<script src="<?= base_url('assets/js/kota.js') ?>"></script>

<script>
    const kotaSelect = document.getElementById('kota');
    const ongkirInput = document.getElementById('ongkir'); // Hidden input
    const ongkirDisplay = document.getElementById('ongkir_display'); // Tampil untuk user
    const grandTotalDisplay = document.getElementById('grandTotalDisplay');
    const grandTotalHidden = document.getElementById('grandTotal');

    kotaSelect.addEventListener('change', function () {
        const selectedKota = this.value;
        if (selectedKota !== "") {
            fetch("<?= base_url('user/get_ongkir?kota=') ?>" + encodeURIComponent(selectedKota))
                .then(response => response.json())
                .then(data => {
                    const biaya = parseInt(data?.biaya || 0);
                    ongkirInput.value = biaya;
                    ongkirDisplay.value = 'Rp ' + biaya.toLocaleString('id-ID');
                    updateGrandTotal(); // Memperbarui grand total setelah ongkir diupdate
                })
                .catch(error => console.error("Error fetching ongkir:", error)); // Menangani error fetch
        }
    });

    // Fungsi untuk mendapatkan subtotal dari produk di keranjang
    function getSubtotalKeranjang() {
        let subtotal = 0;
        <?php if (!empty($checkout_items)): ?>
            <?php foreach ($checkout_items as $item): ?>
                subtotal += <?= $item['qty'] * $item['price'] ?>;
            <?php endforeach; ?>
        <?php elseif (!empty($keranjang)): ?>
            <?php foreach ($keranjang as $item): ?>
                subtotal += <?= $item['qty'] * $item['price'] ?>;
            <?php endforeach; ?>
        <?php endif; ?>
        return subtotal;
    }

    // Fungsi untuk menghitung total keseluruhan
    function updateGrandTotal() {
        const subtotal = isNaN(getSubtotalKeranjang()) ? 0 : getSubtotalKeranjang(); // Total produk
        const ongkir = isNaN(parseInt(ongkirInput.value)) ? 0 : parseInt(ongkirInput.value); // Ongkir
        const hargaLensa = isNaN(parseInt(document.getElementById('hargaLensaHidden').value)) ? 0 : parseInt(document.getElementById('hargaLensaHidden').value); // Harga lensa

        const grandTotal = subtotal + ongkir + hargaLensa; // Total keseluruhan

        // Update grand total pada tampilan dan input hidden
        grandTotalDisplay.value = 'Rp ' + grandTotal.toLocaleString('id-ID');
        grandTotalHidden.value = grandTotal;
    }

    // Update ongkir saat kota dipilih
    $('#kota').on('change', function () {
        let ongkir = $('option:selected', this).data('ongkir');
        $('#ongkir_display').val('Rp ' + parseInt(ongkir).toLocaleString('id-ID'));
        $('#ongkir').val(ongkir);
        updateGrandTotal(); // Hitung ulang total
    });

    // Inisialisasi saat halaman dimuat
    window.addEventListener('DOMContentLoaded', () => {
        updateHarga(); // Perbarui harga lensa
        updateGrandTotal(); // Perbarui grand total
    });
</script>



