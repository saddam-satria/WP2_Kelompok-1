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
                    <form action="<?= base_url("admin/vouchers") ?>" method="POST" enctype="multipart/form-data">


                        <div class="mb-3">
                            <label for="discount" class="form-label">Potongan Harga</label>
                            <input type="text" class="form-control" name="discount" id="discount">
                        </div>

                        <div class="form-check mb-3">
                            <input name="isPercentage" class="form-check-input" type="checkbox" id="isPercentage">
                            <label class="form-check-label" for="isPercentage">
                                Satuan Persen
                            </label>
                        </div>

                        <div class="mb-3">
                            <label for="expire" class="form-label">Kadaluarsa</label>
                            <input type="date" class="form-control" name="expire" id="expire">
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


<?= view("components/table", array("tableName" => "vouchers")) ?>


<?= $this->endSection(); ?>


<?= $this->section("scripts"); ?>

<script>
    $(document).ready(function() {
        $('#vouchers').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: '<?= base_url("admin/voucher-data") ?>',
            columns: [

                {
                    data: 'voucherCode',
                    name: "voucherCode",
                    title: "Kode Voucher",
                    orderable: false,
                    searchable: true,
                },
                {
                    data: 'expire',
                    name: "expire",
                    title: "Masa Berlaku",
                    orderable: true,
                    searchable: false,
                },
                {
                    data: 'discount',
                    name: "discount",
                    title: "Potongan Harga",
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