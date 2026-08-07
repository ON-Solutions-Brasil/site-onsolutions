<!-- Hero -->
<section class="page-hero page-hero--about">
    <div class="container text-center">
        <span class="about-tag hero-fade-in">Parceiros</span>
        <h1 class="hero-fade-in"><?= __('partners.title') ?></h1>
        <p class="hero-fade-in">Trabalhamos em parceria com empresas e profissionais que compartilham nossa visão de qualidade e inovação.</p>
    </div>
</section>

<!-- Parceiros -->
<section class="section partners-section">
    <div class="container">
        <?php if (!empty($partners)): ?>
        <div class="row g-4 justify-content-center">
            <?php foreach ($partners as $partner): ?>
            <div class="col-md-6 col-lg-4 scroll-reveal">
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
        </div>
        <?php else: ?>
        <div class="text-center">
            <p class="text-muted">Nenhum parceiro cadastrado no momento.</p>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- CTA Parceria -->
<section class="section partners-cta-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="partners-cta-card scroll-reveal">
                    <div class="partners-cta-card__icon">
                        <i class="bi bi-handshake"></i>
                    </div>
                    <h2>Quer ser nosso parceiro?</h2>
                    <p>Estamos sempre abertos a novas parcerias estratégicas. Se sua empresa compartilha nossa visão de excelência em tecnologia, entre em contato.</p>
                    <div class="partners-cta-card__actions">
                        <a href="<?= url('contato') ?>" class="btn btn-primary btn-lg">
                            <i class="bi bi-chat-dots me-2"></i>Fale Conosco
                        </a>
                        <?php if ($whatsapp = setting('whatsapp_number')): ?>
                        <a href="https://wa.me/<?= preg_replace('/\D/', '', $whatsapp) ?>?text=<?= urlencode('Olá! Gostaria de saber mais sobre parcerias.') ?>" 
                           class="btn btn-success btn-lg" target="_blank" rel="noopener">
                            <i class="bi bi-whatsapp me-2"></i>WhatsApp
                        </a>
                        <?php endif; ?>
                    </div>
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
