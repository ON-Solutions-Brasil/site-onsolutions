<?php $lang = defined('CURRENT_LANG') ? CURRENT_LANG : 'pt'; ?>
<!-- Hero -->
<section class="page-hero page-hero--about">
    <div class="container text-center">
        <span class="about-tag hero-fade-in"><?= __('blog.title') ?></span>
        <h1 class="hero-fade-in"><?= __('blog.hero_title') ?></h1>
        <p class="hero-fade-in"><?= __('blog.hero_subtitle') ?></p>
    </div>
</section>

<?php if (!empty($posts)): ?>
<!-- Categorias como filtros -->
<?php if (!empty($categories)): ?>
<section class="blog-categories-bar">
    <div class="container">
        <div class="blog-categories-scroll">
            <a href="<?= url('blog') ?>" class="blog-category-pill active"><?= __('blog.filter_all') ?></a>
            <?php foreach ($categories as $cat): ?>
            <?php if ($cat['post_count'] > 0): ?>
            <?php $catName = $cat["name_{$lang}"] ?? $cat['name_pt']; ?>
            <a href="<?= url('blog/categoria/' . $cat['slug']) ?>" class="blog-category-pill">
                <?= e($catName) ?> <span><?= $cat['post_count'] ?></span>
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
        <div class="row g-4">
            <?php foreach ($posts as $index => $post):
                $postTitle = $post["title_{$lang}"] ?? $post['title_pt'];
                $postExcerpt = $post["excerpt_{$lang}"] ?? $post['excerpt_pt'] ?? strip_tags($post["content_{$lang}"] ?? $post['content_pt'] ?? '');
            ?>
            <div class="<?= $index === 0 ? 'col-12' : 'col-md-6 col-lg-4' ?> scroll-reveal">
                <a href="<?= url('blog/' . $post['slug']) ?>" class="blog-grid-card <?= $index === 0 ? 'blog-grid-card--featured' : '' ?>">
                    <div class="blog-grid-card__image">
                        <?php if ($post['featured_image']): ?>
                        <img src="<?= e($post['featured_image']) ?>" alt="<?= e($postTitle) ?>" loading="lazy">
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
                        <h3><?= e($postTitle) ?></h3>
                        <p><?= truncate($postExcerpt, 120) ?></p>
                        <span class="blog-grid-card__readmore"><?= __('blog.read_article') ?> <i class="bi bi-arrow-right"></i></span>
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
    </div>
</section>

<?php else: ?>
<!-- Estado vazio premium -->
<section class="blog-coming-soon">
    <div class="container">
        <div class="blog-coming-soon__wrapper scroll-reveal">
            <div class="blog-coming-soon__visual">
                <div class="blog-coming-soon__orbit">
                    <div class="blog-coming-soon__icon"><i class="bi bi-braces"></i></div>
                    <div class="blog-coming-soon__dot blog-coming-soon__dot--1"></div>
                    <div class="blog-coming-soon__dot blog-coming-soon__dot--2"></div>
                    <div class="blog-coming-soon__dot blog-coming-soon__dot--3"></div>
                </div>
            </div>
            <div class="blog-coming-soon__content">
                <span class="about-tag about-tag--dark"><?= __('blog.coming_soon_tag') ?></span>
                <h2><?= __('blog.coming_soon_title') ?></h2>
                <p><?= __('blog.coming_soon_text') ?></p>
                <form action="<?= url('newsletter/subscribe') ?>" method="POST" class="blog-coming-soon__form" id="blogNewsletterForm">
                    <?= csrfField() ?>
                    <div class="input-group">
                        <input type="email" name="email" class="form-control" placeholder="<?= __('blog.email_placeholder') ?>" required>
                        <button type="submit" class="btn btn-primary"><?= __('blog.notify_btn') ?></button>
                    </div>
                    <div class="blog-newsletter-success" id="blogNewsletterSuccess" style="display: none;">
                        <i class="bi bi-check-circle-fill"></i>
                        <span><?= __('blog.notify_success') ?></span>
                    </div>
                </form>
            </div>
        </div>

        <!-- Preview de categorias -->
        <?php if (!empty($categories)): ?>
        <div class="blog-coming-soon__categories scroll-reveal">
            <h4><?= __('blog.categories_preview') ?></h4>
            <div class="blog-coming-soon__tags">
                <?php foreach ($categories as $cat):
                    $catName = $cat["name_{$lang}"] ?? $cat['name_pt'];
                ?>
                <span class="blog-coming-soon__tag"><?= e($catName) ?></span>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>
<?php endif; ?>

<!-- CTA -->
<section class="section cta-section">
    <div class="container">
        <div class="cta-content text-center scroll-reveal">
            <h2 class="cta-title"><?= __('blog.cta_title') ?></h2>
            <p class="cta-subtitle"><?= __('blog.cta_subtitle') ?></p>
            <a href="<?= url('servicos') ?>" class="btn btn-primary btn-lg"><?= __('blog.cta_button') ?></a>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Scroll reveal
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

    // Newsletter form AJAX
    var form = document.getElementById('blogNewsletterForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(form);
            var btn = form.querySelector('button[type="submit"]');
            btn.innerHTML = '<i class="bi bi-hourglass-split"></i>';
            btn.disabled = true;

            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(function() {
                form.querySelector('.input-group').style.display = 'none';
                document.getElementById('blogNewsletterSuccess').style.display = 'flex';
            })
            .catch(function() {
                form.querySelector('.input-group').style.display = 'none';
                document.getElementById('blogNewsletterSuccess').style.display = 'flex';
            });
        });
    }
});
</script>
