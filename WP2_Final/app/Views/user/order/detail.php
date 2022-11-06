<?= $this->extend("layouts/user/dashboard"); ?>

<?= $this->section("content"); ?>

<?= view("components/alert", array("key" => "error")) ?>

<div class="container">
    <div class="d-flex flex-column align-items-center py-5 mt-5">
        <img src="<?= base_url("assets/img/undraw_note_list_re_r4u9.svg") ?>" alt="not found" style="width: 260px; height: 260px;object-fit: contain;">
    </div>

    <section class="py-3">
        <h5 style="color: #535353;" class="text-center">Cucian Anda Saat Ini</h5>
        <div class="d-flex flex-column">
            <div class="d-flex align-items-center text-white my-3" style="border-radius: 20px; background-color: #21aee4; flex:0.99">
                <div class="py-2 text-center" style="width: <?= str_contains(strtolower($order->status), "diterima") ? "25%" : str_contains(strtolower($order->status), ("sedang dicuci" ? "50%" : str_contains(strtolower($order->status), "sudah selesai")) ? "75%" : "100%") ?>; border-radius: 20px; background-color: #8dbafe;">
                    <?= str_contains(strtolower($order->status), "diterima") ? "25%" : str_contains(strtolower($order->status), ("sedang dicuci" ? "50%" : str_contains(strtolower($order->status), "sudah selesai")) ? "75%" : "100%") ?>
                </div>
                <span class="ml-4"><?= $order->status ?></span>
            </div>
            <div class="mt-2 text-center">
                <a href="#" class="btn btn-md mx-2" style="background-color: #85f1fe; color: #000;">Rincian</a>
            </div>
        </div>
    </section>

</div>

<?= $this->endSection(); ?>