<section class="page-hero">
    <div class="container"><h1><?= __('partners.title') ?></h1></div>
</section>

<section class="section">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                <p class="lead">Trabalhamos em parceria com empresas e profissionais que compartilham nossa visão de qualidade e inovação.</p>
            </div>
        </div>

        <div class="row g-4">
            <?php foreach ($partners as $partner): ?>
            <div class="col-md-6 col-lg-4">
                <div class="partner-card text-center">
                    <?php if ($partner['logo']): ?>
                    <img src="<?= e($partner['logo']) ?>" alt="<?= e($partner['name']) ?>" class="partner-logo" loading="lazy">
                    <?php else: ?>
                    <div class="partner-logo-placeholder"><i class="bi bi-building"></i></div>
                    <?php endif; ?>
                    <h4><?= e($partner['name']) ?></h4>
                    <p><?= e($partner['description_pt'] ?? '') ?></p>
                    <?php if ($partner['website']): ?>
                    <a href="<?= e($partner['website']) ?>" target="_blank" rel="noopener" class="btn btn-sm btn-outline-primary">Visitar Site</a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="text-center mt-5">
            <div class="card border-0 shadow-sm d-inline-block">
                <div class="card-body p-5">
                    <h3>Quer ser nosso parceiro?</h3>
                    <p class="text-muted">Entre em contato e vamos conversar sobre oportunidades.</p>
                    <a href="<?= url('contato') ?>" class="btn btn-primary">Fale Conosco</a>
                </div>
            </div>
        </div>
    </div>
</section>
