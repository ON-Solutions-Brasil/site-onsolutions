<section class="page-hero">
    <div class="container"><h1><?= __('services.title') ?></h1><p><?= __('services.meta_description') ?></p></div>
</section>

<section class="section">
    <div class="container">
        <div class="row g-4">
            <?php
            $lang = defined('CURRENT_LANG') ? CURRENT_LANG : 'pt';
            foreach ($services as $service):
                $title = $service["title_{$lang}"] ?? $service['title_pt'];
                $desc = $service["short_description_{$lang}"] ?? $service['short_description_pt'];
            ?>
            <div class="col-md-6 col-lg-4">
                <div class="service-card h-100">
                    <div class="service-icon"><i class="bi <?= e($service['icon'] ?? 'bi-gear') ?>"></i></div>
                    <h3 class="service-title"><?= e($title) ?></h3>
                    <p class="service-desc"><?= e($desc) ?></p>
                    <a href="<?= url('servicos/' . $service['slug']) ?>" class="service-link">
                        Saiba mais <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section cta-section">
    <div class="container text-center">
        <h2><?= __('home.cta_title') ?></h2>
        <p class="mb-4"><?= __('home.cta_subtitle') ?></p>
        <a href="<?= url('contato') ?>" class="btn btn-primary btn-lg"><?= __('home.cta_button') ?></a>
    </div>
</section>
