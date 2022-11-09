<?= $this->extend("layouts/user/dashboard"); ?>

<?= $this->section("content"); ?>

<?php if (session()->getFlashdata("success")) : ?>
    <?= view("components/alert", array("key" => "success", "alert" => "success")) ?>
<?php else : ?>
    <?= view("components/alert", array("key" => "error")) ?>
<?php endif; ?>


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