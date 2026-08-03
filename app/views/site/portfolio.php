<section class="page-hero">
    <div class="container"><h1><?= __('portfolio.title') ?></h1><p><?= __('portfolio.meta_description') ?></p></div>
</section>

<section class="section">
    <div class="container">
        <!-- Filtros por categoria -->
        <div class="portfolio-filters text-center mb-5">
            <button class="btn btn-outline-primary active" data-filter="all">Todos</button>
            <?php foreach ($categories as $cat): ?>
            <button class="btn btn-outline-primary" data-filter="<?= e($cat['slug']) ?>"><?= e($cat['name_pt']) ?></button>
            <?php endforeach; ?>
        </div>

        <div class="row g-4 portfolio-grid">
            <?php foreach ($items as $item): ?>
            <div class="col-md-6 col-lg-4 portfolio-item" data-category="<?= e($item['category_slug'] ?? '') ?>">
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
