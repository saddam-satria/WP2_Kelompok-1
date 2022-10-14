<?= $this->extend("layouts/user/dashboard"); ?>

<?= $this->section("content"); ?>

<?= view("components/alert", array("key" => "error")) ?>


<?php if (count($histories) > 0) : ?>

    <h5>Lorem, ipsum.</h5>

<?php else : ?>

    <?= view("components/empty_data", array("message" => "riwayat cucian anda masih kosong")) ?>

<?php endif ?>



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
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
                <td>
                    <a href="#" class="btn btn-md mx-2" style="background-color: #85f1fe; color: #000;">Rincian</a>
                </td>
            </tr>
        </tbody>
    </table>

    <?php if ((int)$totalData > 0) : ?>
        <div class="d-flex justify-content-end py-3">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <?php if ($currentPage > 1) : ?>
                        <li class="page-item"><a class="page-link" href="<?= base_url("user/histories?page=" . $currentPage - 1) ?>">Previous</a></li>
                    <?php endif ?>
                    <?php for ($i = 1; $i <= $totalData; $i++) : ?>
                        <li class="page-item"><a class="page-link" href="<?= base_url("user/histories?page=" . $i) ?>"><?= $i ?></a></li>
                    <?php endfor ?>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>
        </div>

    <?php endif ?>
</section>



<?= $this->endSection(); ?>