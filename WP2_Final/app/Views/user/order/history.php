<?= $this->extend("layouts/user/dashboard"); ?>

<?= $this->section("content"); ?>

<?= view("components/alert", array("key" => "error")) ?>


<?php if (count($histories) > 0) : ?>

    <section class="py-3 px-5 mt-5" style="background-color: #4663be; border-radius: 10px;">
        <h5 class="text-white">List Cucian Anda</h5>
    </section>

    <section class="py-3 mt-5">

    </section>

<?php else : ?>

    <?= view("components/empty_data", array("message" => "riwayat cucian anda masih kosong")) ?>

<?php endif ?>





<?= $this->endSection(); ?>