<?php
$cartSummary = 0;
$cart = $carts[0];
$cartAsKG = 0;

if (!is_null($carts)) {
    foreach ($carts as $cart) {
        $qty = (float) $cart->quantity / $cart->quantityPerKG;
        $cartAsKG = $cartAsKG + $qty;
        $cartSummary = $cartSummary + $qty * $cart->itemPrice;
    }


    $cartSummary = $cartSummary + $cart->servicePrice + $cart->packagePrice;
}
?>

<?= $this->extend("layouts/user/dashboard"); ?>

<?= $this->section("content"); ?>

<?php if (session()->getFlashdata("success")) : ?>
    <?= view("components/alert", array("key" => "success", "alert" => "success")) ?>
<?php else : ?>
    <?= view("components/alert", array("key" => "error")) ?>
<?php endif; ?>


<section class="py-3 px-5 mt-5" style="background-color: #4663be; border-radius: 10px;">
    <h5 class="text-white">Keranjang</h5>
</section>

<?php if (!is_null($carts) && count($carts) > 0) : ?>

    <section class="py-3 mt-5">
        <div class="row">
            <div class="col-sm-12 col-md-8 mb-3">
                <?php foreach ($carts as $cart) : ?>
                    <div class="mb-5">
                        <div class="d-flex justify-content-between align-items-center">
                            <img src="<?= base_url("assets/img/tshirt.png") ?>" alt="Pakaian">
                            <div class="d-flex flex-column">
                                <span style="font-weight: 600;">Jumlah</span>
                                <span><?= $cart->quantity / $cart->quantityPerKG ?> kg</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <form action="<?= base_url("/user/cart?item-id=" . $cart->id . "&action=decrease") ?>" method="POST">
                                    <button type="submit" class="btn btn-sm btn-<?= (int) $cart->quantity > 1 ? "primary" : "secondary" ?>" <?= (int)$cart->quantity > 1 ? "" : "disabled" ?>>-</button>
                                </form>

                                <span class="badge badge-sm badge-primary mx-1"><?= $cart->quantity ?> pcs</span>

                                <form action="<?= base_url("/user/cart?item-id=" . $cart->id . "&action=increase") ?>" method="POST">
                                    <button type="submit" class="btn btn-sm btn-primary">+</button>
                                </form>
                            </div>
                            <div>
                                <form action="<?= base_url("/user/cart?item-id=" . $cart->id . "&action=delete") ?>" method="POST">
                                    <button type="submit" class="btn btn-sm btn-danger">x</button>
                                </form>
                            </div>
                        </div>
                        <div class="my-2 d-flex">
                            <div>
                                <span style="font-weight: 600;">Keterangan</span>
                                <p class="text-capitalize"><?= $cart->description ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>


            </div>
            <div class="col-sm-12 col-md-1">
            </div>
            <div class="col-sm-12 col-md-3">
                <div class="d-flex flex-column" style="height: 100%; width: 100%;">
                    <div class="d-flex justify-content-between mb-3">
                        <span style="font-weight: 600;">Total Pakaian</span>
                        <span><?= $cartAsKG ?> /kg</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span style="font-weight: 600;">Biaya service <?= $carts[0]->serviceName ?></span>
                        <span><?= number_format($carts[0]->servicePrice) ?> /kg</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span style="font-weight: 600;">Biaya paket <?= $carts[0]->packageName ?></span>
                        <span><?= number_format($carts[0]->packagePrice) ?> /kg</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span style="font-weight: 600;">Total Harga</span>
                        <span><?= number_format($cartSummary) ?> /kg</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex my-5 justify-content-end">
            <a href="#" class="btn btn-md mx-2 btn-danger">reset</a>
            <a href="#" class="btn btn-md mx-2" style="background-color: #85f1fe; color: #000;">Checkout</a>
        </div>











    </section>
<?php else : ?>
    <?= view("components/empty_data", array("message" => "keranjang anda masih kosong")) ?>
<?php endif; ?>


<?= $this->endSection(); ?>