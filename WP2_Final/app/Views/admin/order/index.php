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
            ajax: '<?= base_url("admin/order-data") ?>',
            columns: [

                {
                    data: 'email',
                    name: "email",
                    title: "Email",
                    orderable: false,
                    searchable: true,
                },
                {
                    data: 'amount',
                    name: "amount",
                    title: "Total Bayar",
                    orderable: false,
                    searchable: false,
                },
                {
                    data: 'paymentMethod',
                    name: "paymentMethod",
                    title: "Metode Pembayaran",
                    orderable: false,
                    searchable: false,
                },
                {
                    data: 'token',
                    name: "token",
                    title: "Kode Pembayaran",
                    orderable: false,
                    searchable: true,
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