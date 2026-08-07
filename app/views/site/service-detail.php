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
            <a href="<?= url('servicos') ?>" class="text-decoration-none" style="color: var(--primary-300);">Serviços</a>
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
                <!-- Ícone e Introdução -->
                <div class="service-detail-intro scroll-reveal">
                    <div class="service-detail-icon">
                        <i class="bi <?= e($icon) ?>"></i>
                    </div>
                    <div class="service-detail-intro-text">
                        <h2><?= e($title) ?></h2>
                        <p><?= e($shortDesc) ?></p>
                    </div>
                </div>

                <!-- Conteúdo Rich Text -->
                <?php if ($content): ?>
                <div class="content-body service-detail-content scroll-reveal">
                    <?= $content ?>
                </div>
                <?php endif; ?>

                <!-- Funcionalidades -->
                <?php if ($features): ?>
                <div class="service-detail-features scroll-reveal">
                    <h3><i class="bi bi-check2-square"></i> Funcionalidades</h3>
                    <div class="row g-3 mt-2">
                        <?php foreach ($features as $feature): ?>
                        <div class="col-md-6">
                            <div class="feature-item">
                                <i class="bi bi-check-circle-fill"></i>
                                <span><?= e($feature) ?></span>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Benefícios -->
                <?php if ($benefits): ?>
                <div class="service-detail-benefits scroll-reveal">
                    <h3><i class="bi bi-star"></i> Benefícios</h3>
                    <div class="row g-3 mt-2">
                        <?php foreach ($benefits as $benefit): ?>
                        <div class="col-md-6">
                            <div class="benefit-item">
                                <i class="bi bi-arrow-right-circle-fill"></i>
                                <span><?= e($benefit) ?></span>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Tecnologias -->
                <?php if ($techs): ?>
                <div class="service-detail-techs scroll-reveal">
                    <h3><i class="bi bi-cpu"></i> Tecnologias Utilizadas</h3>
                    <div class="tech-tags-grid mt-3">
                        <?php foreach ($techs as $tech): ?>
                        <span class="tech-tag"><?= e($tech) ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- CTA Card -->
                <div class="service-sidebar-card scroll-reveal">
                    <div class="service-sidebar-card__header">
                        <h4>Solicitar Orçamento</h4>
                        <p>Precisa deste serviço? Entre em contato para um orçamento personalizado.</p>
                    </div>
                    <div class="service-sidebar-card__body">
                        <a href="<?= url('contato') ?>" class="btn btn-primary w-100 mb-3">
                            <i class="bi bi-chat-dots me-2"></i>Fale Conosco
                        </a>
                        <?php if ($whatsapp = setting('whatsapp_number')): ?>
                        <a href="https://wa.me/<?= preg_replace('/\D/', '', $whatsapp) ?>?text=<?= urlencode('Olá! Gostaria de saber mais sobre o serviço de ' . $title) ?>" 
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

<!-- Portfólio Relacionado -->
<?php if (!empty($related_portfolio)): ?>
<section class="section service-related-section bg-light">
    <div class="container">
        <div class="section-header text-center scroll-reveal">
            <h2 class="section-title">Projetos Relacionados</h2>
            <p class="section-subtitle">Veja como aplicamos este serviço em projetos reais</p>
        </div>
        <div class="row g-4 mt-4">
            <?php foreach ($related_portfolio as $item): ?>
            <div class="col-md-4 scroll-reveal">
                <div class="portfolio-card">
                    <?php if (!empty($item['cover_image'])): ?>
                    <img src="<?= e($item['cover_image']) ?>" alt="<?= e($item['title_pt']) ?>" class="portfolio-img" loading="lazy">
                    <?php else: ?>
                    <div class="portfolio-img-placeholder"><i class="bi bi-image"></i></div>
                    <?php endif; ?>
                    <div class="portfolio-overlay">
                        <h4><?= e($item['title_pt']) ?></h4>
                        <p><?= e($item['client_name'] ?? '') ?></p>
                        <a href="<?= url('portfolio/' . $item['slug']) ?>" class="btn btn-sm btn-light">Ver Case</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-4">
            <a href="<?= url('portfolio') ?>" class="btn btn-outline-primary">Ver Todo Portfólio</a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Também Oferecemos -->
<?php if (!empty($other_services)): ?>
<section class="section also-offer-section">
    <div class="container">
        <div class="section-header text-center scroll-reveal">
            <span class="about-tag about-tag--dark">Conheça mais</span>
            <h2 class="section-title">Também oferecemos</h2>
            <p class="section-subtitle">Soluções completas para impulsionar seu negócio</p>
        </div>
        <div class="row g-4 mt-4">
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
            <h2 class="cta-title">Pronto para transformar seu negócio?</h2>
            <p class="cta-subtitle">Vamos conversar sobre como podemos ajudar com <?= e($title) ?>.</p>
            <a href="<?= url('contato') ?>" class="btn btn-primary btn-lg">Solicitar Orçamento</a>
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
