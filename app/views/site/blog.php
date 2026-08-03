<section class="page-hero">
    <div class="container"><h1><?= __('blog.title') ?></h1></div>
</section>

<section class="section">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">
                <?php if (empty($posts)): ?>
                <p class="text-muted text-center py-5"><?= __('blog.no_posts') ?></p>
                <?php else: ?>
                <div class="row g-4">
                    <?php foreach ($posts as $post): ?>
                    <div class="col-md-6">
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
                <div class="sidebar">
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
