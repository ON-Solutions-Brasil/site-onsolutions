<h4 class="auth-title"><?= __('auth.login') ?></h4>
<p class="auth-subtitle"><?= __('auth.login_subtitle') ?></p>

<form method="POST" action="<?= url('admin/login') ?>">
    <?= csrfField() ?>
    
    <div class="mb-3">
        <label for="email" class="form-label"><?= __('auth.email') ?></label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
            <input type="email" class="form-control" id="email" name="email" required autofocus placeholder="seu@email.com">
        </div>
    </div>
    
    <div class="mb-3">
        <label for="password" class="form-label"><?= __('auth.password') ?></label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-lock"></i></span>
            <input type="password" class="form-control" id="password" name="password" required placeholder="••••••••">
            <button type="button" class="input-group-text toggle-password" data-target="password" aria-label="Mostrar senha">
                <i class="bi bi-eye"></i>
            </button>
        </div>
    </div>
    
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="<?= url('admin/forgot-password') ?>" class="auth-link"><?= __('auth.forgot_password') ?></a>
    </div>
    
    <button type="submit" class="btn btn-primary w-100 btn-lg"><?= __('auth.login_button') ?></button>
</form>

<script>
document.querySelectorAll('.toggle-password').forEach(btn => {
    btn.addEventListener('click', function() {
        const input = document.getElementById(this.dataset.target);
        const icon = this.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('bi-eye-slash', 'bi-eye');
        }
    });
});
</script>
