<!-- Hero -->
<section class="page-hero page-hero--about">
    <div class="container text-center">
        <span class="about-tag hero-fade-in">Parcerias Estratégicas</span>
        <h1 class="hero-fade-in"><?= __('partners.title') ?></h1>
        <p class="hero-fade-in">Alianças com empresas que compartilham nossa busca por excelência tecnológica e resultados extraordinários.</p>
    </div>
</section>

<!-- Sobre parcerias -->
<section class="section">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 scroll-reveal">
                <span class="about-tag about-tag--dark">Por que parceiros?</span>
                <h2 class="about-title">Juntos entregamos mais</h2>
                <p style="color: var(--gray-600); line-height: 1.85; font-size: 1rem;">Acreditamos que as melhores soluções nascem da colaboração entre especialistas. Nossos parceiros são cuidadosamente selecionados para complementar nossas competências e garantir que cada projeto tenha o melhor time possível.</p>
                <p style="color: var(--gray-600); line-height: 1.85; font-size: 1rem;">Cada parceria é construída sobre confiança mútua, padrões elevados de qualidade e o compromisso de entregar resultados que superam expectativas.</p>
            </div>
            <div class="col-lg-6 scroll-reveal">
                <div class="row g-3">
                    <div class="col-6">
                        <div class="about-why-card">
                            <div class="about-why-card__icon"><i class="bi bi-shield-check"></i></div>
                            <h5 class="about-why-card__title">Confiança</h5>
                            <p class="about-why-card__text">Parceiros verificados e com histórico comprovado.</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="about-why-card">
                            <div class="about-why-card__icon"><i class="bi bi-trophy"></i></div>
                            <h5 class="about-why-card__title">Excelência</h5>
                            <p class="about-why-card__text">Padrão premium em cada entrega conjunta.</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="about-why-card">
                            <div class="about-why-card__icon"><i class="bi bi-lightning-charge"></i></div>
                            <h5 class="about-why-card__title">Agilidade</h5>
                            <p class="about-why-card__text">Times complementares, entregas mais rápidas.</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="about-why-card">
                            <div class="about-why-card__icon"><i class="bi bi-graph-up-arrow"></i></div>
                            <h5 class="about-why-card__title">Resultado</h5>
                            <p class="about-why-card__text">Foco em gerar valor real para o cliente final.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Nossos Parceiros -->
<section class="section partners-showcase">
    <div class="container">
        <div class="section-header text-center scroll-reveal">
            <span class="about-tag">Ecossistema</span>
            <h2 class="section-title text-white">Nossos Parceiros</h2>
            <p class="section-subtitle" style="color: rgba(255,255,255,0.6);">Empresas que fazem parte do nosso ecossistema de excelência</p>
        </div>

        <div class="row g-4 mt-4 justify-content-center">
            <?php foreach ($partners as $partner): ?>
            <div class="col-md-6 col-lg-5 scroll-reveal">
                <div class="partner-showcase-card">
                    <div class="partner-showcase-card__header">
                        <?php if (!empty($partner['logo'])): ?>
                        <img src="<?= e($partner['logo']) ?>" alt="<?= e($partner['name']) ?>" class="partner-showcase-logo" loading="lazy">
                        <?php else: ?>
                        <div class="partner-showcase-icon"><i class="bi bi-building"></i></div>
                        <?php endif; ?>
                        <div>
                            <h3><?= e($partner['name']) ?></h3>
                            <span class="partner-showcase-type">Parceiro Estratégico</span>
                        </div>
                    </div>
                    <p class="partner-showcase-desc"><?= e($partner['description_pt'] ?? '') ?></p>
                    <?php if (!empty($partner['website'])): ?>
                    <a href="<?= e($partner['website']) ?>" target="_blank" rel="noopener" class="partner-showcase-link">
                        Visitar site <i class="bi bi-arrow-right"></i>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Torne-se parceiro -->
<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center scroll-reveal">
                <span class="about-tag about-tag--dark">Faça parte</span>
                <h2 class="about-title about-title--center">Torne-se um parceiro On Solutions</h2>
                <p style="color: var(--gray-600); line-height: 1.85; max-width: 560px; margin: 0 auto 2rem;">Se sua empresa atua com tecnologia, design ou consultoria e busca parcerias de alto nível, queremos conhecer você. Juntos podemos criar soluções que fazem a diferença.</p>
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <a href="<?= url('contato') ?>" class="btn btn-primary btn-lg" style="border-radius: 9999px; padding: 0.8rem 2.2rem; font-weight: 600;">
                        <i class="bi bi-chat-dots me-2"></i>Fale Conosco
                    </a>
                    <?php if ($whatsapp = setting('whatsapp_number')): ?>
                    <a href="https://wa.me/<?= preg_replace('/\D/', '', $whatsapp) ?>?text=<?= urlencode('Olá! Gostaria de saber mais sobre parcerias com a On Solutions.') ?>" 
                       class="btn btn-outline-primary btn-lg" target="_blank" rel="noopener" style="border-radius: 9999px; padding: 0.8rem 2.2rem; font-weight: 600;">
                        <i class="bi bi-whatsapp me-2"></i>WhatsApp
                    </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Final -->
<section class="section cta-section">
    <div class="container">
        <div class="cta-content text-center scroll-reveal">
            <h2 class="cta-title">Pronto para transformar seu negócio?</h2>
            <p class="cta-subtitle">Conheça nossos serviços e descubra como podemos ajudar.</p>
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
