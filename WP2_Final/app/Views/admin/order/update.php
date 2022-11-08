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
            <form action="<?= base_url("admin/order/edit/" . $order->id) ?>" method="POST">
                <div class="d-flex flex-column">

                    <div class="mb-3">
                            <label for="token" class="form-label">Kode Pemesanan</label>
                            <input value="<?= $order->token ?>" type="text" class="form-control" id="token" readonly >
                        </div>

                    <div class="mb-3">
                        <label for="paymentMethod" class="form-label">Metode Pembayaran</label>
                        <input value="<?= $order->paymentMethod?>" type="text" class="form-control" name="paymentMethod" id="paymentMethod" >
                    </div>
                   
                    <div class="form-group mb-3">
                        <label for="status">Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="<?=$order->status?>" selected><?= $order->status?></option>
                            <?php foreach($statusOrders as $status):?>
                                <option value="<?=$status?>"><?=$status?></option>
                            <?php endforeach?>
                        </select>
                    </div>



                    <div class="mb-3">
                        <label for="totalItem" class="form-label">Total Timbangan</label>
                        <input disabled value="<?= $order->totalItem?>" type="text" class="form-control" id="totalItem" name="totalItem" >
                    </div>

                    <div class="mb-3">
                        <label for="amount" class="form-label">Jumlah Pembayaran</label>
                        <input value="<?= number_format($order->amount,0,".",".")?>" type="text" class="form-control" id="amount" readonly >
                    </div>

                    <div class="mb-3">
                        <label for="payment" class="form-label">Bayar</label>
                        <input value="<?= $order->payment?>" type="text" class="form-control" name="payment" id="payment" >
                    </div>

                    <div class="form-check mb-3">
                        <input name="isTrouble" class="form-check-input" type="checkbox" <?= $order->isTrouble ? "checked" : ""?> id="isTrouble">
                         <label class="form-check-label" for="isTrouble">
                            Terkendala atau tidak
                        </label>
                    </div>
                        
                    <div class="mb-3">
                    <label for="description" class="form-label">Keterangan</label>
                            <textarea name="description" rows="4" id="description" class="form-control" style="resize: none;"><?= $order->description?></textarea>
                    </div>

                    <div class="ml-auto">
                        <button type="submit" class="btn btn-sm" style="background-color: #85f1fe; color: #000000;">Update</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</section>

<?= view("components/cart_notification") ?>


<?= $this->endSection(); ?>