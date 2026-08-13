<!-- Hero -->
<section class="page-hero page-hero--about">
    <div class="container text-center">
        <span class="about-tag hero-fade-in"><?= __('about.tag') ?></span>
        <h1 class="hero-fade-in"><?= __('about.hero_title_prefix') ?> <?= e(SITE_NAME) ?></h1>
        <p class="hero-fade-in"><?= __('about.hero_subtitle') ?></p>
    </div>
</section>

<!-- Nossa História -->
<section class="section about-history">
    <div class="container">
        <div class="row align-items-center gy-5">
            <div class="col-lg-6 scroll-reveal">
                <span class="about-tag about-tag--dark"><?= __('about.history_tag') ?></span>
                <h2 class="about-title"><?= __('about.history_title') ?></h2>
                <p><?= __('about.history_p1', ['name' => SITE_NAME]) ?></p>
                <p><?= __('about.history_p2') ?></p>
                <p><?= __('about.history_p3') ?></p>
            </div>
            <div class="col-lg-6 scroll-reveal">
                <div class="about-card-visual">
                    <div class="about-card-visual__main">
                        <div class="about-card-visual__bg"></div>
                        <div class="about-card-visual__content">
                            <div class="about-card-visual__icon">
                                <i class="bi bi-code-slash"></i>
                            </div>
                            <div class="about-card-visual__value"><?= __('about.experience_value') ?></div>
                            <div class="about-card-visual__label"><?= __('about.experience_label') ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Nossos Pilares -->
<section class="section about-pillars">
    <div class="container">
        <div class="text-center mb-5 scroll-reveal">
            <span class="about-tag about-tag--dark"><?= __('about.pillars_tag') ?></span>
            <h2 class="about-title about-title--center"><?= __('about.pillars_title') ?></h2>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 scroll-reveal">
                <div class="about-pillar-card">
                    <div class="about-pillar-card__icon"><i class="bi bi-bullseye"></i></div>
                    <h4 class="about-pillar-card__title"><?= __('about.mission_title') ?></h4>
                    <p class="about-pillar-card__text"><?= __('about.mission_text') ?></p>
                </div>
            </div>
            <div class="col-lg-4 scroll-reveal">
                <div class="about-pillar-card">
                    <div class="about-pillar-card__icon"><i class="bi bi-eye"></i></div>
                    <h4 class="about-pillar-card__title"><?= __('about.vision_title') ?></h4>
                    <p class="about-pillar-card__text"><?= __('about.vision_text') ?></p>
                </div>
            </div>
            <div class="col-lg-4 scroll-reveal">
                <div class="about-pillar-card">
                    <div class="about-pillar-card__icon"><i class="bi bi-heart"></i></div>
                    <h4 class="about-pillar-card__title"><?= __('about.values_title') ?></h4>
                    <p class="about-pillar-card__text"><?= __('about.values_text') ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Diferenciais -->
<section class="section about-why">
    <div class="container">
        <div class="text-center mb-5 scroll-reveal">
            <span class="about-tag about-tag--dark"><?= __('about.why_tag') ?></span>
            <h2 class="about-title about-title--center"><?= __('about.why_title') ?></h2>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-3 scroll-reveal">
                <div class="about-why-card">
                    <div class="about-why-card__icon"><i class="bi bi-shield-lock"></i></div>
                    <h4 class="about-why-card__title"><?= __('about.security_title') ?></h4>
                    <p class="about-why-card__text"><?= __('about.security_text') ?></p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 scroll-reveal">
                <div class="about-why-card">
                    <div class="about-why-card__icon"><i class="bi bi-speedometer2"></i></div>
                    <h4 class="about-why-card__title"><?= __('about.performance_title') ?></h4>
                    <p class="about-why-card__text"><?= __('about.performance_text') ?></p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 scroll-reveal">
                <div class="about-why-card">
                    <div class="about-why-card__icon"><i class="bi bi-headset"></i></div>
                    <h4 class="about-why-card__title"><?= __('about.support_title') ?></h4>
                    <p class="about-why-card__text"><?= __('about.support_text') ?></p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 scroll-reveal">
                <div class="about-why-card">
                    <div class="about-why-card__icon"><i class="bi bi-graph-up-arrow"></i></div>
                    <h4 class="about-why-card__title"><?= __('about.results_title') ?></h4>
                    <p class="about-why-card__text"><?= __('about.results_text') ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="section cta-section">
    <div class="container text-center scroll-reveal">
        <h2><?= __('about.cta_title') ?></h2>
        <p><?= __('about.cta_subtitle') ?></p>
        <a href="<?= url('contato') ?>" class="btn btn-primary btn-lg mt-3"><?= __('about.cta_button') ?></a>
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
