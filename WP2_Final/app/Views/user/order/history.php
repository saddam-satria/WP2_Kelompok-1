<?= $this->extend("layouts/user/dashboard"); ?>

<?= $this->section("content"); ?>

<?= view("components/alert", array("key" => "error")) ?>


<?= view("components/empty_data", array("message" => "riwayat cucian anda masih kosong")) ?>



<?= $this->endSection(); ?>