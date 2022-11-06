<?= $this->extend("layouts/user/dashboard"); ?>

<?= $this->section("content"); ?>

<div class="d-flex p-3">
    <div class="card">
        <div class="card-header text-white" style="background-color: #4663be;">
            <div class="d-flex flex-column">
                <span>Dari: <?= $notification->from ?></span>
                <span class="my-1">Kepada: <?= $notification->to ?></span>
                <span><?= date_format(date_create($notification->created_at), "d-m-Y") ?></span>
            </div>
        </div>
        <div class="card-body">
            <p><?= $notification->message ?></p>
        </div>
        <div class="card-footer">
            <form action="<?= base_url("/user/notification/" . $notification->notificationId) ?>" method="POST">
                <div class="d-flex">
                    <div class="ml-auto">
                        <button class="btn btn-sm btn-primary">Tandai Dibaca</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>