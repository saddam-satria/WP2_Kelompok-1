<?= $this->extend("layouts/user/dashboard"); ?>

<?= $this->section("content"); ?>

<?= view("components/alert", array("key" => "error")) ?>


<?php if (count($histories) > 0) : ?>

    <section class="py-3 px-5 mt-5" style="background-color: #4663be; border-radius: 10px;">
        <h5 class="text-white">Riwayat Cucian Anda</h5>
    </section>

    <section class="py-3 mt-5">
        <table class="table text-center table-striped">
            <thead>
                <tr>
                    <th scope="col">ID Pesanan</th>
                    <th scope="col">Berat</th>
                    <th scope="col">Pembayaran</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($histories as $history) : ?>
                    <tr>
                        <th scope="row"><?= $history->token ?></th>
                        <td><?= $history->totalItem ?> kg</td>
                        <td><?= is_null($history->paymentMethod) ? "-" : $history->paymentMethod ?></td>
                        <td><?= $history->created_at ?></td>
                        <td>
                            <a href="<?= base_url("/user/order/" . $history->id) ?>" class="btn btn-md mx-2" style="background-color: #85f1fe; color: #000;">Rincian</a>
                        </td>
                    </tr>
                <?php endforeach ?>

            </tbody>
        </table>

        <?php if ((int)$totalData > 0) : ?>
            <div class="d-flex justify-content-end py-3">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <?php for ($i = 1; $i <= $totalData; $i++) : ?>
                            <li class="page-item"><a class="page-link" href="<?= base_url("user/histories?page=" . $i) ?>"><?= $i ?></a></li>
                        <?php endfor ?>
                    </ul>
                </nav>
            </div>

        <?php endif ?>
    </section>


<?php else : ?>

    <?= view("components/empty_data", array("message" => "riwayat cucian anda masih kosong")) ?>

<?php endif ?>


<?= view("components/cart_notification") ?>



<?= $this->endSection(); ?>