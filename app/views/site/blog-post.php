<?php $lang = defined('CURRENT_LANG') ? CURRENT_LANG : 'pt'; ?>
<section class="page-hero" style="padding: 7rem 0 3rem;">
    <div class="container">
        <span class="badge bg-primary mb-2"><?= e($post['category_name'] ?? '') ?></span>
        <h1 style="font-size:2.2rem;"><?= e($post["title_{$lang}"] ?? $post['title_pt']) ?></h1>
        <div class="d-flex align-items-center justify-content-center gap-3 mt-3" style="color:var(--gray-400); font-size:0.9rem;">
            <span><i class="bi bi-person"></i> <?= e($post['author_name']) ?></span>
            <span><i class="bi bi-calendar"></i> <?= $post['published_at'] ? formatDate($post['published_at']) : '' ?></span>
            <span><i class="bi bi-eye"></i> <?= (int)$post['views_count'] ?> views</span>
        </div>
    </div>
</section>

<section class="section" style="padding-top:3rem;">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">
                <?php if ($post['featured_image']): ?>
                <img src="<?= e($post['featured_image']) ?>" alt="<?= e($post['title_pt']) ?>" class="img-fluid rounded mb-4" style="width:100%;">
                <?php endif; ?>

                <div class="content-body">
                    <?= $post["content_{$lang}"] ?? $post['content_pt'] ?? '' ?>
                </div>

                <?php if (!empty($tags)): ?>
                <div class="mt-4 pt-3 border-top">
                    <strong><?= __('blog.tags') ?>:</strong>
                    <?php foreach ($tags as $tag): ?>
                    <a href="<?= url('blog/tag/' . $tag['slug']) ?>" class="badge bg-light text-dark"><?= e($tag['name']) ?></a>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <!-- Posts Relacionados -->
                <?php if (!empty($related_posts)): ?>
                <div class="mt-5 pt-4 border-top">
                    <h4><?= __('blog.related') ?></h4>
                    <div class="row g-3 mt-2">
                        <?php foreach ($related_posts as $related): ?>
                        <div class="col-md-4">
                            <div class="blog-card">
                                <?php if ($related['featured_image']): ?>
                                <img src="<?= e($related['featured_image']) ?>" alt="" class="blog-card-img" loading="lazy">
                                <?php endif; ?>
                                <div class="blog-card-body">
                                    <h5 style="font-size:0.95rem;"><a href="<?= url('blog/' . $related['slug']) ?>"><?= e($related['title_pt']) ?></a></h5>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            <div class="col-lg-4">
                <div class="sidebar">
                    <div class="sidebar-widget">
                        <h5>Newsletter</h5>
                        <p class="text-muted" style="font-size:0.9rem;">Receba artigos como este diretamente no seu email.</p>
                        <form action="<?= url('newsletter/subscribe') ?>" method="POST" class="newsletter-form">
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
