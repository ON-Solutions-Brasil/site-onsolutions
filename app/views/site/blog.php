<!-- Hero -->
<section class="page-hero page-hero--about">
    <div class="container text-center">
        <span class="about-tag hero-fade-in">Blog</span>
        <h1 class="hero-fade-in">Insights sobre tecnologia e negócios</h1>
        <p class="hero-fade-in">Artigos sobre desenvolvimento, integrações, IA e como escalar seu negócio com tecnologia.</p>
    </div>
</section>

<!-- Categorias como filtros -->
<?php if (!empty($categories)): ?>
<section class="blog-categories-bar">
    <div class="container">
        <div class="blog-categories-scroll">
            <a href="<?= url('blog') ?>" class="blog-category-pill active">Todos</a>
            <?php foreach ($categories as $cat): ?>
            <?php if ($cat['post_count'] > 0): ?>
            <a href="<?= url('blog/categoria/' . $cat['slug']) ?>" class="blog-category-pill">
                <?= e($cat['name_pt']) ?> <span><?= $cat['post_count'] ?></span>
            </a>
            <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Posts Grid -->
<section class="section blog-grid-section">
    <div class="container">
        <?php if (empty($posts)): ?>
        <div class="text-center py-5 scroll-reveal">
            <div class="blog-empty-state">
                <i class="bi bi-journal-richtext"></i>
                <h3>Nenhum post publicado ainda</h3>
                <p>Em breve teremos conteúdos incríveis por aqui. Enquanto isso, inscreva-se na nossa newsletter.</p>
                <form action="<?= url('newsletter/subscribe') ?>" method="POST" class="blog-empty-newsletter">
                    <?= csrfField() ?>
                    <div class="input-group">
                        <input type="email" name="email" class="form-control" placeholder="Seu melhor e-mail" required>
                        <button class="btn btn-primary"><i class="bi bi-send me-1"></i>Inscrever</button>
                    </div>
                </form>
            </div>
        </div>
        <?php else: ?>
        <div class="row g-4">
            <?php foreach ($posts as $index => $post): ?>
            <div class="<?= $index === 0 ? 'col-12' : 'col-md-6 col-lg-4' ?> scroll-reveal">
                <a href="<?= url('blog/' . $post['slug']) ?>" class="blog-grid-card <?= $index === 0 ? 'blog-grid-card--featured' : '' ?>">
                    <div class="blog-grid-card__image">
                        <?php if ($post['featured_image']): ?>
                        <img src="<?= e($post['featured_image']) ?>" alt="<?= e($post['title_pt']) ?>" loading="lazy">
                        <?php else: ?>
                        <div class="blog-grid-card__placeholder">
                            <i class="bi bi-file-earmark-text"></i>
                        </div>
                        <?php endif; ?>
                        <?php if (!empty($post['category_name'])): ?>
                        <span class="blog-grid-card__badge"><?= e($post['category_name']) ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="blog-grid-card__content">
                        <span class="blog-grid-card__date">
                            <i class="bi bi-calendar3"></i>
                            <?= $post['published_at'] ? formatDate($post['published_at']) : '' ?>
                        </span>
                        <h3><?= e($post['title_pt']) ?></h3>
                        <p><?= truncate($post['excerpt_pt'] ?? strip_tags($post['content_pt'] ?? ''), 120) ?></p>
                        <span class="blog-grid-card__readmore">Ler artigo <i class="bi bi-arrow-right"></i></span>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Paginação -->
        <?php if ($pagination['total_pages'] > 1): ?>
        <nav class="mt-5">
            <ul class="pagination justify-content-center">
                <?php for ($i = 1; $i <= $pagination['total_pages']; $i++): ?>
                <li class="page-item <?= $i === $pagination['current_page'] ? 'active' : '' ?>">
                    <a class="page-link" href="<?= url('blog?page=' . $i) ?>"><?= $i ?></a>
                </li>
                <?php endfor; ?>
            </ul>
        </nav>
        <?php endif; ?>
        <?php endif; ?>
    </div>
</section>

<!-- CTA Newsletter -->
<section class="section cta-section">
    <div class="container">
        <div class="cta-content text-center scroll-reveal">
            <h2 class="cta-title">Quer receber nossos conteúdos?</h2>
            <p class="cta-subtitle">Inscreva-se na newsletter e fique por dentro das novidades.</p>
            <form action="<?= url('newsletter/subscribe') ?>" method="POST" style="max-width: 420px; margin: 0 auto;">
                <?= csrfField() ?>
                <div class="input-group input-group-lg">
                    <input type="email" name="email" class="form-control" placeholder="<?= __('newsletter.placeholder') ?>" required style="background: rgba(255,255,255,0.1); border-color: rgba(255,255,255,0.2); color: white; border-radius: var(--radius) 0 0 var(--radius);">
                    <button class="btn btn-primary" style="border-radius: 0 var(--radius) var(--radius) 0;">
                        <i class="bi bi-send me-1"></i>Assinar
                    </button>
                </div>
            </form>
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
