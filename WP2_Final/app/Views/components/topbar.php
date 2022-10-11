<nav class="navbar navbar-expand navbar-light bg-primary topbar mb-4 static-top shadow">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15 ml-1">
            <img src="<?= base_url("android-chrome-192x192.png") ?>" alt="logo koperasi" width="60">
        </div>
        <div class="sidebar-brand-text"></div>
        <button id="sidebarToggleTop" class="btn rounded-circle">
            <i class="fa fa-bars text-white"></i>
        </button>
    </a>

    <div class="container">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="img-profile rounded-circle" src="<?= is_null(session()->current_user[0]["image"]) ? base_url("assets/img/avatar.jpg")  : base_url("assets/" . session()->current_user[0]["image"])  ?>" alt="avatar">
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <div style="width: 16rem;">
                        <div class="py-3 text-center">
                            <img class="img-profile rounded-circle" src="<?= is_null(session()->current_user[0]["image"]) ? base_url("assets/img/avatar.jpg")  : base_url("assets/" . session()->current_user[0]["image"])  ?>" alt="avatar" style="width: 120px; height: 120px; object-fit: cover;">
                            <div class="py-3">
                                <h5 class="mt-3" style="color: #4663be;"><?= session()->current_user[0]["firstname"] . " " . session()->current_user[0]["lastname"] ?></h5>
                                <span style="color: #21aee4;"><?= session()->current_user[0]["email"] ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="p-2 d-flex justify-content-between" style="background-color: #4663be;">
                        <a href="<?= base_url("user/profile") ?>" class="btn btn-sm" style="background-color: #85f1fe;">profile</a>
                        <form action="<?= base_url("auth/logout") ?>" method="POST">
                            <?= csrf_field() ?>
                            <button type="submit" class="btn btn-sm" style="background-color: #85f1fe;">logout</button>
                        </form>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>