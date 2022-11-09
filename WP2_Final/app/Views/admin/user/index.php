<?= $this->extend("layouts/user/dashboard"); ?>

<?= $this->section("content"); ?>


<?php if (session()->getFlashdata("success")) : ?>
    <?= view("components/alert", array("key" => "success", "alert" => "success")) ?>
<?php else : ?>
    <?= view("components/alert", array("key" => "error")) ?>
<?php endif; ?>


<?php if(!is_null($isAdmin)):?>

   <div class="mb-4">
        <a href="<?= base_url("/admin/users/create")?>" class="btn btn-sm btn-primary text-capitalize">tambah admin</a>
   </div>

<?php endif?>    

<?= view("components/table", array("tableName" => "users")) ?>


<?= $this->endSection(); ?>


<?= $this->section("scripts"); ?>

<script>
    $(document).ready(function() {
        $('#users').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: '<?= $isAdmin ? base_url("admin/user-data?is_admin=" . true) : base_url("admin/user-data") ?>',
            columns: [

                {
                    data: 'email',
                    name: "email",
                    title: "Email",
                    orderable: false,
                    searchable: false,
                },
                {
                    data: 'name',
                    name: "name",
                    title: "Nama Lengkap",
                    orderable: false,
                    searchable: false,
                },
                {
                    data: 'address',
                    name: "address",
                    title: "Alamat",
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