<section class="error-page">
    <div class="container text-center py-5">
        <h1 class="error-code">403</h1>
        <h2 class="error-title"><?= __('errors.access_denied') ?></h2>
        <p class="error-description"><?= __('errors.access_denied_desc') ?></p>
        <a href="<?= url('admin/dashboard') ?>" class="btn btn-primary mt-3">
            <i class="bi bi-arrow-left"></i> Voltar ao Dashboard
        </a>
    </div>
</section>
