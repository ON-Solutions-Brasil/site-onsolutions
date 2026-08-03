<h4 class="auth-title"><?= __('auth.reset_password') ?></h4>
<p class="auth-subtitle"><?= __('auth.reset_subtitle') ?></p>

<form method="POST" action="<?= url('admin/reset-password') ?>">
    <?= csrfField() ?>
    <input type="hidden" name="token" value="<?= e($token) ?>">
    
    <div class="mb-3">
        <label for="password" class="form-label"><?= __('auth.new_password') ?></label>
        <input type="password" class="form-control" id="password" name="password" required minlength="8" placeholder="Mínimo 8 caracteres">
    </div>
    
    <div class="mb-3">
        <label for="password_confirm" class="form-label"><?= __('auth.confirm_password') ?></label>
        <input type="password" class="form-control" id="password_confirm" name="password_confirm" required placeholder="Confirme a senha">
    </div>
    
    <button type="submit" class="btn btn-primary w-100 btn-lg"><?= __('auth.reset_button') ?></button>
</form>
