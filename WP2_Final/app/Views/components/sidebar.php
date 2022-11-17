<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="padding: 5rem 0px;">

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url("user/dashboard") ?>" style="background-color: <?= str_contains(uri_string(), "dashboard") ? "#21aee4" : "transparent" ?>;">
            <i class="fa-solid fa-gauge"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <?php if (!session()->current_user[0]->isAdmin) : ?>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url("user/orders") ?>" style="background-color: <?= str_contains(uri_string(), "orders") ? "#21aee4" : "transparent" ?>;">
                <i class="fa-solid fa-clock"></i>
                <span>Cucian Anda</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url("user/histories") ?>" style="background-color: <?= str_contains(uri_string(), "histories") ? "#21aee4" : "transparent" ?>;">
                <i class="fa-solid fa-calendar-day"></i>
                <span>Riwayat Cucian</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url("user/new-order") ?>" style="background-color: <?= str_contains(uri_string(), "new") ? "#21aee4" : "transparent" ?>;">
                <i class="fa-solid fa-circle-plus"></i>
                <span>Laundry Baru</span>
            </a>
        </li>
    <?php endif ?>
    <?php if (session()->current_user[0]->isAdmin) : ?>

        <li class="nav-item">
            <a class="nav-link" href="<?= base_url("admin/orders") ?>" style="background-color: <?= str_contains(uri_string(), "admin/orders") ? "#21aee4" : "transparent" ?>;">
                <i class="fa-solid fa-hand-holding-heart"></i>
                <span>Orderan Cucian</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <div class="sidebar-heading mb-3">
            Master Data
        </div>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo" style="background-color: <?= str_contains(uri_string(), "admin/users") ? "#21aee4" : "transparent" ?>;">
                <i class="fas fa-fw fa-users"></i>
                <span>Akun</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="<?= base_url("/admin/users/") ?>">Pengguna</a>
                    <a class="collapse-item" href="<?= base_url("/admin/users?is_admin=" . true) ?>">Admin</a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?= base_url("admin/packages") ?>" style="background-color: <?= str_contains(uri_string(), "admin/packages") ? "#21aee4" : "transparent" ?>;">
                <i class="fa-solid fa-cube"></i>
                <span>Paket Cucian</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?= base_url("admin/items") ?>" style="background-color: <?= str_contains(uri_string(), "admin/items") ? "#21aee4" : "transparent" ?>;">
                <i class="fa-solid fa-box-open"></i>
                <span>Jenis Pakaian</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?= base_url("admin/services") ?>" style="background-color: <?= str_contains(uri_string(), "admin/services") ? "#21aee4" : "transparent" ?>;">
                <i class="fa-solid fa-box"></i>
                <span>Jenis Cucian</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?= base_url("admin/vouchers") ?>" style="background-color: <?= str_contains(uri_string(), "admin/vouchers") ? "#21aee4" : "transparent" ?>;">
                <i class="fa-solid fa-box"></i>
                <span>Voucher</span>
            </a>
        </li>
    <?php endif ?>



    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>



</ul>