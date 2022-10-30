<?= $this->extend("layouts/user/dashboard"); ?>

<?= $this->section("content"); ?>

<?= view("components/alert", array("key" => "error")) ?>

<section class="py-3 px-5 mt-5" style="background-color: #4663be; border-radius: 10px;">
    <h5 class="text-white">Pilih Item</h5>
</section>


<section class="py-3 px-5 mt-5">
    <div class="d-flex">
        <span>Service Anda: <?= $cart->serviceName ?></span>
        <div class="ml-auto">
            <span>Paket Anda: <?= $cart->packageName ?></span>
        </div>
    </div>

    <div class="my-5">
        <?php if (count($items) > 0) : ?>
            <div class="row">
                <?php foreach ($items as $item) : ?>
                    <div class="col-sm-12 col-md-4 mb-3">
                        <div class="card" style="height: 100%;">
                            <div class="card-header">
                                <div class="d-flex justify-content-center">
                                    <img src="<?= base_url("assets/img/tshirt.png") ?>" alt="">
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex flex-column">
                                    <h5 style="font-weight: 600;"><?= $item->itemName ?></h5>
                                    <span><?= $item->quantityPerKG ?> pcs/kg</span>
                                </div>
                            </div>
                            <div class="card-footer">
                                <form action="#" method="POST">
                                    <?= csrf_field() ?>

                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-md btn-primary">
                                            pilih
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>

            </div>
        <?php else : ?>
            <?= view("components/empty_data", array("message" => "item masih kosong")) ?>
        <?php endif; ?>
    </div>
</section>



<?= $this->endSection(); ?>