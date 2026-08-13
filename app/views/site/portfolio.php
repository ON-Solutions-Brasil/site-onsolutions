<!-- Hero -->
<section class="page-hero page-hero--about">
    <div class="container text-center">
        <span class="about-tag hero-fade-in"><?= __('portfolio.title') ?></span>
        <h1 class="hero-fade-in"><?= __('portfolio.hero_title') ?></h1>
        <p class="hero-fade-in"><?= __('portfolio.meta_description') ?></p>
    </div>
</section>

<!-- Portfólio -->
<section class="section portfolio-section">
    <div class="container">
        <!-- Filtros por categoria (só mostra se tiver projetos) -->
        <?php if (!empty($items)): ?>
        <div class="portfolio-filters text-center mb-5 scroll-reveal">
            <button class="btn btn-outline-primary active" data-filter="all"><?= __('portfolio.filter_all') ?></button>
            <?php
            $lang = defined('CURRENT_LANG') ? CURRENT_LANG : 'pt';
            foreach ($categories as $cat):
                $catName = $cat["name_{$lang}"] ?? $cat['name_pt'];
            ?>
            <button class="btn btn-outline-primary" data-filter="<?= e($cat['slug']) ?>"><?= e($catName) ?></button>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <div class="row g-4 portfolio-grid">
            <?php if (empty($items)): ?>
            <div class="col-12 text-center py-5">
                <div class="portfolio-empty">
                    <i class="bi bi-folder2-open" style="font-size: 3rem; color: var(--primary-200);"></i>
                    <h4 class="mt-3" style="color: var(--gray-700);"><?= __('portfolio.empty_title') ?></h4>
                    <p style="color: var(--gray-500);"><?= __('portfolio.empty_subtitle') ?></p>
                </div>
            </div>
            <?php else: ?>
            <?php
            foreach ($items as $item):
                $title = $item["title_{$lang}"] ?? $item['title_pt'];
            ?>
            <div class="col-md-6 col-lg-4 portfolio-item scroll-reveal" data-category="<?= e($item['category_slug'] ?? '') ?>">
                <div class="portfolio-card">
                    <?php if ($item['cover_image']): ?>
                    <img src="<?= e($item['cover_image']) ?>" alt="<?= e($title) ?>" class="portfolio-img" loading="lazy">
                    <?php else: ?>
                    <div class="portfolio-img-placeholder"><i class="bi bi-image"></i></div>
                    <?php endif; ?>
                    <div class="portfolio-overlay">
                        <h4><?= e($title) ?></h4>
                        <p><?= e($item['client_name'] ?? '') ?></p>
                        <a href="<?= url('portfolio/' . $item['slug']) ?>" class="btn btn-sm btn-light"><?= __('portfolio.view_project') ?></a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="section cta-section">
    <div class="container text-center scroll-reveal">
        <h2><?= __('portfolio.cta_title') ?></h2>
        <p><?= __('portfolio.cta_subtitle') ?></p>
        <a href="<?= url('contato') ?>" class="btn btn-primary btn-lg mt-3"><?= __('portfolio.cta_button') ?></a>
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
