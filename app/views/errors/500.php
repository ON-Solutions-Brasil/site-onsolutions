<section class="error-page">
    <div class="container text-center py-5">
        <h1 class="error-code">500</h1>
        <h2 class="error-title"><?= __('errors.server_error') ?></h2>
        <p class="error-description"><?= __('errors.server_error_desc') ?></p>
        <a href="<?= url('/') ?>" class="btn btn-primary mt-3">
            <i class="bi bi-house"></i> <?= __('errors.back_home') ?>
        </a>
    </div>
</section>
