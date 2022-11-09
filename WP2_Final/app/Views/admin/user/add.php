<?= $this->extend("layouts/user/dashboard"); ?>

<?= $this->section("content"); ?>

<?php if (session()->getFlashdata("success")) : ?>
    <?= view("components/alert", array("key" => "success", "alert" => "success")) ?>
<?php else : ?>
    <?= view("components/alert", array("key" => "error")) ?>
<?php endif; ?>

<section>
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <div class="mb-4 py-2 px-3 bg-primary text-white rounded">
                <h6>Tambah Admin</h6>
            </div>
            <form action="<?= base_url("/admin/users/create")?>" method="POST">

                <div class="mb-3">
                    <input value="<?= set_value("email") ?>" name="email" type="text" class="form-control py-2 px-3" placeholder="email">
                    <?php if (isset($validation) && $validation->getError("email")) : ?>
                        <?= view("components/errorMessage", array("message" => $validation->getError("email"))); ?>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <input value="<?= set_value("firstname") ?>" name="firstname" type="text" class="form-control py-2 px-3" placeholder="firstname" >
                    <?php if (isset($validation) && $validation->getError("firstname")) : ?>
                        <?= view("components/errorMessage", array("message" => $validation->getError("firstname"))); ?>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <input value="<?= set_value("lastname") ?>" name="lastname" type="text" class="form-control py-2 px-3" placeholder="lastname" >
                    <?php if (isset($validation) && $validation->getError("lastname")) : ?>
                        <?= view("components/errorMessage", array("message" => $validation->getError("lastname"))); ?>
                    <?php endif; ?>
                </div>
                <div class="mb-3 mt-3">
                    <input name="password" type="password" class="form-control py-2 px-3" placeholder="password" >
                    <?php if (isset($validation) && $validation->getError("password")) : ?>
                        <?= view("components/errorMessage", array("message" => $validation->getError("password"))); ?>
                    <?php endif; ?>
                </div>

              <div class="d-flex">
                    <div class="ml-auto">
                        <button type="submit" class="btn btn-sm" style="background-color: #85f1fe; color: #000000;">Tambah</button>
                    </div>

              </div>

              
            </form>
        </div>
    </div>
</section>


<?= $this->endSection(); ?>