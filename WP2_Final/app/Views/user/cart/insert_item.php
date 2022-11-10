<?= $this->extend("layouts/user/dashboard"); ?>

<?= $this->section("content"); ?>

<?= view("components/alert", array("key" => "error")) ?>

<section class="py-3 px-5 mt-5" style="background-color: #4663be; border-radius: 10px;">
    <h5 class="text-white">Pilih Item</h5>
</section>


<section class="py-3 mt-5">

    <div>
        <div class="row">
            <div class="col-sm-12 col-md-8">
                <form action="<?= base_url("user/add-item-to-cart?cart_id=" . $cart_id) ?>" method="POST">
                    <div class="d-flex flex-column">

                        <div class="mb-3">
                            <label for="service" class="form-label">Service yang anda pilih</label>
                            <input name="service" type="text" class="form-control" id="service" readonly value="<?= $cart->serviceName ?>">
                        </div>

                        <div class="mb-3">
                            <label for="package" class="form-label">Package yang anda pilih</label>
                            <input name="package" type="text" class="form-control" id="package" readonly value="<?= $cart->packageName ?>">
                        </div>

                        <div class="mb-3">
                            <label for="clothes" class="form-label">Pilih Jenis Pakaian</label>
                            <input name="clothes" type="text" class="form-control" id="clothes" readonly>
                            <?php if (!is_null(session()->getFlashdata("validation")) && session()->getFlashdata("validation")["clothes"]) : ?>
                                <?= view("components/errorMessage", array("message" => session()->getFlashdata("validation")["clothes"])); ?>
                            <?php endif; ?>
                            <button type="button" data-toggle="modal" data-target="#modalClothes" class="btn btn-sm btn-primary my-2">pilih</button>
                        </div>
                        <!-- Modal Clothes -->
                        <div class="modal fade" id="modalClothes" tabindex="-1" role="dialog" aria-labelledby="modalClothesTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color: #4663be;">
                                        <h5 class="modal-title text-white" id="exampleModalLongTitle">Pilih Jenis Pakaian</h5>
                                    </div>
                                    <div class="modal-body">
                                        <?php foreach ($items as $item) : ?>
                                            <div class="d-flex flex-column my-3">
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <img style="width: 80px; height: 80px; object-fit: contain;" src="<?= is_null($item->itemLogo) ? base_url("assets/img/tshirt.png"): base_url("assets/img/" . $item->itemLogo)?>" alt="<?= $item->itemName?>">
                                                    <div class="d-flex flex-column">
                                                        <h6 class="clothes-list"><?= $item->itemName ?></h6>
                                                        <span><?= $item->quantityPerKG ?> pcs / kg</span>
                                                    </div>
                                                    <div>
                                                        <button type="button" class="btn btn-sm mx-2" style="background-color: #85f1fe; color: #000;" id="clothes-btn">Pilih</button>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="quantity" class="form-label">Jumlah</label>
                            <input name="quantity" type="text" class="form-control" id="quantity" placeholder="0">
                            <?php if (!is_null(session()->getFlashdata("validation")) && session()->getFlashdata("validation")["quantity"]) : ?>
                                <?= view("components/errorMessage", array("message" => session()->getFlashdata("validation")["quantity"])); ?>
                            <?php endif; ?>
                        </div>


                        <div class="mb-3">
                            <label for="description" class="form-label">Keterangan</label>
                            <textarea name="description" rows="4" id="description" class="form-control" style="resize: none;"></textarea>
                            <?php if (!is_null(session()->getFlashdata("validation")) && session()->getFlashdata("validation")["description"]) : ?>
                                <?= view("components/errorMessage", array("message" => session()->getFlashdata("validation")["description"])); ?>
                            <?php endif; ?>
                        </div>




                        <div class="ml-auto">
                            <button type="submit" class="btn btn-sm" style="background-color: #85f1fe; color: #000000;">Tambah</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?= view("components/cart_notification") ?>


<?= $this->endSection(); ?>