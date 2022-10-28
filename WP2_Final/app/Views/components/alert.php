<?php if (session()->getFlashdata($key)) : ?>
    <div class="alert <?= !isset($alert) ? 'alert-danger' : 'alert-success' ?> text-lowercase" role="alert" id="failure">
        <?= session()->getFlashdata($key) ?>
    </div>
<?php endif; ?>