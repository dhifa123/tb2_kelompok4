<!-- application/views/produk/index.php -->
<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Daftar Produk</h1>
    <p class="mb-4">Berikut adalah daftar produk yang tersedia.</p>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Produk</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID Produk</th>
                            <th>Nama Barang</th>
                            <th>Qty</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($produk as $prod) : ?>
                            <tr>
                                <td><?= $prod['id_produk']; ?></td>
                                <td><?= $prod['Nama_barang']; ?></td>
                                <td><?= $prod['Qty']; ?></td>
                                <td>
                                    <a href="<?= base_url('produk/edit/' . $prod['id_produk']); ?>" class="btn btn-warning btn-sm mr-2">Edit</a>
                                    <a href="<?= base_url('produk/delete/' . $prod['id_produk']); ?>" class="btn btn-danger btn-sm btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">Hapus</a>
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
            <a href="<?= base_url('produk/create'); ?>" class="btn btn-primary">Tambah Produk</a>
        </div>
    </div>

</div>
