<?php if (session()->getFlashdata($key)) : ?>
    <div class="alert alert-danger text-lowercase" role="alert" id="login-failure">
        <?= session()->getFlashdata($key) ?>
    </div>
<?php endif; ?>