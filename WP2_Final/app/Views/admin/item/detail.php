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

                    <div class="d-flex justify-content-center my-3">
                        <img style="width: 80px; height: 80px; object-fit: contain;" src="<?= is_null($item->itemLogo) ? base_url("assets/img/tshirt.png"): base_url("assets/img/" . $item->itemLogo)?>" class="img-fluid circle" alt="">
                    </div>
                    
                    <div class="mb-3">
                        <label for="itemName" class="form-label">Jenis Pakaian</label>
                        <input disabled value="<?= $item->itemName ?>" type="text" class="form-control" id="itemName" readonly >
                    </div>

                    <div class="mb-3">
                        <label for="itemPrice" class="form-label">Harga Per KG</label>
                        <input disabled value="<?= $item->itemPrice ?>" type="text" class="form-control" id="itemPrice" readonly >
                    </div>
                    
                    <div class="mb-3">
                        <label for="quantityPerKG" class="form-label">Estimasi KG</label>
                        <input disabled value="<?= $item->quantityPerKG ?> pcs" type="text" class="form-control" id="quantityPerKG" readonly >
                    </div>
                  
                </div>
            </form>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>