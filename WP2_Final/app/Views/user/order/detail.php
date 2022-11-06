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
                <button class="btn btn-md mx-2" style="background-color: #85f1fe; color: #000;" data-toggle="modal" data-target="#listOrder">Rincian</button>

                <!-- Modal -->
                <div class="modal fade" id="listOrder" tabindex="-1" role="dialog" aria-labelledby="listOrderTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Rincian Cucian</h5>
                            </div>
                            <div class="modal-body px-4">
                                <div class="d-flex my-3">
                                    <div class="d-flex flex-column align-items-start">
                                        <span style="font-weight: 600;">Jenis Service</span>
                                        <span><?= $order->serviceName ?></span>
                                    </div>
                                    <div class="ml-auto d-flex flex-column align-items-end">
                                        <span style="font-weight: 600;">Status</span>
                                        <span><?= $order->status ?></span>
                                    </div>
                                </div>
                                <div class="d-flex my-3">
                                    <div class="d-flex flex-column align-items-start">
                                        <span style="font-weight: 600;">Berat Cucian</span>
                                        <span><?= $order->totalItem ?> KG</span>
                                    </div>
                                    <div class="ml-auto d-flex flex-column align-items-end">
                                        <span style="font-weight: 600;">Total Biaya</span>
                                        <span>Rp. <?= number_format($order->amount, 0, ",", ".") ?></span>
                                    </div>
                                </div>
                                <div class="d-flex my-3">
                                    <div class="d-flex flex-column align-items-start">
                                        <span style="font-weight: 600;">Pembayaran</span>
                                        <span><?= is_null($order->paymentMethod) ? "-" : $order->paymentMethod ?></span>
                                    </div>
                                </div>
                                <div class="mt-5">
                                    <div class="d-flex">
                                        <span style="font-weight: 700;">Rincian Pakaian</span>
                                    </div>
                                    <?php foreach ($items as $item) : ?>
                                        <div class="my-3 py-3 px-4 rounded text-white" style="background-color: #4663be;">
                                            <div class="d-flex">
                                                <span class="text-capitalize"><?= $item->itemName ?></span>
                                                <div class="ml-auto">
                                                    <span><?= $item->quantity ?> pcs</span>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-column align-items-start">
                                                <span>keterangan</span>
                                                <p><?= $item->description ?></p>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

<?= $this->endSection(); ?>