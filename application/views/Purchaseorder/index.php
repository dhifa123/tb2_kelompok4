<!-- application/views/purchase_order/index.php -->

<!-- Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">List Purchase Orders</h1>

    <!-- Example: Menampilkan daftar purchase order -->
    <div class="row mb-3">
        <div class="col-lg-12">
            <a href="<?= base_url('Purchaseorder/add'); ?>" class="btn btn-primary">Tambah Purchase Order</a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Supplier ID</th>
                            <th>Nama Supplier</th>

                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Harga</th>
                            <th>Tanggal PO</th>
                            <!-- Tambahkan kolom lain sesuai data Anda -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($purchase_orders as $po) : ?>
                            <tr>
                                <td><?= $po['id']; ?></td>
                                <td><?= $po['supplier_id']; ?></td>
                                <td><?= $po['Nama_Supplier']; ?></td>

                                <td><?= $po['Nama_barang']; ?></td>
                                <td><?= $po['Qty']; ?></td>
                                <td><?= $po['harga']; ?></td>
                                <td><?= $po['tgl_po']; ?></td>

                                <!-- Tambahkan kolom lain sesuai data Anda -->
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
