<?= $this->extend("layouts/user/dashboard"); ?>

<?= $this->section("content"); ?>

<?= view("components/alert", array("key" => "error")) ?>

<div class="container">
    <div class="d-flex flex-column align-items-center py-5 mt-5">
        <img src="<?= base_url("assets/img/undraw_note_list_re_r4u9.svg") ?>" alt="not found" style="width: 260px; height: 260px;object-fit: contain;">
        <h6 class="text-capitalize" style="color: #535353;"><?= $id ?></h6>
    </div>

    <section class="py-3">
        <h5 style="color: #535353;" class="text-center">Cucian Anda Saat Ini</h5>
        <div class="d-flex flex-column">
            <div class="d-flex align-items-center text-white my-3" style="border-radius: 20px; background-color: #21aee4; flex:0.99">
                <div class="py-2 text-center" style="width: 50%; border-radius: 20px; background-color: #8dbafe;">
                    50%
                </div>
                <span class="ml-4">Progress</span>
            </div>
            <div class="mt-2 text-center">
                <a href="#" class="btn btn-md mx-2" style="background-color: #85f1fe; color: #000;">Rincian</a>
            </div>
        </div>
    </section>

</div>

<?= $this->endSection(); ?>