<?= $this->extend("layouts/user/dashboard"); ?>

<?= $this->section("content"); ?>
<section class="py-3 px-5 mt-5" style="background-color: #4663be; border-radius: 10px;">
    <h5 class="text-white">Pembayaran</h5>
</section>


<section class="py-3 mt-4">

    <div>
        <div class="mb-3">
            <h5>Pakai Voucher</h5>
        </div>
        <div style="overflow: auto; white-space: nowrap">
            <?php foreach ($vouchers as $voucher) : ?>
                <div class="d-inline-block pr-2">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <span><?= $voucher->voucherCode ?></span>
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-column">
                                <span>Potongan</span>
                                <?php if ($voucher->isPercentage) : ?>
                                    <span><?= $voucher->discount ?> %</span>
                                <?php else : ?>
                                    <span>Rp. <?= number_format($voucher->discount) ?></span>
                                <?php endif ?>

                                <div class="py-2">
                                    <span>Masa Berlaku: <?= date_format(date_create($voucher->expire), "d-m-Y") ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent">
                            <form action="<?= base_url("/user/select-voucher?voucher=" . $voucher->voucherCode) ?>" method="POST">
                                <button class="btn btn-sm btn-primary" type="submit">Pakai</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>

        </div>
        <hr class="sidebar-divider d-md-block my-5">
        <div>
            <div class="row">
                <div class="col-sm-12 col-md-8">
                    <div class="mb-3">
                        <label for="name" class="form-label">Atas Nama</label>
                        <input value="<?= $currentUser->firstname . $currentUser->lastname ?>" type="text" class="form-control" name="name" id="name" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input value="<?= $currentUser->email ?>" type="email" class="form-control" name="email" id="email" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Alamat Lengkap</label>
                        <textarea name="address" rows="4" id="address" class="form-control" style="resize: none;" readonly><?= $currentUser->address ?></textarea>
                    </div>
                </div>
            </div>
        </div>
        <hr class="sidebar-divider d-md-block my-5">

        <div class="row">
            <div class="col-sm-12 col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex mb-3">
                            <span style="font-weight: 600;">Jumlah Pakaian</span>
                            <div class="ml-auto">
                                <span><?= $cartAsKG ?></span>
                            </div>
                        </div>

                        <div class="d-flex mb-3">
                            <span style="font-weight: 600;">Harga Service</span>
                            <div class="ml-auto">
                                <span><?= number_format($service) ?></span>
                            </div>
                        </div>

                        <div class="d-flex mb-3">
                            <span style="font-weight: 600;">Harga Paket</span>
                            <div class="ml-auto">
                                <span><?= number_format($package) ?></span>
                            </div>
                        </div>

                        <?php if (!is_null($voucherModel)) : ?>
                            <div class="d-flex mb-3">
                                <span style="font-weight: 600;">Voucher Yang Dipakai</span>
                                <div class="ml-auto">
                                    <span><?= count($voucherModel) > 0 ? $voucherModel[0]->voucherCode : "-" ?></span>
                                </div>
                            </div>

                            <div class="d-flex mb-3">
                                <span style="font-weight: 600;">Potongan Harga</span>
                                <div class="ml-auto">
                                    <?php if ($isPercentage) : ?>
                                        <span><?= $discount ?> %</span>
                                    <?php else : ?>
                                        <span>Rp. <?= number_format($discount) ?></span>
                                    <?php endif ?>

                                </div>
                            </div>
                        <?php endif; ?>

                        <hr class="sidebar-divider d-md-block">
                        <div class="d-flex mb-3">
                            <span style="font-weight: 600;">Total</span>
                            <div class="ml-auto">
                                <span><?= number_format($amount) ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class=" d-flex my-5 justify-content-end">
        <a href="<?= base_url("/user/cart") ?>" class="btn btn-md mx-2 btn-warning">kembali</a>
        <form action="<?= is_null($currentVoucher) ? base_url("/user/payment")  : base_url("/user/payment?voucher=" . $currentVoucher) ?>" method="POST">
            <button type="submit" class="btn btn-md mx-2" style="background-color: #85f1fe; color: #000;">Bayar</button>
        </form>
    </div>
</section>



<?= $this->endSection(); ?>