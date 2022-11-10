<?= $this->extend("layouts/user/dashboard"); ?>

<?= $this->section("content"); ?>

<?php if (session()->getFlashdata("success")) : ?>
    <?= view("components/alert", array("key" => "success", "alert" => "success")) ?>
<?php else : ?>
    <?= view("components/alert", array("key" => "error")) ?>
<?php endif; ?>


<div class="mb-3">
    <button class="btn btn-sm btn-primary text-capitalize" data-toggle="modal" data-target="#itemModal">
        <i class="fas fa-plus"></i>
    </button>
    <div class="modal fade" id="itemModal" tabindex="-1" role="dialog" aria-labelledby="itemModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form action="<?= base_url("admin/items")?>" method="POST" enctype="multipart/form-data">

                    <div class="form-group mb-3">
                        <label for="itemLogo">Pakaian Thumbnail</label>
                        <input name="itemLogo" type="file" class="form-control-file" id="itemLogo">
                    </div>

                    <div class="mb-3">
                        <label for="itemName" class="form-label">Jenis Pakaian</label>
                        <input type="text" class="form-control" name="itemName" id="itemName" >
                    </div>


                    <div class="mb-3">
                        <label for="itemPrice" class="form-label">Harga Per KG</label>
                        <input type="text" class="form-control" name="itemPrice" id="itemPrice" >
                    </div>

                    <div class="mb-3">
                        <label for="quantityPerKG" class="form-label">Jumlah perKG</label>
                        <input type="text" class="form-control" name="quantityPerKG" id="quantityPerKG" >
                    </div>


                    <div class="form-check mb-3">
                        <input name="isSneaker" class="form-check-input" type="checkbox" id="isSneaker">
                         <label class="form-check-label" for="isSneaker">
                            Sneaker atau Bukan
                        </label>
                    </div>

                    <div class="d-flex">
                        <div class="ml-auto">
                            <button type="submit" class="btn btn-sm" style="background-color: #85f1fe; color: #000000;">Tambah</button>
                        </div>
                    </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?= view("components/table", array("tableName" => "orders")) ?>


<?= $this->endSection(); ?>


<?= $this->section("scripts"); ?>

<script>
    $(document).ready(function() {
        $('#orders').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: '<?= base_url("admin/item-data") ?>',
            columns: [

                {
                    data: 'itemName',
                    name: "itemName",
                    title: "Jenis Pakaian",
                    orderable: false,
                    searchable: true,
                },
                {
                    data: 'itemPrice',
                    name: "itemPrice",
                    title: "Harga Perkg",
                    orderable: true,
                    searchable: false,
                },
                {
                    data: 'quantityPerKG',
                    name: "quantityPerKG",
                    title: "Estimasi KG",
                    orderable: false,
                    searchable: false,
                },
                {
                    data: 'action',
                    name: "action",
                    title: "Action",
                    orderable: false,
                    searchable: false,
                },
            ]
        });
    });
</script>

<?= $this->endSection(); ?>