<!-- Hero -->
<section class="page-hero page-hero--about">
    <div class="container text-center">
        <span class="about-tag hero-fade-in">Serviços</span>
        <h1 class="hero-fade-in"><?= __('services.title') ?></h1>
        <p class="hero-fade-in"><?= __('services.meta_description') ?></p>
    </div>
</section>

<!-- Serviços -->
<section class="section services-section">
    <div class="container">
        <div class="row g-4">
            <?php
            $lang = defined('CURRENT_LANG') ? CURRENT_LANG : 'pt';
            foreach ($services as $service):
                $title = $service["title_{$lang}"] ?? $service['title_pt'];
                $desc = $service["short_description_{$lang}"] ?? $service['short_description_pt'];
            ?>
            <div class="col-md-6 col-lg-4 scroll-reveal">
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

<!-- CTA -->
<section class="section cta-section">
    <div class="container text-center scroll-reveal">
        <h2><?= __('home.cta_title') ?></h2>
        <p class="mb-4"><?= __('home.cta_subtitle') ?></p>
        <a href="<?= url('contato') ?>" class="btn btn-primary btn-lg"><?= __('home.cta_button') ?></a>
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
