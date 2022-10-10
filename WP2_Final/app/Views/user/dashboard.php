<?= $this->extend("layouts/user/dashboard"); ?>


<?= $this->section("content"); ?>


<section class="p-5" style="background-color: #4663be; border-radius: 20px;">
    <div class="row">
        <div class="col-sm-12 col-md-6 " id="dashboard-header">
            <div class="d-flex flex-column justify-content-center" style="height: 100%;">
                <h5 class="text-white text-bold">Selamat Datang</h5>
                <h6 class="text-white text-capitalize"><?= session()->current_user[0]["firstname"] . " " . session()->current_user[0]["lastname"] ?></h6>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 mb-3" id="dashboard-header-image">
            <div class="d-flex justify-content-center">
                <img src="<?= base_url("assets/img/undraw_android_jr64.png") ?>" alt="" style="width: 50%; height: 50%; object-fit: contain;">
            </div>
        </div>
    </div>
</section>

<section class="my-5">
    <h5 style="font-size: 1.2em; color: #535353;">Cucian Anda Saat Ini</h5>
    <div class="my-2 d-flex">
        <div style="width: 100%;background-color: #21aee4; border-radius: 20px;" class="d-flex align-items-center">
            <div style="width: 50%;background-color: #8dbafe; border-radius: 20px; height: 100%;" class="p-2 text-white text-center"></div>
            <span class="ms-2 text-white">onprogress</span>
        </div>
        <div class="ms-2">
            <a href="#" class="btn btn-md" style="background-color: #85f1fe;">detail</a>
        </div>
    </div>
</section>

<section class="my-5 p-5" style="background-color: #4663be; border-radius: 20px;">
    <div class="row">
        <div class="col-sm-12 col-md-6 " id="dashboard-header">
            <div class="d-flex flex-column justify-content-center" style="height: 100%;">
                <h6 class="text-white text-bold text-capitalize">masukan kupon diskon yang anda miliki</h6>
                <form action="#">
                    <div class="d-flex align-items-center">
                        <input name="coupon" type="text" class="form-control px-3" placeholder="kupon diskon" style="border-radius: 8px; background-color: #85f1fe;">
                        <button type="submit" class="btn btn-md text-capitalize px-4 ms-1" style="background-color: #85f1fe;">pakai</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 mb-3" id="dashboard-header-image">
            <div class="d-flex justify-content-center">
                <img style="width: 120px; height: 120px; object-fit: contain;" src="<?= base_url("assets/img/gift.png") ?>" alt="">
            </div>
        </div>
    </div>
</section>


<section class="my-5">
    <div class="py-2 px-5" style="background-color: #4663be;border-radius: 10px;">
        <h5 style="font-size: 1.2em; color: #535353;" class="text-capitalize text-white">pilih layanan dibawah ini</h5>
    </div>
    <div class="my-4">
        <div class="row">
            <div class="col-sm-6 col-md-3">
                <a href="#" class="text-decoration-none">
                    <div class="card" style="height: 100%;">
                        <div class="card-body" style="height: 100%;">
                            <div class="d-flex align-items-center flex-column justify-content-center" style="height: 100%;">
                                <img src="<?= base_url("assets/img/nyuci.png") ?>" alt="service nyuci">
                                <h6 style="color: #4663be; font-weight: 600;">Nyuci</h6>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-md-3">
                <a href="#" class="text-decoration-none">
                    <div class="card" style="height: 100%;">
                        <div class="card-body" style="height: 100%;">
                            <div class="d-flex align-items-center flex-column justify-content-center" style="height: 100%;">
                                <img src="<?= base_url("assets/img/gosok.png") ?>" alt="service nyuci">
                                <h6 style="color: #4663be; font-weight: 600;">Gosok</h6>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-md-3">
                <a href="#" class="text-decoration-none">
                    <div class="card" style="height: 100%;">
                        <div class="card-body" style="height: 100%;">
                            <div class="d-flex align-items-center flex-column justify-content-center" style="height: 100%;">
                                <img src="<?= base_url("assets/img/allinone.png") ?>" alt="service nyuci">
                                <h6 style="color: #4663be; font-weight: 600;">All In One</h6>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-md-3">
                <a href="#" class="text-decoration-none">
                    <div class="card" style="height: 100%;">
                        <div class="card-body" style="height: 100%;">
                            <div class="d-flex align-items-center flex-column justify-content-center" style="height: 100%;">
                                <img src="<?= base_url("assets/img/sneakers.png") ?>" alt="service nyuci">
                                <h6 style="color: #4663be; font-weight: 600;">Sneakers</h6>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>


<?= $this->endSection(); ?>