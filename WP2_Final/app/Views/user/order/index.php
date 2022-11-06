<?= $this->extend("layouts/user/dashboard"); ?>

<?= $this->section("content"); ?>

<?php if (session()->getFlashdata("success")) : ?>
    <?= view("components/alert", array("key" => "success", "alert" => "success")) ?>
<?php else : ?>
    <?= view("components/alert", array("key" => "error")) ?>
<?php endif; ?>

<?php if (count($orders) > 0) : ?>

    <section class="py-3 px-5 mt-5" style="background-color: #4663be; border-radius: 10px;">
        <h5 class="text-white">List Cucian Anda</h5>
    </section>

    <section class="py-3 mt-5">
        <?php foreach ($orders as $order) : ?>
            <div class="d-flex mb-4">
                <span style="color: #535353;" class="text-capitalize"><?= $order->serviceName ?></span>
                <div class="ml-auto">
                    <span style="color: #535353;"><?= $order->totalItem ?> kg</span>
                </div>
            </div>
            <div class="d-flex mb-4">
                <div class="d-flex align-items-center text-white" style="border-radius: 20px; background-color: #21aee4; flex:0.99">
                    <div class="py-2 text-center" style="width:  <?= str_contains(strtolower($order->status), "diterima") ? "25%" : str_contains(strtolower($order->status), ("sedang dicuci" ? "50%" : str_contains(strtolower($order->status), "sudah selesai")) ? "75%" : "100%") ?>; border-radius: 20px; background-color: #8dbafe;">
                        <?= str_contains(strtolower($order->status), "diterima") ? "25%" : str_contains(strtolower($order->status), ("sedang dicuci" ? "50%" : str_contains(strtolower($order->status), "sudah selesai")) ? "75%" : "100%") ?>
                    </div>
                    <span class="ml-4"><?= $order->status ?></span>
                </div>
                <a href="<?= base_url("/user/order/" . $order->id) ?>" class="btn btn-md mx-2" style="background-color: #85f1fe; color: #000;">Detail</a>
            </div>
        <?php endforeach; ?>
    </section>

<?php else : ?>
    <?= view("components/empty_data", array("message" => "cucian anda masih kosong")) ?>
<?php endif ?>


<?= view("components/cart_notification") ?>



<?= $this->endSection(); ?>