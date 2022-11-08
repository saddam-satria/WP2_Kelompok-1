<?= $this->extend("layouts/user/dashboard"); ?>


<?= $this->section("content"); ?>

<div class="my-5">

    <?php if (session()->getFlashdata("success")) : ?>
        <?= view("components/alert", array("key" => "success", "alert" => "success")) ?>
    <?php else : ?>
        <?= view("components/alert", array("key" => "error")) ?>
    <?php endif; ?>

    <?php if (!session()->current_user[0]->isAdmin) : ?>
        <section class="py-4 px-5" style="background-color: #4663be; border-radius: 20px;">
            <div class="row">
                <div class="col-sm-12 col-md-6 rotate-2">
                    <div class="d-flex flex-column justify-content-center" style="height: 100%;">
                        <h6 class="text-white mb-3" style="font-weight: 600;">Selamat Datang</h6>
                        <span class="text-white text-capitalize"><?= session()->current_user[0]->firstname .  ' ' . session()->current_user[0]->lastname  ?></span>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 rotate-1">
                    <div class="d-flex justify-content-center">
                        <img src="<?= base_url("assets/img/undraw_android_jr64.png") ?>" alt="Theme Background" style="width: 160px; height: 160px; object-fit: contain;">
                    </div>
                </div>
            </div>
        </section>

        <?php if (!is_null($order)) : ?>
            <section class="py-3 mt-5">
                <h5 style="color: #535353;">Cucian Anda Saat Ini</h5>
                <div class="d-flex">
                    <div class="d-flex align-items-center text-white" style="border-radius: 20px; background-color: #21aee4; flex:0.99">
                        <div class="py-2 text-center" style="width:<?= str_contains(strtolower($order->status), "diterima") ? "25%" : str_contains(strtolower($order->status), ("sedang dicuci" ? "50%" : str_contains(strtolower($order->status), "sudah selesai")) ? "75%" : "100%") ?>; border-radius: 20px; background-color: #8dbafe;">
                            <?= str_contains(strtolower($order->status), "diterima") ? "25%" : str_contains(strtolower($order->status), ("sedang dicuci" ? "50%" : str_contains(strtolower($order->status), "sudah selesai")) ? "75%" : "100%") ?>
                        </div>
                        <span class="ml-4"><?= $order->status ?></span>
                    </div>
                    <a href="<?= base_url("/user/order/" . $order->id) ?>" class="btn btn-md mx-2" style="background-color: #85f1fe; color: #000;">Detail</a>
                </div>
            </section>
        <?php endif ?>

        <section class="py-4 px-5 mt-5" style="background-color: #4663be; border-radius: 20px;">
            <div class="row">
                <div class="col-sm-12 col-md-6 rotate-2">
                    <div class="d-flex flex-column justify-content-center" style="height: 100%;">
                        <h6 class="text-white mb-3 py-2 text-capitalize">penukaran kupon diskon</h6>
                        <form action="<?= base_url("/user/claim-voucher") ?>" method="POST">
                            <div class="d-flex">
                                <?= csrf_field() ?>
                                <input type="text" class="form-control" placeholder="kupon diskon" name="voucher" style="color: #000;">
                                <button type="submit" class="btn btn-md mx-2" style="background-color: #85f1fe; color: #000;">Pakai</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 rotate-1">
                    <div class="d-flex justify-content-center">
                        <img src="<?= base_url("assets/img/gift.png") ?>" alt="Theme Background" style="width: 120px; height: 120px; object-fit: contain;">
                    </div>
                </div>
            </div>
        </section>

        <section class="py-3 mt-5">
            <div class="px-4 py-3" style="background-color: #4663be; border-radius: 10px;">
                <h5 class="text-white">pilih layanan dibawah ini</h5>
            </div>
            <div class="my-4">
                <div class="row">
                    <?php foreach ($services as $service) : ?>
                        <div class="col-sm-12 col-md-3 mb-3">
                            <a href="<?= base_url("user/new-order?service=" . $service->serviceName) ?>" class="text-decoration-none">
                                <div class="card" style="width: 100%; height: 100%;">
                                    <div class="d-flex justify-content-center align-items-center flex-column py-3" style="height: 100%;">
                                        <img src="<?= base_url("assets/img/tshirt.png") ?>" alt="Theme Background" style="object-fit: contain;">
                                        <h6 class="py-2 text-capitalize" style="color: #4663be; font-weight: 600;"><?= $service->serviceName; ?></h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    <?php endif ?>

    <?php if(session()->current_user[0]->isAdmin):?>
            <!-- Content Row -->
            <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                   Total Masukan</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format($totalAmount,0,".",".")?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total Masukan (KG)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totalKg?> KG</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Jumlah Orderan
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $totalOrder?></div>
                                    </div>
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-info" role="progressbar"
                                                style="width: <?= $orderByPercent?>%" aria-valuenow="<?= $orderByPercent?>" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Pengguna</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totalAccount->total_account ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>

            <!-- Content Row -->

            <div class="row">
                <div class="col-sm-12 col-md-6">
                   <div class="card">
                        <div class="card-header bg-primary text-white">
                               <h6>User Terbaru</h6>
                        </div>
                       <div class="">
                           <?php if(count($accounts) > 0):?>
                        <table class="table table-striped">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th>Email</th>
                                        <th>Name</th>
                                        <th>Alamat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach($accounts as $account):?>
                                    <tr>
                                        <td><?= $account->email?></td>
                                        <td><?= $account->firstname . " " . $account->lastname?></td>
                                        <td><?= is_null($account->address) ? "-" : $account->address?></td>
                                    </tr>
                                    <?php endforeach?>
                                </tbody>
                            </table>
                            <?php else:?>
                                <div class="text-center py-2">
                                    <span>Data Kosong</span>
                                </div>
                            <?php endif?>
                       </div>
                   </div>
                </div>

                <div class="col-sm-12 col-md-6">
                   <div class="card">
                        <div class="card-header bg-primary text-white">
                               <h6>Orderan Terbaru</h6>
                        </div>
                        
                        <?php if(count($newestOrders) > 0):?>
                        <table class="table table-striped">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>Kode</th>
                                    <th>Total</th>
                                    <th>Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php foreach($newestOrders as $order):?>
                                        <tr>
                                            <td><?= $order->token?></td>
                                            <td><?= number_format($order->amount,0,".",".")?></td>
                                            <td><?= date_format(date_create($order->created_at), "d-m-Y H:i:s")?></td>
                                        </tr>
                                        <?php endforeach?>
                                    </tbody>
                                </table>
                                <?php else:?>
                                    <div class="text-center py-2">
                                        <span>Data Kosong</span>
                                    </div>
                                <?php endif?>
                    </div>
                </div>
            </div>

        <?php endif?>



</div>

<?= view("components/cart_notification") ?>


<?= $this->endSection(); ?>