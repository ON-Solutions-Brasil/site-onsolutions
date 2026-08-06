<!-- Hero -->
<section class="page-hero page-hero--about">
    <div class="container text-center">
        <span class="about-tag hero-fade-in">Blog</span>
        <h1 class="hero-fade-in"><?= __('blog.title') ?></h1>
        <p class="hero-fade-in">Artigos, dicas e insights sobre tecnologia, desenvolvimento e inovação.</p>
    </div>
</section>

<!-- Blog Content -->
<section class="section blog-section">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">
                <?php if (empty($posts)): ?>
                <div class="text-center py-5 scroll-reveal">
                    <i class="bi bi-journal-text" style="font-size: 3rem; color: var(--primary-200);"></i>
                    <h4 class="mt-3" style="color: var(--gray-700);">Nenhum post publicado ainda</h4>
                    <p style="color: var(--gray-500);">Em breve teremos conteúdos incríveis por aqui.</p>
                </div>
                <?php else: ?>
                <div class="row g-4">
                    <?php foreach ($posts as $post): ?>
                    <div class="col-md-6 scroll-reveal">
                        <div class="blog-card">
                            <?php if ($post['featured_image']): ?>
                            <img src="<?= e($post['featured_image']) ?>" alt="<?= e($post['title_pt']) ?>" class="blog-card-img" loading="lazy">
                            <?php endif; ?>
                            <div class="blog-card-body">
                                <span class="blog-card-category"><?= e($post['category_name'] ?? '') ?></span>
                                <h4><a href="<?= url('blog/' . $post['slug']) ?>"><?= e($post['title_pt']) ?></a></h4>
                                <p><?= truncate($post['excerpt_pt'] ?? '', 100) ?></p>
                                <div class="blog-card-meta">
                                    <span><?= e($post['author_name'] ?? '') ?></span>
                                    <span><?= $post['published_at'] ? formatDate($post['published_at']) : '' ?></span>
                                </div>
                            </div>
                        </div>
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
            <div class="col-lg-4">
                <div class="sidebar scroll-reveal">
                    <div class="sidebar-widget">
                        <h5>Categorias</h5>
                        <ul class="category-list">
                            <?php foreach ($categories as $cat): ?>
                            <li><a href="<?= url('blog/categoria/' . $cat['slug']) ?>"><?= e($cat['name_pt']) ?> <span>(<?= $cat['post_count'] ?>)</span></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="sidebar-widget mt-4">
                        <h5><?= __('home.newsletter_title') ?></h5>
                        <form action="<?= url('newsletter/subscribe') ?>" method="POST">
                            <?= csrfField() ?>
                            <div class="input-group">
                                <input type="email" name="email" class="form-control" placeholder="<?= __('newsletter.placeholder') ?>" required>
                                <button class="btn btn-primary"><i class="bi bi-send"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="section cta-section">
    <div class="container text-center scroll-reveal">
        <h2>Quer receber nossos conteúdos?</h2>
        <p>Inscreva-se na newsletter e fique por dentro das novidades.</p>
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
