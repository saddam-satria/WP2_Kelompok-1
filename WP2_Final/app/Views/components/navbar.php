<div class="py-1" style="background-color: #4663be;">
    <div class="container">
        <div class="d-flex align-items-center">
            <div class="d-flex align-items-center">
                <img style="width: 80px; height: 80px; object-fit: contain;" src="<?= base_url("android-chrome-192x192.png") ?>" alt="Logo WAR Laundry">
                <i id="button-bars" class="fa-solid fa-bars-staggered text-white ms-3" style="font-size: 1.5em; cursor: pointer;"></i>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <img style="width: 60px; height: 60px; object-fit: cover; cursor: pointer;" class="img-fluid rounded-circle" src="<?= base_url("assets/img/avatar.jpg") ?>" alt="asdsa" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false"></img>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-md-start">
                        <div style="width: 18rem;">
                            <div class="card-body">
                                <div class="d-flex align-items-center flex-column">
                                    <img style="width: 100px; height: 100px; object-fit: cover;" class="img-fluid rounded-circle" src="<?= base_url("assets/img/avatar.jpg") ?>" alt="asdsa" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false"></img>
                                    <h5 class="mt-3" style="color: #4663be;"><?= session()->current_user[0]["firstname"] . " " . session()->current_user[0]["lastname"] ?></h5>
                                    <span style="color: #21aee4;"><?= session()->current_user[0]["email"] ?></span>
                                </div>
                            </div>
                            <div class="card-footer" style="background-color: #4663be;">
                                <div class="d-flex">
                                    <a href="#" class="btn btn-sm" style="background-color: #85f1fe;">profile</a>
                                    <div class="ms-auto">
                                        <form action="<?= base_url("auth/logout") ?>" method="POST">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-sm" style="background-color: #85f1fe;">logout</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div style="height: 100vh; position: fixed;background-color: #4663be; padding-right: 6rem !important; transition: all ease-in-out 300ms 10ms;" class="px-2" id="user-sidebar">
    <div class="d-flex flex-column justify-content-between py-5 px-4" style="height: 30%;">
        <a href="#" class="text-decoration-none text-white text-capitalize">dashboard</a>
        <a href="#" class="text-decoration-none text-white text-capitalize">cucian anda</a>
        <a href="#" class="text-decoration-none text-white text-capitalize">riwayat cucian</a>
        <a href="#" class="text-decoration-none text-white text-capitalize">laundry baru</a>
    </div>
</div>