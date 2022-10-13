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
                        <input type="text" class="form-control" name="service_name" id="service_name">
                    </div>
                    <div class="mb-3">
                        <label for="clothes" class="form-label">Pilih Jenis Pakaian</label>
                        <input name="clothes" type="text" class="form-control" id="clothes">
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Jumlah</label>
                        <input name="quantity" type="text" class="form-control" id="quantity">
                    </div>
                    <div class="mb-3">
                        <label for="package" class="form-label">Pilih Paket</label>
                        <input name="package" type="text" class="form-control" id="package">
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