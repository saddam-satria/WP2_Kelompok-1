<?= $this->extend("layouts/user/dashboard"); ?>

<?= $this->section("content"); ?>

<?= view("components/alert", array("key" => "error")) ?>

<section class="py-3 mt-5">
    <div class="d-flex mb-2">
        <span style="color: #535353;">Service Name</span>
        <div class="ml-auto">
            <span style="color: #535353;">20 kg</span>
        </div>
    </div>
    <div class="d-flex">
        <div class="d-flex align-items-center text-white" style="border-radius: 20px; background-color: #21aee4; flex:0.99">
            <div class="py-2 text-center" style="width: 50%; border-radius: 20px; background-color: #8dbafe;">
                50%
            </div>
            <span class="ml-4">Progress</span>
        </div>
        <a href="#" class="btn btn-md mx-2" style="background-color: #85f1fe; color: #000;">Detail</a>
    </div>
</section>

<?= $this->endSection(); ?>