<!-- application/views/produk/index.php -->
<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Daftar Produk Supplier</h1>
    <p class="mb-4">Berikut adalah daftar produk supplier yang tersedia.</p>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Produk Supplier</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Barang</th>
                            <th>Harga</th>
                            <th>Qty</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($produksupplier as $ps) : ?>
                            <tr>
                                <td><?= $ps['Nama_barang']; ?></td>
                                <td><?= $ps['price']; ?></td>
                                <td>
                                    <?= $ps['Qty']; ?>
                                </td>
                                <td>
                                    <a href="<?= base_url('produksupplier/delete/' . $ps['id']); ?>" class="btn btn-danger btn-sm btn-delete">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>    
                    </tbody>
                </table>
            </div>  
        </div>
    </div>

    <div class="row mt-3">
        <div class="col">
            <a href="<?= base_url('produksupplier/create'); ?>" class="btn btn-primary">Tambah Produk</a>
        </div>
    </div>

</div>