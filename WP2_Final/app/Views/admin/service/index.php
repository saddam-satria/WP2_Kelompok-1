<?= $this->extend("layouts/user/dashboard"); ?>

<?= $this->section("content"); ?>

<?php if (session()->getFlashdata("success")) : ?>
    <?= view("components/alert", array("key" => "success", "alert" => "success")) ?>
<?php else : ?>
    <?= view("components/alert", array("key" => "error")) ?>
<?php endif; ?>


<div class="mb-3">
    <button class="btn btn-sm btn-primary text-capitalize" data-toggle="modal" data-target="#serviceModal">
        <i class="fas fa-plus"></i>
    </button>
    <div class="modal fade" id="serviceModal" tabindex="-1" role="dialog" aria-labelledby="serviceModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form action="<?= base_url("admin/items")?>" method="POST" enctype="multipart/form-data">

                    <div class="form-group mb-3">
                        <label for="serviceLogo">Servis Logo</label>
                        <input name="serviceLogo" type="file" class="form-control-file" id="serviceLogo">
                    </div>

                    <div class="mb-3">
                        <label for="serviceName" class="form-label">Nama Servis</label>
                        <input type="text" class="form-control" name="serviceName" id="serviceName" >
                    </div>


                    <div class="mb-3">
                        <label for="servicePrice" class="form-label">Harga Servis</label>
                        <input type="text" class="form-control" name="servicePrice" id="servicePrice" >
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
            ajax: '<?= base_url("admin/service-data") ?>',
            columns: [

                {
                    data: 'serviceName',
                    name: "serviceName",
                    title: "Jenis Servis",
                    orderable: false,
                    searchable: true,
                },
                {
                    data: 'servicePrice',
                    name: "servicePrice",
                    title: "Harga Servis",
                    orderable: false,
                    searchable: true,
                },
                {
                    data: 'action',
                    name: "action",
                    title: "Action",
                    orderable: true,
                    searchable: false,
                },
            ]
        });
    });
</script>

<?= $this->endSection(); ?>