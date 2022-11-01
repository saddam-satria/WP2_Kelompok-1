<?= $this->extend("layouts/user/dashboard"); ?>

<?= $this->section("content"); ?>

<?= view("components/alert", array("key" => "error")) ?>

<section class="py-3 px-5 mt-5" style="background-color: #4663be; border-radius: 10px;">
    <h5 class="text-white">Keranjang</h5>
</section>

<?php if (!is_null($carts) && count($carts) > 0) : ?>

    <section class="py-3 mt-5">
        <?php foreach ($carts as $cart) : ?>

            <span><?= $cart->serviceName ?></span>

        <?php endforeach ?>



        <div class="d-flex my-5 justify-content-end">
            <a href="#" class="btn btn-md mx-2 btn-danger">reset</a>
            <a href="#" class="btn btn-md mx-2" style="background-color: #85f1fe; color: #000;">Checkout</a>
        </div>
    </section>
<?php else : ?>
    <?= view("components/empty_data", array("message" => "keranjang anda masih kosong")) ?>
<?php endif; ?>


<?= $this->endSection(); ?>