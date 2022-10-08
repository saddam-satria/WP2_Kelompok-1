<?= $this->extend("layouts/main"); ?>



<?= $this->section("content"); ?>
<?= view("components/navbar"); ?>
<div class="container mt-5">
    <?= $this->renderSection("content"); ?>
</div>

<?= $this->endSection(); ?>