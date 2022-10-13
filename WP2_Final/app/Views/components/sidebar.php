<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="padding: 5rem 0px;">

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url("user/dashboard") ?>" style="background-color: <?= str_contains(uri_string(), "dashboard") ? "#21aee4" : "transparent" ?>;">
            <i class="fa-solid fa-gauge"></i>
            <span>Dashboard</span>
        </a>
    </li>
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





    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>



</ul>