<?= $this->extend("layouts/user/dashboard"); ?>

<?= $this->section("content"); ?>

<?= view("components/alert", array("key" => "error")) ?>

<section class="py-3 px-5 mt-5" style="background-color: #4663be; border-radius: 10px;">
    <h5 class="text-white">Keranjang</h5>
</section>

<section class="py-3 mt-4">
    <div class="row">
        <div class="col-sm-12 col-md-2">
            <img src="<?= base_url("assets/img/tshirt.png") ?>" alt="">
        </div>

        <div class="col-sm-12 col-md-2">
            <div class="d-flex flex-column align-items-center">
                <h5>Baju Kaos</h5>
                <span>2 kg / pcs</sp>
            </div>
        </div>

        <div class="col-sm-12 col-md-2">
            <div class="d-flex flex-column align-items-center">
                <h5>Jumlah</h5>
                <div class="d-flex align-items-center">
                    <button class="btn btn-sm btn-primary">-</button>
                    <span class="mx-3">10</span>
                    <button class="btn btn-sm btn-primary">+</button>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-2">
            <div class="d-flex flex-column align-items-center">
                <h5>Estimasi KG</h5>
                <span>2 kg</sp>
            </div>
        </div>

        <div class="col-sm-12 col-md-2">
            <div class="d-flex flex-column align-items-center">
                <h5>Harga</h5>
                <span>Rp 10.000</sp>
            </div>
        </div>

        <div class="col-sm-12 col-md-2">
            <div class="d-flex align-items-center" style="height: 100%;">
                <form action="#">
                    <button type="submit" class="btn btn-sm">
                        <i class="fas fa-trash" style="font-size: 1.5em;"></i>
                    </button>
                </form>
            </div>
        </div>

    </div>
</section>




<?= $this->endSection(); ?>