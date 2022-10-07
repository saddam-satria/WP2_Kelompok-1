<?= $this->extend("layouts/main"); ?>
<?= $this->section("content"); ?>

<div style="height: 90vh;">
    <?php if (session()->getFlashdata("failure")) : ?>
        <div class="alert alert-danger text-lowercase" role="alert" id="login-failure">
            <?= session()->getFlashdata("failure") ?>
        </div>
    <?php endif; ?>
    <div class="card">
        <div class="card-header px-5 py-2" style="background-color: #8dbafe; color: #535353;">
            <h4 class="mt-2">Registrasi</h4>
        </div>
        <div class="card-body px-4" style="background-color: #4663be;">
            <div class="row">
                <div class="col-sm-12 col-md-6 mb-3" id="form-login">
                    <div class="d-flex align-items-center" style="height: 100%;">
                        <form style="flex: 1;" method="POST" action="<?= base_url("auth/signup") ?>">
                            <?= csrf_field() ?>
                            <div class="px-4">
                                <div class="mb-3">
                                    <input name="email" type="text" class="form-control py-2 px-3" placeholder="email anda" style="border-radius: 8px; background-color: #85f1fe;">
                                </div>
                                <div class="mb-3">
                                    <input name="firstname" type="text" class="form-control py-2 px-3" placeholder="firstname" style="border-radius: 8px; background-color: #85f1fe;">
                                </div>
                                <div class="mb-3">
                                    <input name="lastname" type="text" class="form-control py-2 px-3" placeholder="lastname" style="border-radius: 8px; background-color: #85f1fe;">
                                </div>
                                <div class="mb-3 mt-3">
                                    <input name="password" type="password" class="form-control py-2 px-3" placeholder="password" style="border-radius: 8px; background-color: #85f1fe;">
                                </div>
                                <h6 style="color: #fff;">sudah punya akun? <a href="<?= base_url("auth/login") ?>" class="text-decoration-none" style="color: #fff; font-weight: 700;">login</a></h6>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-md text-capitalize px-4 mt-2" style="background-color: #85f1fe;">daftar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class=" col-sm-12 col-md-6" id="form-login-image">
                    <div class="py-5">
                        <img src="<?= base_url("assets/img/undraw_secure_login_pdn4.png") ?>" alt="" style="object-fit: cover; width: 100%; height: 100%;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>