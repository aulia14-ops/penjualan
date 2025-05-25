<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <?php if (validation_errors()): ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>

            <?= $this->session->flashdata('message'); ?>

            <form action="<?= base_url('admin/update_produk/' . $produk['id_produk']); ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id_produk" value="<?= $produk['id_produk']; ?>">

                <div class="form-group mb-3">
                    <label for="nama_produk">Product Name</label>
                    <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="<?= set_value('nama_produk', $produk['nama_produk']); ?>" required>
                </div>

                <div class="form-group mb-3">
                    <label for="deskripsi">Description</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required><?= set_value('deskripsi', $produk['deskripsi']); ?></textarea>
                </div>

                <div class="form-group mb-3">
                    <label for="harga">Price</label>
                    <input type="number" class="form-control" id="harga" name="harga" value="<?= set_value('harga', $produk['harga']); ?>" required>
                </div>

                <div class="form-group mb-3">
                    <label for="jumlah_produk">Product Quantity</label>
                    <input type="number" class="form-control" id="jumlah_produk" name="jumlah_produk" value="<?= set_value('jumlah_produk', $produk['jumlah_produk']); ?>" required>
                </div>

                <div class="form-group mb-3">
                    <label for="gambar">Current Image</label><br>
                    <?php if (!empty($produk['gambar'])): ?>
                        <img src="<?= base_url('uploads/' . $produk['gambar']); ?>" alt="<?= $produk['nama_produk']; ?>" width="100">
                    <?php else: ?>
                        <p>No image uploaded.</p>
                    <?php endif; ?>
                </div>

                <div class="form-group mb-3">
                    <label for="gambar">Change Image (optional)</label>
                    <input type="file" class="form-control" id="gambar" name="gambar">
                </div>

                <button type="submit" class="btn btn-success">Update Product</button>
                <a href="<?= base_url('admin/produk'); ?>" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
</div>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
