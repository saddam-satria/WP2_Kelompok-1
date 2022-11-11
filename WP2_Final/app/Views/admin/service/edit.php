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
            <form action="<?= base_url("admin/service-edit/" .$service->serviceID)?>" method="POST" enctype="multipart/form-data">
                <div class="d-flex flex-column">

                    <div class="d-flex justify-content-center my-3">
                        <img style="width: 80px; height: 80px; object-fit: contain;" src="<?= is_null($service->serviceLogo) ? base_url("assets/img/tshirt.png"): base_url("assets/img/" . $service->serviceLogo)?>" class="img-fluid circle" alt="">
                    </div>


                    <div class="form-group mb-3">
                        <label for="serviceLogo">Thumbnail Servis</label>
                        <input name="serviceLogo" type="file" class="form-control-file" id="serviceLogo">
                        <?php if (isset($validation) && $validation->getError("serviceLogo")) : ?>
                            <?= view("components/errorMessage", array("message" => $validation->getError("serviceLogo"))); ?>
                        <?php endif; ?>
                    </div>
                    
                    <div class="mb-3">
                        <label for="serviceName" class="form-label">Jenis Pakaian</label>
                        <input name="serviceName" value="<?= $service->serviceName ?>" type="text" class="form-control" id="serviceName" >
                        <?php if (isset($validation) && $validation->getError("serviceName")) : ?>
                            <?= view("components/errorMessage", array("message" => $validation->getError("serviceName"))); ?>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="servicePrice" class="form-label">Harga Servis</label>
                        <input name="servicePrice" value="<?= $service->servicePrice ?>" type="text" class="form-control" id="servicePrice" >
                        <?php if (isset($validation) && $validation->getError("servicePrice")) : ?>
                            <?= view("components/errorMessage", array("message" => $validation->getError("servicePrice"))); ?>
                        <?php endif; ?>
                    </div>


                    <div class="mb-3">
                        <input readonly value="<?= $service->serviceID?>" type="text" class="form-control d-none" name="serviceID" id="serviceID" >
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