<?= $this->extend("layouts/user/dashboard"); ?>

<?= $this->section("content"); ?>

<?= view("components/alert", array("key" => "error")) ?>


<?= $this->endSection(); ?>