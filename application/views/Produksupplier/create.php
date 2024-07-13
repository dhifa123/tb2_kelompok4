<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Tambah Produk Supplier</h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="<?= base_url('produksupplier/store') ?>" method="POST">
                <div class="form-group">
                    <label for="supplier">Supplier</label>
                    <select name="supplier" id="supplier" class="form-control">
                        <option value="">Pilih Supplier</option>
                        <?php foreach ($supplier as $s) : ?>
                            <option value="<?= $s['id']; ?>"><?= $s['Nama_Supplier']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <?php foreach ($produk as $p) : ?>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="product_name">Nama Produk</label>
                            <select name="product_name[]" id="product_name" class="form-control">
                                <option value=""></option>
                                <option value="<?= $p['id_produk']; ?>"><?= $p['Nama_barang']; ?></option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="price">Harga</label>
                            <input type="number" class="form-control" id="price" name="price[]" value="">
                        </div>
                    </div>
                <?php endforeach; ?>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary" name="kirim">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>
