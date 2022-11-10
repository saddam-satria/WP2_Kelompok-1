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
            <form action="<?= base_url("admin/item-edit/" .$item->itemID)?>" method="POST" enctype="multipart/form-data">
                <div class="d-flex flex-column">

                    <div class="d-flex justify-content-center my-3">
                        <img style="width: 80px; height: 80px; object-fit: contain;" src="<?= is_null($item->itemLogo) ? base_url("assets/img/tshirt.png"): base_url("assets/img/" . $item->itemLogo)?>" class="img-fluid circle" alt="">
                    </div>


                    <div class="form-group mb-3">
                        <label for="itemLogo">Pakaian Thumbnail</label>
                        <input name="itemLogo" type="file" class="form-control-file" id="itemLogo">
                        <?php if (isset($validation) && $validation->getError("itemLogo")) : ?>
                            <?= view("components/errorMessage", array("message" => $validation->getError("itemLogo"))); ?>
                        <?php endif; ?>
                    </div>
                    
                    <div class="mb-3">
                        <label for="itemName" class="form-label">Jenis Pakaian</label>
                        <input name="itemName" value="<?= $item->itemName ?>" type="text" class="form-control" id="itemName" >
                        <?php if (isset($validation) && $validation->getError("itemName")) : ?>
                            <?= view("components/errorMessage", array("message" => $validation->getError("itemName"))); ?>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="itemPrice" class="form-label">Harga Per KG</label>
                        <input name="itemPrice" value="<?= $item->itemPrice ?>" type="text" class="form-control" id="itemPrice" >
                        <?php if (isset($validation) && $validation->getError("itemPrice")) : ?>
                            <?= view("components/errorMessage", array("message" => $validation->getError("itemPrice"))); ?>
                        <?php endif; ?>
                    </div>
                    
                    <div class="mb-3">
                        <label for="quantityPerKG" class="form-label">Estimasi KG</label>
                        <input name="quantityPerKG" value="<?= $item->quantityPerKG ?>" type="text" class="form-control" id="quantityPerKG" >
                        <?php if (isset($validation) && $validation->getError("quantityPerKG")) : ?>
                            <?= view("components/errorMessage", array("message" => $validation->getError("quantityPerKG"))); ?>
                        <?php endif; ?>
                    </div>
                  


                    <div class="ml-auto">
                        <button type="submit" class="btn btn-sm" style="background-color: #85f1fe; color: #000000;">Update</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>