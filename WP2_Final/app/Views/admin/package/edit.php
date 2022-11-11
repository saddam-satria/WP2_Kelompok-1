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
            <form action="<?= base_url("admin/package-edit/" . $package->packageID)?>" method="POST">

                <div class="mb-3">
                    <input readonly value="<?= $package->packageID?>" type="text" class="form-control d-none" name="packageID" id="packageID" >
                </div>

                <div class="mb-3">
                    <label for="packageName" class="form-label">Nama Paket</label>
                    <input value="<?= $package->packageName?>" type="text" class="form-control" name="packageName" id="packageName" >
                    <?php if (isset($validation) && $validation->getError("packageName")) : ?>
                        <?= view("components/errorMessage", array("message" => $validation->getError("packageName"))); ?>
                    <?php endif; ?>
                </div>


                <div class="mb-3">
                    <label for="packagePrice" class="form-label">Harga Paket</label>
                    <input value="<?= $package->packagePrice?>" type="text" class="form-control" name="packagePrice" id="packagePrice" >
                    <?php if (isset($validation) && $validation->getError("packagePrice")) : ?>
                        <?= view("components/errorMessage", array("message" => $validation->getError("packagePrice"))); ?>
                    <?php endif; ?>
                </div>

                <div class="d-flex">
                    <div class="ml-auto">
                        <button type="submit" class="btn btn-sm" style="background-color: #85f1fe; color: #000000;">Update</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</section>



<?= $this->endSection(); ?>