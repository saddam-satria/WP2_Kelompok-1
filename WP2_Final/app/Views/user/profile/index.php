<?= $this->extend("layouts/user/dashboard"); ?>

<?= $this->section("content"); ?>

<?= view("components/alert", array("key" => "error")) ?>

<div class="row">
    <div class="col-sm-12 col-md-6">
        <div class="d-flex justify-content-center mb-5">
            <img style="width: 120px; height: 120px; object-fit: cover;" class="img-fluid rounded-circle" src="<?= is_null(session()->current_user[0]["image"]) ? base_url("assets/img/avatar.jpg")  : base_url("assets/" . session()->current_user[0]["image"])  ?>" alt="asdsa" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false"></img>
        </div>
        <div class="d-flex flex-column">
            <div class="mb-3">
                <label for="firstname" class="form-label">Firstname</label>
                <input value="<?= $currentUser->firstname ?>" type="text" class="form-control" id="firstname" disabled>
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Lastname</label>
                <input value="<?= $currentUser->lastname == "" ? "-" : $currentUser->firstname  ?>" type="text" class="form-control" id="lastname" disabled>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input value="<?= $currentUser->email ?>" type="text" class="form-control" id="email" disabled>
            </div>
            <div class="mb-3">
                <label for="gender" class="form-label">gender</label>
                <input value="<?= $currentUser->gender  ?>" type="text" class="form-control" id="email" disabled>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Alamat</label>
                <textarea name="address" rows="4" id="address" class="form-control" style="resize: none;" disabled><?= $currentUser->address == "" ? "-" : $currentUser->address   ?></textarea>
            </div>
            <div class="ml-auto">
                <a href="<?= base_url("user/profile?edit=" . true) ?>" class="btn btn-sm" style="background-color: #85f1fe; color: #000000;">Edit</a>
            </div>
        </div>

        <div class="my-5">
            <form>
                <div class="d-flex flex-column">
                    <div class="mb-3">
                        <label for="old_password" class="form-label">Password Lama</label>
                        <input name="old_password" type="password" class="form-control" id="old_password" placeholder="********">
                    </div>
                    <div class="mb-3">
                        <label for="new_password" class="form-label">Password Baru</label>
                        <input name="new_password" type="password" class="form-control" id="new_password" placeholder="********">
                    </div>
                    <div class="mb-3">
                        <label for="confirmation_new_password" class="form-label">Konfirmasi Password Baru</label>
                        <input name="confirmation_new_password" type="password" class="form-control" id="confirmation_new_password" placeholder="********">
                    </div>
                    <div class="ml-auto">
                        <button type="submit" class="btn btn-sm" style="background-color: #85f1fe; color: #000000;">Update Password</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>