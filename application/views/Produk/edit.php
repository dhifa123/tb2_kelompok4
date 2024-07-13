<!-- application/views/produk/edit.php -->
<div class="container">
    <h2>Edit Produk</h2>
    <?php echo form_open('produk/update'); ?>
        <input type="hidden" name="id_produk" value="<?php echo set_value('id_produk', isset($produk['id_produk']) ? $produk['id_produk'] : ''); ?>">
        
        <div class="form-group">
            <label for="nama_barang">Nama Barang</label>
            <input type="text" class="form-control" id="Nama_barang" name="Nama_barang" value="<?php echo set_value('Nama_barang', isset($produk['Nama_barang']) ? $produk['Nama_barang'] : ''); ?>" required>
            <!-- Tambahkan pesan kesalahan validasi di sini jika diperlukan -->
        </div>
        
        <div class="form-group">
            <label for="qty">Qty</label>
            <input type="number" class="form-control" id="qty" name="qty" value="<?php echo set_value('Qty', isset($produk['Qty']) ? $produk['Qty'] : ''); ?>" required>
            <!-- Tambahkan pesan kesalahan validasi di sini jika diperlukan -->
        </div>
        
        <button type="submit" class="btn btn-primary">Update Produk</button>
    <?php echo form_close(); ?>
</div>
