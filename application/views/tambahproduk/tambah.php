<div class="container-fluid">
    <h3>Halaman Tambah Produk</h3>
    <hr>
    <form method="post" action="<?php echo base_url('Home/proses_tambah'); ?>" enctype="multipart/form-data">

        <div class="form-group row">
            <label for="id_produk" class="col-sm-2 col-form-label">ID Produk</label>
            <div class="col-sm-8">
                <input type="number" class="form-control" name="id_produk" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="nama_produk" class="col-sm-2 col-form-label">Nama Produk</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="nama_produk" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="deskripsi" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="harga" class="col-sm-2 col-form-label">Harga</label>
            <div class="col-sm-8">
                <input type="number" class="form-control" name="harga" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="jumlah_produk" class="col-sm-2 col-form-label">Jumlah Produk</label>
            <div class="col-sm-8">
                <input type="number" class="form-control" name="jumlah_produk" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="warna_produk" class="col-sm-2 col-form-label">Warna Produk</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="warna_produk" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="gambar" class="col-sm-2 col-form-label">Gambar</label>
            <div class="col-sm-8">
                <input type="file" class="form-control" name="gambar" required>
                <small class="text-muted">Format gambar: JPG, PNG, atau JPEG.</small>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label"></label>
            <div class="col-sm-5">
                <button type="submit" class="btn btn-primary">Tambah</button>
                <button type="reset" class="btn btn-danger">Reset</button>
            </div>
        </div>

    </form>
</div>