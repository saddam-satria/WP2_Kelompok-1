<?= $this->extend("layouts/main");?>


<?= $this->section("content");?>

<div class="mt-5">
    <?php if(session()->current_user):?>
        <span class="text-white">
            <?= session()->current_user["email"]?>
        </span>
        <form action="<?= base_url("auth/logout")?>" method="POST">
            <button type="submit" class="btn btn-sm btn-primary">Logout</button>
        </form>
    <?php endif;?>    
</div>

<?php $this->endSection();?>