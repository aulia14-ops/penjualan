<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg">
            <?php if (validation_errors()): ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>

            <?= $this->session->flashdata('message'); ?>

            <a href="#" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#productModal">Add New Product</a>

            <table class="table table-hover table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>ID Produk</th>
                        <th>Nama Produk</th>
                        <th>Deskripsi</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Gambar</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; foreach ($produk as $p): ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $p['id_produk']; ?></td>
                            <td><?= $p['nama_produk']; ?></td>
                            <td><?= $p['deskripsi']; ?></td>
                            <td>Rp <?= number_format($p['harga'], 0, ',', '.'); ?></td>
                            <td><?= $p['jumlah_produk']; ?></td>
                            <td>
                                <img src="<?= base_url('uploads/' . $p['gambar']); ?>" alt="<?= $p['nama_produk']; ?>" width="50">
                            </td>
                            <td>
                                <a href="<?= base_url('admin/edit_produk/' . $p['id_produk']); ?>" class="badge bg-success text-light">Edit</a>
                                <a href="<?= base_url('produk/hapus/' . $p['id_produk']); ?>" class="badge bg-danger text-light" onclick="return confirm('Are you sure?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Add/Edit Product -->
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="productModalLabel">Add New Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form id="productForm" action="<?= base_url('produk/tambah'); ?>" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group mb-3">
            <label for="nama_produk">Product Name</label>
            <input type="text" class="form-control" id="nama_produk" name="nama_produk" placeholder="Enter product name" required>
          </div>

          <div class="form-group mb-3">
            <label for="deskripsi">Description</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="Enter product description" required></textarea>
          </div>

          <div class="form-group mb-3">
            <label for="harga">Price</label>
            <input type="number" class="form-control" id="harga" name="harga" placeholder="Enter product price" required>
          </div>

          <div class="form-group mb-3">
            <label for="jumlah">Product Quantity</label>
            <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Enter product quantity" required>
          </div>

          <div class="form-group mb-3">
            <label for="gambar">Upload Image</label>
            <input type="file" class="form-control" id="gambar" name="gambar">
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="saveButton">Add Product</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
