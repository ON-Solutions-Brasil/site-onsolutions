<h4 class="auth-title"><?= __('auth.forgot_password') ?></h4>
<p class="auth-subtitle"><?= __('auth.forgot_subtitle') ?></p>

<form method="POST" action="<?= url('admin/forgot-password') ?>">
    <?= csrfField() ?>
    
    <div class="mb-3">
        <label for="email" class="form-label"><?= __('auth.email') ?></label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
            <input type="email" class="form-control" id="email" name="email" required autofocus placeholder="seu@email.com">
        </div>
    </div>
    
    <button type="submit" class="btn btn-primary w-100 btn-lg"><?= __('auth.send_reset_link') ?></button>
    
    <div class="text-center mt-3">
        <a href="<?= url('admin/login') ?>" class="auth-link"><i class="bi bi-arrow-left"></i> <?= __('auth.back_to_login') ?></a>
    </div>
</form>
