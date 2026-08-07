<!-- Hero -->
<section class="page-hero page-hero--about">
    <div class="container text-center">
        <span class="about-tag hero-fade-in">Parceiros</span>
        <h1 class="hero-fade-in"><?= __('partners.title') ?></h1>
        <p class="hero-fade-in">Trabalhamos em parceria com empresas e profissionais que compartilham nossa visão de qualidade e inovação.</p>
    </div>
</section>

<!-- Parceiros + CTA lado a lado -->
<section class="section partners-section">
    <div class="container">
        <div class="row g-4 justify-content-center align-items-stretch">
            <?php foreach ($partners as $partner): ?>
            <div class="col-md-6 col-lg-5 scroll-reveal">
                <div class="partner-card">
                    <?php if (!empty($partner['logo'])): ?>
                    <img src="<?= e($partner['logo']) ?>" alt="<?= e($partner['name']) ?>" class="partner-logo" loading="lazy">
                    <?php else: ?>
                    <div class="partner-logo-placeholder"><i class="bi bi-building"></i></div>
                    <?php endif; ?>
                    <h4><?= e($partner['name']) ?></h4>
                    <p class="partner-desc"><?= e($partner['description_pt'] ?? '') ?></p>
                    <?php if (!empty($partner['website'])): ?>
                    <a href="<?= e($partner['website']) ?>" target="_blank" rel="noopener" class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-box-arrow-up-right me-1"></i>Visitar Site
                    </a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>

            <!-- Quer ser nosso parceiro? -->
            <div class="col-md-6 col-lg-5 scroll-reveal">
                <div class="partner-card partner-card--cta">
                    <div class="partner-logo-placeholder"><i class="bi bi-handshake"></i></div>
                    <h4>Quer ser nosso parceiro?</h4>
                    <p class="partner-desc">Entre em contato e vamos conversar sobre oportunidades de parceria.</p>
                    <a href="<?= url('contato') ?>" class="btn btn-sm btn-primary">
                        <i class="bi bi-chat-dots me-1"></i>Fale Conosco
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Final -->
<section class="section cta-section">
    <div class="container">
        <div class="cta-content text-center scroll-reveal">
            <h2 class="cta-title">Vamos construir algo incrível juntos?</h2>
            <p class="cta-subtitle">Conheça nossos serviços e descubra como podemos ajudar seu negócio.</p>
            <a href="<?= url('servicos') ?>" class="btn btn-primary btn-lg">Ver Serviços</a>
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
