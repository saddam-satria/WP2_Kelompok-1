<?php
$cartSummary = 0;
$carts = session()->cart;
$cartAsKG = 0;

if (!is_null($carts)) {
    $cart = $carts[0];
    foreach ($carts as $cart) {
        $qty = (float) $cart->quantity / $cart->quantityPerKG;
        $cartAsKG = $cartAsKG + $qty;
        $cartSummary = $cartSummary + $qty * $cart->itemPrice;
    }

    $cartSummary = $cartSummary + $cart->servicePrice + $cart->packagePrice;
}



?>


<?php if (isset(session()->cart) && count(session()->cart) > 0) : ?>

    <nav class="navbar fixed-bottom ">
        <div class="d-flex" style="width: 100%;">
            <div class="ml-auto">
                <a href="<?= base_url("user/cart") ?>" class="text-decoration-none">
                    <div class="text-white d-flex align-items-center" style="border-radius: 50px; background-color: #4663BE; padding: 15px 25px; box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.25);">
                        <div class="mr-3">
                            <i class="fa-solid fa-cart-shopping" style="font-size: 1.2em;"></i>
                            <span class="badge badge-pill" style="background-color: #8DBAFE;"><?= $cartAsKG ?>KG</span>
                        </div>
                        <span>Rp. <?= number_format($cartSummary) ?></span>
                    </div>
                </a>
            </div>
        </div>
    </nav>

<?php endif ?>