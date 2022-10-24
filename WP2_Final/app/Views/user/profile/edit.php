<?= $this->extend("layouts/user/dashboard"); ?>

<?= $this->section("content"); ?>

<?= view("components/alert", array("key" => "error")) ?>

<div class="row">
    <div class="col-sm-12 col-md-6">
        <form method="POST" action="<?= base_url("/user/profile") ?>">

            <?= csrf_field() ?>
            <div class="d-flex flex-column align-items-center mb-5">
                <img id="preview-avatar" style="width: 120px; height: 120px; object-fit: cover;" class="img-fluid rounded-circle" src="<?= is_null(session()->current_user[0]["image"]) ? base_url("assets/img/avatar.jpg")  : base_url("assets/" . session()->current_user[0]["image"])  ?>" alt="asdsa" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false"></img>
                <button type="button" class="btn btn-sm btn-primary mt-3" data-toggle="modal" data-target="#exampleModalCenter">
                    Pilih Avatar
                </button>
                <input name="avatar" type="text" id="avatar-selected" class="d-none" hidden>
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Pilih Avatar</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <?php foreach ($avatars as $key => $avatar) : ?>
                                        <div class="col-3 mb-3">
                                            <img style="width: 80px; height: 80px; object-fit: cover; cursor: pointer;" class="img-fluid rounded-circle avatars" src="<?= base_url($avatar) ?>"></img>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>





            <div class="d-flex flex-column">
                <div class="mb-3">
                    <label for="firstname" class="form-label">Firstname</label>
                    <input value="<?= session()->current_user[0]["firstname"] ?>" type="text" class="form-control" name="firstname" id="firstname">
                    <?php if (isset($validation) && $validation->getError("firstname")) : ?>
                        <?= view("components/errorMessage", array("message" => $validation->getError("firstname"))); ?>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="lastname" class="form-label">Lastname</label>
                    <input name="lastname" value="<?= session()->current_user[0]["lastname"] ?>" type="text" class="form-control" id="lastname">
                    <?php if (isset($validation) && $validation->getError("lastname")) : ?>
                        <?= view("components/errorMessage", array("message" => $validation->getError("lastname"))); ?>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input name="email" value="<?= session()->current_user[0]["email"] ?>" type="text" class="form-control" id="email">
                    <?php if (isset($validation) && $validation->getError("email")) : ?>
                        <?= view("components/errorMessage", array("message" => $validation->getError("email"))); ?>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="gender" class="form-label">Jenis Kelamin</label>
                    <select class="custom-select text-capitalize" id="gender" name="gender">
                        <option value="LAKI-LAKI" <?= str_contains(session()->current_user[0]["gender"], "laki-laki") ? "selected" : "" ?>>Laki Laki</option>
                        <option value="PEREMPUAN" <?= str_contains(session()->current_user[0]["gender"], "perempuan") ? "selected" : "" ?>>Perempuan</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Alamat</label>
                    <textarea name="address" rows="4" id="address" class="form-control" style="resize: none;"><?= session()->current_user[0]["address"] ?></textarea>
                </div>
                <div class="ms-auto">
                    <button type="submit" class="btn btn-sm" style="background-color: #85f1fe; color: #000000;">Simpan Perubahan</button>
                </div>
            </div>
        </form>
    </div>
</div>


<?= $this->endSection(); ?>