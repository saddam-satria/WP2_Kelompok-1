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
            <form action="#" method="POST">
                <div class="d-flex flex-column">

                    <div class="mb-3">
                        <label for="id" class="form-label">ID Account</label>
                        <input disabled value="<?= $user->id  ?>" type="text" class="form-control" name="id" id="id" >
                    </div>

                    <div class="mb-3">
                        <label for="name">Nama Lengkap</label>
                        <input disabled value="<?= $user->firstname . " " . $user->lastname ?>" type="text" class="form-control" name="name" id="name" >
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input disabled value="<?= $user->email?>" type="text" class="form-control" id="email" name="email" >
                    </div>

                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <input disabled value="<?= is_null($user->gender) ? "-" : $user->gender?>" type="text" class="form-control" id="gender" readonly >
                    </div>

                    <div class="mb-3">
                        <label for="verificationCode" class="form-label">Kode Verifikasi</label>
                        <input disabled value="<?= $user->verificationCode?>" type="text" class="form-control" name="verificationCode" id="verificationCode" >
                    </div>
                        
                    <?php if(!$user->isAdmin):?>
                  
                        <div class="mb-3">
                            <label for="isMember" class="form-label">Status Membership</label>
                            <input disabled value="<?= $user->isMember ? "Member": "Bukan Member"?>" type="text" class="form-control" name="isMember" id="isMember" >
                        </div>
                    <?php endif?>

                    <div class="mb-3">
                            <label for="address" class="form-label">Alamat</label>
                            <textarea disabled name="address" rows="4" id="address" class="form-control" style="resize: none;"><?= is_null($user->address) ? "-": $user->address?></textarea>
                    </div>


                  
                </div>
            </form>
        </div>
    </div>
</section>


<?= $this->endSection(); ?>