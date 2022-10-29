<?= $this->extend("layouts/user/dashboard"); ?>

<?= $this->section("content"); ?>

<?= view("components/alert", array("key" => "error")) ?>

<section class="py-3 px-5 mt-5" style="background-color: #4663be; border-radius: 10px;">
    <h5 class="text-white">Keranjang</h5>
</section>

<?php if (count($carts) > 0) : ?>

    <section class="py-3 mt-5">


        <?php foreach ($carts as $cart) : ?>
            <div class="row mb-5">

                <div class="col-sm-12 col-md-6 col-lg-1 mb-3">
                    <form action="#">
                        <button type="submit" class="btn btn-sm">
                            <i class="fa-solid fa-trash text-lg text-danger"></i>
                        </button>
                    </form>

                </div>
                <div class="col-sm-12 col-md-6 col-lg-3 mb-3">
                    <div class="d-flex align-items-center">
                        <img src="<?= base_url("assets/img/tshirt.png") ?>" alt="">
                        <div class="d-flex flex-column">
                            <span style="font-weight: 600;">
                                <?= $cart->item ?>
                            </span>
                            <span style="font-size: 0.9em;">
                                layanan : <?= $cart->service ?>
                            </span>
                            <span style="font-size: 0.9em;">
                                paket : <?= $cart->package ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 mb-3">
                    <div class="d-flex flex-column">
                        <span style="font-weight: 600;">Keterangan</span>
                        <span><?= $cart->description ?></span>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-2 mb-3">
                    <div class="d-flex flex-column">
                        <span style="font-weight: 600;">Jumlah</span>
                        <div class="d-flex align-items-center">
                            <form action="#">
                                <button type="submit" class="btn btn-sm btn-primary">-</button>
                            </form>
                            <span class="px-2"> <?= $cart->quantity ?> pcs</span>
                            <form action="#">
                                <button type="submit" class="btn btn-sm btn-primary">+</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        <?php endforeach ?>



        <div class="d-flex my-5 justify-content-end">
            <a href="#" class="btn btn-md mx-2" style="background-color: #85f1fe; color: #000;">Checkout</a>
        </div>
    </section>
<?php else : ?>
    <?= view("components/empty_data", array("message" => "keranjang anda masih kosong")) ?>
<?php endif; ?>


<?= $this->endSection(); ?>