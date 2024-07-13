<?php
// Assuming $supplier_produk contains your supplier data
$unique_suppliers = [];
foreach ($supplier_produk as $sp) {
    $unique_suppliers[$sp['Nama_Supplier']] = $sp;
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-bottom-primary">
                <div class="card-header bg-white py-3">
                    <div class="row">
                        <div class="col">
                            <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                                Form Tambah Purchase Order
                            </h4>
                        </div>
                        <div class="col-auto">
                            <a href="<?= base_url('supplier') ?>" class="btn btn-sm btn-secondary btn-icon-split">
                                <span class="icon">
                                    <i class="fa fa-arrow-left"></i>
                                </span>
                                <span class="text">
                                    Kembali
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <?= $this->session->flashdata('pesan'); ?>
                    <form action="<?= base_url('purchaseorder/store') ?>" method="POST">
                        <div class="form-group">
                            <label for="supplier">Supplier</label>
                            <select name="supplier" id="supplier" class="form-control">
                                <option value="">Pilih Supplier</option>
                                <?php foreach ($unique_suppliers as $sp) : ?>
                                    <option value="<?= $sp['supplier_id']; ?>"><?= $sp['Nama_Supplier']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
    <label for="produk">Produk</label>
    <select name="produk[]" id="produk" class="form-control" multiple>
        <option value="">Pilih Produk</option>
    </select>
</div>

                        <div class="form-group">
                            <label for="harga">Total Tagihan</label>
                            <input type="number" class="form-control" id="harga" name="harga" placeholder="Harga" readonly>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Quantity">
                        </div>
                        <div class="form-group">
    <label for="total_po">Total PO</label>
    <input type="number" class="form-control" id="total_po" name="total_po" placeholder="Total PO" readonly>
</div>

<div class="form-group">
    <label for="po_date">PO Date</label>
    <input type="date" class="form-control" id="po_date" name="po_date">
</div>

                        <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#supplier').change(function() {
        var supplier_id = $(this).val();
        if (supplier_id) {
            $.ajax({
                url: '<?= base_url('purchaseorder/get_products_by_supplier/') ?>' + supplier_id,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#produk').empty();
                    $('#produk').append('<option value="">Pilih Produk</option>');
                    $.each(data, function(key, value) {
                        $('#produk').append('<option value="' + value.id_produk + '">' + value.Nama_barang + '</option>');
                    });
                }
            });
        } else {
            $('#produk').empty();
            $('#produk').append('<option value="">Pilih Produk</option>');
        }
    });

    $('#produk').change(function() {
        var selected_produk_ids = $(this).val();
        var supplier_id = $('#supplier').val();

        // Clear previous values
        $('#harga').val('');
        $('#total_po').val('');
        $('#total_tagihan').val('');

        // If no produk selected, return
        if (!selected_produk_ids || selected_produk_ids.length === 0) {
            return;
        }

        // Retrieve harga for each selected produk
        selected_produk_ids.forEach(function(produk_id) {
            $.ajax({
                url: '<?= base_url('purchaseorder/get_product_price/') ?>' + produk_id + '/' + supplier_id,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    console.log(data); // For debugging purposes
                    // Update the harga field for each produk
                    var current_harga = parseFloat($('#harga').val()) || 0;
                    var new_harga = current_harga + parseFloat(data.price);
                    $('#harga').val(new_harga.toFixed(2));

                    // Calculate and update total PO and total tagihan
                    var total_po = selected_produk_ids.length;
                    $('#total_po').val(total_po);

                    var total_tagihan = new_harga * $('#quantity').val(); // Adjust this calculation based on your requirement
                    $('#total_tagihan').val(total_tagihan.toFixed(2));
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown); // For debugging error
                }
            });
        });
    });
});

</script>
