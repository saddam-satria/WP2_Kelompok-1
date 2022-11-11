<?= $this->extend("layouts/user/dashboard"); ?>

<?= $this->section("content"); ?>

<?php if (session()->getFlashdata("success")) : ?>
    <?= view("components/alert", array("key" => "success", "alert" => "success")) ?>
<?php else : ?>
    <?= view("components/alert", array("key" => "error")) ?>
<?php endif; ?>

<section>
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <form action="#" method="POST">
                <div class="d-flex flex-column">

                    <div class="mb-3">
                            <label for="token" class="form-label">Kode Pemesanan</label>
                            <input disabled value="<?= $order->token ?>" type="text" class="form-control" id="token" readonly >
                        </div>

                    <div class="mb-3">
                        <label for="paymentMethod" class="form-label">Metode Pembayaran</label>
                        <input disabled value="<?= is_null($order->paymentMethod ) ? "-": $order->paymentMethod?>" type="text" class="form-control" name="paymentMethod" id="paymentMethod" >
                    </div>

                    <div class="mb-3">
                        <label for="status">Status Cucian</label>
                        <input disabled value="<?= $order->status?>" type="text" class="form-control" name="status" id="status" >
                    </div>

                    <div class="mb-3">
                        <label for="totalItem" class="form-label">Total Timbangan</label>
                        <input disabled value="<?= $order->totalItem?>" type="text" class="form-control" id="totalItem" name="totalItem" >
                    </div>

                    <div class="mb-3">
                        <label for="amount" class="form-label">Jumlah Pembayaran</label>
                        <input disabled value="<?= number_format($order->amount,0,".",".")?>" type="text" class="form-control" id="amount" readonly >
                    </div>

                    <div class="mb-3">
                        <label for="payment" class="form-label">Bayar</label>
                        <input disabled value="<?= $order->payment?>" type="text" class="form-control" name="payment" id="payment" >
                    </div>
                        
                  
                    <div class="mb-3">
                        <label for="isFinish" class="form-label">Status Cucian</label>
                        <input disabled value="<?= $order->isFinish ? "Selesai" : "Belum Selesai"?>" type="text" class="form-control" name="isFinish" id="isFinish" >
                    </div>


                    <div class="mb-3">
                        <label for="isTrouble" class="form-label">Apakah ada kendala</label>
                        <input disabled value="<?= $order->isTrouble ? "Ada" : "Tidak Ada"?>" type="text" class="form-control" name="isTrouble" id="isTrouble" >
                    </div>

                    <div class="mb-3">
                    <label for="description" class="form-label">Keterangan</label>
                            <textarea disabled name="description" rows="4" id="description" class="form-control" style="resize: none;"><?= is_null($order->description) ? "-": $order->description?></textarea>
                    </div>

                    <div class="d-flex">
                        <div class="ml-auto">
                            <button type="button" class="btn btn-sm mx-2" style="background-color: #85f1fe; color: #000;" data-toggle="modal" data-target="#listOrder">Rincian Pakaian</button>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="listOrder" tabindex="-1" role="dialog" aria-labelledby="listOrderTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header text-white" style="background-color: #4663be;">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Rincian Pakaian</h5>
                                </div>
                                <div class="modal-body px-4">
                                    <div class="mt-5">
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
            </form>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>