<?= $this->extend("layouts/user/dashboard"); ?>

<?= $this->section("content"); ?>

<?php if (session()->getFlashdata("success")) : ?>
    <?= view("components/alert", array("key" => "success", "alert" => "success")) ?>
<?php else : ?>
    <?= view("components/alert", array("key" => "error")) ?>
<?php endif; ?>



<section class="py-3 px-5 mt-5" style="background-color: #4663be; border-radius: 10px;">
    <h5 class="text-white">Cucian Baru</h5>
</section>

<section class="py-3 mt-4">
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <form method="POST" action="<?= base_url("user/add-to-cart") ?>" method="POST">
                <div class="d-flex flex-column">

                    <div class="mb-3">
                        <label for="service_name" class="form-label">Jenis Layanan</label>
                        <input value="<?= $default_service; ?>" type="text" class="form-control" name="service_name" id="service_name" readonly data-toggle="modal" data-target="#modalService">
                        <?php if (!is_null(session()->getFlashdata("validation")) && session()->getFlashdata("validation")["service_name"]) : ?>
                            <?= view("components/errorMessage", array("message" => session()->getFlashdata("validation")["service_name"])); ?>
                        <?php endif; ?>
                        <button type="button" data-toggle="modal" data-target="#modalService" class="btn btn-sm btn-primary my-2">pilih</button>
                    </div>

                    <!-- Modal Service -->
                    <div class="modal fade" id="modalService" tabindex="-1" role="dialog" aria-labelledby="modalServiceTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color: #4663be;">
                                    <h5 class="modal-title text-white" id="exampleModalLongTitle">Pilih Jenis Service</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="d-flex flex-column my-3">
                                        <?php foreach ($services as $service) : ?>
                                            <span style="cursor: pointer;" class="text-capitalize mb-3 service-list"><?= $service ?></span>
                                        <?php endforeach ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="mb-3">
                        <label for="package" class="form-label">Pilih Paket</label>
                        <input name="package" type="text" class="form-control" id="package" readonly>
                        <?php if (!is_null(session()->getFlashdata("validation")) && session()->getFlashdata("validation")["package"]) : ?>
                            <?= view("components/errorMessage", array("message" => session()->getFlashdata("validation")["package"])); ?>
                        <?php endif; ?>
                        <button type="button" data-toggle="modal" data-target="#modalPackage" class="btn btn-sm btn-primary my-2">pilih</button>
                    </div>
                    <!-- Modal Package -->
                    <div class="modal fade" id="modalPackage" tabindex="-1" role="dialog" aria-labelledby="modalPackageTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color: #4663be;">
                                    <h5 class="modal-title text-white" id="exampleModalLongTitle">Pilih Jenis Package</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="d-flex flex-column my-3">
                                        <?php foreach ($packages as $package) : ?>
                                            <span style="cursor: pointer;" class="text-capitalize mb-3 package-list"><?= $package->packageName ?></span>
                                        <?php endforeach ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="ml-auto">
                        <button type="submit" class="btn btn-sm" style="background-color: #85f1fe; color: #000000;">Tambah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<?= view("components/cart_notification") ?>


<?= $this->endSection(); ?>