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
                        <img style="width: 80px; height: 80px; object-fit: contain;" src="<?= is_null($service->serviceLogo) ? base_url("assets/img/tshirt.png"): base_url("assets/img/" . $service->serviceLogo)?>" class="img-fluid circle" alt="">
                    </div>
                    
                    <div class="mb-3">
                        <label for="serviceName" class="form-label">Jenis Servis</label>
                        <input disabled value="<?= $service->serviceName ?>" type="text" class="form-control" id="serviceName" readonly >
                    </div>

                    <div class="mb-3">
                        <label for="servicePrice" class="form-label">Harga Servis</label>
                        <input disabled value="<?= number_format($service->servicePrice,0,".",'.') ?>" type="text" class="form-control" id="servicePrice" readonly >
                    </div>
                  
                </div>
            </form>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>