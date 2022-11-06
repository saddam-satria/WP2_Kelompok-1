<?= $this->extend("layouts/user/dashboard"); ?>

<?= $this->section("content"); ?>

<?= view("components/alert", array("key" => "error")) ?>

<section class="py-3 px-5 mt-5" style="background-color: #4663be; border-radius: 10px;">
    <h5 class="text-white">Pembayaran</h5>
</section>


<section class="my-5">
    <div class="d-flex flex-column">
        <h5 class="text-capitalize" style="font-weight: 600;"><?= $order->token ?></h5>
        <span class="text-danger">hanya berlaku 1 x 24 jam</span>
    </div>
</section>

<section class="my-5">

    <div class="row">
        <div class="col-sm-12 col-md-8">
            <div class="card">
                <div class="card-header" style="background-color: #4663be;">
                    <h5 class="text-white">Panduan</h5>
                </div>
                <div class="card-body">
                    <ol class="text-capitalize">
                        <li>Bawa ID Pembayaran Ke tempat laundry terdekat</li>
                        <li>tunjukan ID pendaftaran ke admin </li>
                        <li>admin akan menimbang kembali</li>
                        <li>proses pembayaran melalui petugas</li>
                        <li>cucian anda akan langsung di proses</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>









<?= $this->endSection(); ?>