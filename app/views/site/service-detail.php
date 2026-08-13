<?php
$lang = defined('CURRENT_LANG') ? CURRENT_LANG : 'pt';
$title = $service["title_{$lang}"] ?? $service['title_pt'];
$shortDesc = $service["short_description_{$lang}"] ?? $service['short_description_pt'];
$content = $service["content_{$lang}"] ?? $service['content_pt'] ?? '';
$features = json_decode($service['features'] ?? '[]', true);
$techs = json_decode($service['technologies'] ?? '[]', true);
$benefits = json_decode($service['benefits'] ?? '[]', true);
$icon = $service['icon'] ?? 'bi-gear';
?>

<!-- Hero -->
<section class="page-hero page-hero--about">
    <div class="container text-center">
        <span class="about-tag hero-fade-in">
            <a href="<?= url('servicos') ?>" class="text-decoration-none" style="color: var(--primary-300);"><?= __('services.title') ?></a>
        </span>
        <h1 class="hero-fade-in"><?= e($title) ?></h1>
        <p class="hero-fade-in"><?= e($shortDesc) ?></p>
    </div>
</section>

<!-- Conteúdo Principal -->
<section class="section service-detail-section">
    <div class="container">
        <div class="row g-5">
            <!-- Conteúdo -->
            <div class="col-lg-8">
                <?php if ($content): ?>
                <div class="content-body service-detail-content scroll-reveal">
                    <?= $content ?>
                </div>
                <?php endif; ?>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="service-sidebar-card scroll-reveal">
                    <div class="service-sidebar-card__header">
                        <h4><?= __('services.get_quote') ?></h4>
                        <p><?= __('services.get_quote_desc') ?></p>
                    </div>
                    <div class="service-sidebar-card__body">
                        <a href="<?= url('contato') ?>" class="btn btn-primary w-100 mb-3">
                            <i class="bi bi-chat-dots me-2"></i><?= __('services.contact_us') ?>
                        </a>
                        <?php if ($whatsapp = setting('whatsapp_number')): ?>
                        <a href="https://wa.me/<?= preg_replace('/\D/', '', $whatsapp) ?>?text=<?= urlencode(__('services.whatsapp_msg') . ' ' . $title) ?>" 
                           class="btn btn-success w-100" target="_blank" rel="noopener">
                            <i class="bi bi-whatsapp me-2"></i>WhatsApp
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Funcionalidades & Tecnologias (bloco escuro) -->
<?php if ($features || $techs): ?>
<section class="section service-features-dark">
    <div class="container">
        <?php if ($features): ?>
        <div class="scroll-reveal">
            <div class="section-header text-center mb-4">
                <h2 class="section-title text-white"><?= __('services.included_title') ?></h2>
                <p class="section-subtitle" style="color: rgba(255,255,255,0.6);"><?= __('services.included_subtitle') ?> <?= e($title) ?></p>
            </div>
            <div class="row g-3">
                <?php foreach ($features as $feature): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-dark-item">
                        <i class="bi bi-check-circle-fill"></i>
                        <span><?= e($feature) ?></span>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <?php if ($techs): ?>
        <div class="service-techs-row scroll-reveal mt-5">
            <h3 class="text-white text-center mb-3"><?= __('services.technologies') ?></h3>
            <div class="tech-tags-dark">
                <?php foreach ($techs as $tech): ?>
                <span class="tech-tag-dark"><?= e($tech) ?></span>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>
<?php endif; ?>

<!-- Também Oferecemos -->
<?php if (!empty($other_services)): ?>
<section class="section also-offer-section">
    <div class="container">
        <div class="section-header text-center scroll-reveal">
            <h2 class="section-title"><?= __('services.also_offer') ?></h2>
        </div>
        <div class="row g-3 mt-2">
            <?php foreach ($other_services as $other): 
                $otherTitle = $other["title_{$lang}"] ?? $other['title_pt'];
                $otherDesc = $other["short_description_{$lang}"] ?? $other['short_description_pt'] ?? '';
            ?>
            <div class="col-md-6 col-lg-4 col-xl-3 scroll-reveal">
                <a href="<?= url('servicos/' . $other['slug']) ?>" class="also-offer-card">
                    <div class="also-offer-card__icon">
                        <i class="bi <?= e($other['icon'] ?? 'bi-gear') ?>"></i>
                    </div>
                    <div class="also-offer-card__content">
                        <h4><?= e($otherTitle) ?></h4>
                        <p><?= e($otherDesc) ?></p>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- CTA Final -->
<section class="section cta-section">
    <div class="container">
        <div class="cta-content text-center scroll-reveal">
            <h2 class="cta-title"><?= __('services.cta_title') ?></h2>
            <p class="cta-subtitle"><?= __('services.cta_subtitle') ?> <?= e($title) ?>.</p>
            <a href="<?= url('contato') ?>" class="btn btn-primary btn-lg"><?= __('services.get_quote') ?></a>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var els = document.querySelectorAll('.scroll-reveal');
    
    var io = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                io.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    els.forEach(function(el) {
        var rect = el.getBoundingClientRect();
        if (rect.top < window.innerHeight) {
            el.classList.add('is-visible');
        } else {
            io.observe(el);
        }
    });
});
</script>
