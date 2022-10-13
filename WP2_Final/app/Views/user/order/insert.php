<?= $this->extend("layouts/user/dashboard"); ?>

<?= $this->section("content"); ?>

<?= view("components/alert", array("key" => "error")) ?>
<section class="py-3 px-5 mt-5" style="background-color: #4663be; border-radius: 10px;">
    <h5 class="text-white">Cucian Baru</h5>
</section>

<section class="py-3 mt-4">
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <form method="POST" action="#">
                <div class="d-flex flex-column">
                    <div class="mb-3">
                        <label for="service_name" class="form-label">Jenis Layanan</label>
                        <input value="<?= $default_service; ?>" type="text" class="form-control" name="service_name" id="service_name" disabled data-toggle="modal" data-target="#modalService">
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
                        <label for="clothes" class="form-label">Pilih Jenis Pakaian</label>
                        <input name="clothes" type="text" class="form-control" id="clothes" disabled>
                        <button type="button" data-toggle="modal" data-target="#modalClothes" class="btn btn-sm btn-primary my-2">pilih</button>
                    </div>
                    <!-- Modal Clothes -->
                    <div class="modal fade" id="modalClothes" tabindex="-1" role="dialog" aria-labelledby="modalClothesTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    ...
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="mb-3">
                        <label for="quantity" class="form-label">Jumlah</label>
                        <input name="quantity" type="text" class="form-control" id="quantity" placeholder="0">
                    </div>

                    <div class="mb-3">
                        <label for="package" class="form-label">Pilih Paket</label>
                        <input name="package" type="text" class="form-control" id="package" disabled>
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
                                            <span style="cursor: pointer;" class="text-capitalize mb-3 package-list"><?= $package ?></span>
                                        <?php endforeach ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="mb-3">
                        <label for="address" class="form-label">Keterangan</label>
                        <textarea name="address" rows="4" id="address" class="form-control" style="resize: none;"></textarea>
                    </div>
                    <div class="ml-auto">
                        <button type="submit" class="btn btn-sm" style="background-color: #85f1fe; color: #000000;">Tambah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>




<?= $this->endSection(); ?>