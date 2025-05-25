<div class="container-fluid">
    <h3>Halaman Edit Produk</h3>
    <hr>
    <form method="post" action="<?php echo base_url('Home/proses_edit/' . $produk['id_produk']); ?>" enctype="multipart/form-data">
        
        <!-- Input ID Produk (Hidden) -->
        <input type="hidden" name="id_produk" value="<?php echo $produk['id_produk']; ?>">

        <div class="form-group row">
            <label for="nama_produk" class="col-sm-2 col-form-label">Nama Produk</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="nama_produk" required value="<?php echo $produk['nama_produk']; ?>">
            </div>
        </div>

        <div class="form-group row">
            <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="deskripsi" required value="<?php echo $produk['deskripsi']; ?>">
            </div>
        </div>

        <div class="form-group row">
            <label for="harga" class="col-sm-2 col-form-label">Harga</label>
            <div class="col-sm-8">
                <input type="number" class="form-control" name="harga" required value="<?php echo $produk['harga']; ?>">
            </div>
        </div>

        <div class="form-group row">
            <label for="jumlah_produk" class="col-sm-2 col-form-label">Jumlah Produk</label>
            <div class="col-sm-8">
                <input type="number" class="form-control" name="jumlah_produk" required value="<?php echo $produk['jumlah_produk']; ?>">
            </div>
        </div>

        <div class="form-group row">
            <label for="warna_produk" class="col-sm-2 col-form-label">Warna Produk</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="warna_produk" required value="<?php echo $produk['warna_produk']; ?>">
            </div>
        </div>

        <div class="form-group row">
            <label for="gambar" class="col-sm-2 col-form-label">Gambar</label>
            <div class="col-sm-8">
                <input type="file" class="form-control" name="gambar">
                <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar.</small>
                <br>
                <img src="<?php echo base_url('uploads/' . $produk['gambar']); ?>" width="100">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label"></label>
            <div class="col-sm-5">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="reset" class="btn btn-danger">Reset</button>
            </div>
        </div>

    </form>
</div>