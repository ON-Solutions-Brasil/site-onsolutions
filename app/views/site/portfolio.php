<!-- Hero -->
<section class="page-hero page-hero--about">
    <div class="container text-center">
        <span class="about-tag hero-fade-in">Portfólio</span>
        <h1 class="hero-fade-in"><?= __('portfolio.title') ?></h1>
        <p class="hero-fade-in"><?= __('portfolio.meta_description') ?></p>
    </div>
</section>

<!-- Portfólio -->
<section class="section portfolio-section">
    <div class="container">
        <!-- Filtros por categoria -->
        <div class="portfolio-filters text-center mb-5 scroll-reveal">
            <button class="btn btn-outline-primary active" data-filter="all">Todos</button>
            <?php foreach ($categories as $cat): ?>
            <button class="btn btn-outline-primary" data-filter="<?= e($cat['slug']) ?>"><?= e($cat['name_pt']) ?></button>
            <?php endforeach; ?>
        </div>

        <div class="row g-4 portfolio-grid">
            <?php foreach ($items as $item): ?>
            <div class="col-md-6 col-lg-4 portfolio-item scroll-reveal" data-category="<?= e($item['category_slug'] ?? '') ?>">
                <div class="portfolio-card">
                    <?php if ($item['cover_image']): ?>
                    <img src="<?= e($item['cover_image']) ?>" alt="<?= e($item['title_pt']) ?>" class="portfolio-img" loading="lazy">
                    <?php else: ?>
                    <div class="portfolio-img-placeholder"><i class="bi bi-image"></i></div>
                    <?php endif; ?>
                    <div class="portfolio-overlay">
                        <h4><?= e($item['title_pt']) ?></h4>
                        <p><?= e($item['client_name'] ?? '') ?></p>
                        <a href="<?= url('portfolio/' . $item['slug']) ?>" class="btn btn-sm btn-light">Ver Projeto</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="section cta-section">
    <div class="container text-center scroll-reveal">
        <h2>Tem um projeto em mente?</h2>
        <p>Vamos transformar sua ideia em realidade. Fale com a gente.</p>
        <a href="<?= url('contato') ?>" class="btn btn-primary btn-lg mt-3">Fale com Nossa Equipe</a>
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
