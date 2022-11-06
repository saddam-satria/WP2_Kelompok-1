<?php

$notificationRepository = new App\Repositories\NotificationRepository();
$currentUser = session()->current_user[0];
$notifications = $notificationRepository->getNotificationByAccount($currentUser->email, array("message", "created_at", "isRead", "notificationId"));
$totalNotifications = count($notificationRepository->getNotificationByAccountWhereNotRead($currentUser->email, array('message')));


?>


<nav class="navbar navbar-expand navbar-light bg-primary topbar mb-4 static-top shadow">
    <a class="sidebar-brand d-flex align-items-center justify-content-center">
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

            <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bell fa-fw"></i>
                    <!-- Counter - Alerts -->
                    <span class="badge badge-danger badge-counter"><?= $totalNotifications ?></span>
                </a>
                <!-- Dropdown - Alerts -->
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                    <div class="card">
                        <div class="card-header text-white" style="background-color: #4663be;">
                            <h5>Notifikasi</h5>
                        </div>
                        <div class="card-body" style="overflow-y: auto; height: 20vh;">
                            <?php if (count($notifications) > 0) : ?>
                                <?php foreach ($notifications as $notification) : ?>
                                    <div class="d-flex justify-content-between mb-3">
                                        <a href="<?= base_url("/user/notification/" . $notification->notificationId) ?>" class="text-decoration-none text-dark" style="font-weight: <?= $notification->isRead ? "500" : "600" ?>;">
                                            <span><?= substr($notification->message, 0, 15) ?> ...</span>
                                        </a>
                                        <span style="font-weight: <?= $notification->isRead ? "500" : "600" ?>;"><?= date_format(date_create($notification->created_at), "Y-m-d") ?></span>
                                    </div>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <div class="d-flex justify-content-center align-items-center mb-3" style="height: 100%;">
                                    <h6>Notifikasi Kosong</h6>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </li>

            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="img-profile rounded-circle" src="<?= is_null(session()->current_user[0]->image) ? base_url("assets/img/avatar.jpg")  : session()->current_user[0]->image ?>" alt="avatar">
                </a>
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <div class="card">
                        <div class="card-body">
                            <div class="py-3 text-center">
                                <img class="img-profile rounded-circle" src="<?= is_null(session()->current_user[0]->image) ? base_url("assets/img/avatar.jpg")  : session()->current_user[0]->image  ?>" alt="avatar" style="width: 120px; height: 120px; object-fit: cover;">
                                <div class="py-3">
                                    <h5 class="mt-3" style="color: #4663be;"><?= session()->current_user[0]->firstname . " " . session()->current_user[0]->lastname ?></h5>
                                    <span style="color: #21aee4;"><?= session()->current_user[0]->email ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer" style="background-color: #4663be;">
                            <div class="d-flex justify-content-between">
                                <a href="<?= base_url("user/profile") ?>" class="btn btn-sm" style="background-color: #85f1fe;">profile</a>
                                <form action="<?= base_url("auth/logout") ?>" method="POST">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="btn btn-sm" style="background-color: #85f1fe;">logout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>