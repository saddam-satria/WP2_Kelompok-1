<?= $this->extend("layouts/user/dashboard"); ?>

<?= $this->section("content"); ?>

<?php if (session()->getFlashdata("success")) : ?>
    <?= view("components/alert", array("key" => "success", "alert" => "success")) ?>
<?php else : ?>
    <?= view("components/alert", array("key" => "error")) ?>
<?php endif; ?>

<div class="mb-4">
    <button class="btn btn-sm btn-primary text-capitalize" data-toggle="modal" data-target="#packageModal">
        <i class="fas fa-plus"></i>
    </button>
    <div class="modal fade" id="packageModal" tabindex="-1" role="dialog" aria-labelledby="packageModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form action="<?= base_url("admin/packages/create")?>" method="POST">

                    <div class="mb-3">
                        <label for="packageName" class="form-label">Nama Paket</label>
                        <input type="text" class="form-control" name="packageName" id="packageName" >
                        
                    </div>


                    <div class="mb-3">
                        <label for="packagePrice" class="form-label">Harga Paket</label>
                        <input type="text" class="form-control" name="packagePrice" id="packagePrice" >
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
            ajax: '<?= base_url("admin/package-data") ?>',
            columns: [

                {
                    data: 'packageName',
                    name: "packageName",
                    title: "Nama Paket",
                    orderable: false,
                    searchable: true,
                },
                {
                    data: 'packagePrice',
                    name: "packagePrice",
                    title: "Harga Paket",
                    orderable: true,
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