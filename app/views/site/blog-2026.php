<?php
/**
 * Blog (índice) — Tema 2026 (Fase B).
 * Dados dinâmicos do banco ($posts, $categories, $pagination) preservados.
 */
$lang = defined('CURRENT_LANG') ? CURRENT_LANG : 'pt';
$pg = $pagination ?? ['current_page' => 1, 'total_pages' => 1];
?>
<section class="hero compact">
  <div class="w">
    <nav class="crumb" aria-label="breadcrumb">
      <a href="<?= url('/') ?>"><?= __('menu.home') ?></a><i>/</i><span><?= __('blog.title') ?></span>
    </nav>
    <span class="badge"><i></i><?= __('blog.title') ?></span>
    <h1 class="h"><?= e(__('blog.hero_title')) ?></h1>
    <p class="sub"><?= e(__('blog.hero_subtitle')) ?></p>
  </div>
</section>

<?php if (!empty($posts)): ?>
<section class="sec">
  <div class="w">
    <?php if (!empty($categories)): ?>
    <div class="cat-bar">
      <a class="cat-pill active" href="<?= url('blog') ?>"><?= __('blog.filter_all') ?></a>
      <?php foreach ($categories as $cat): ?>
        <?php if (($cat['post_count'] ?? 0) > 0): $catName = $cat["name_{$lang}"] ?? $cat['name_pt']; ?>
        <a class="cat-pill" href="<?= url('blog/categoria/' . $cat['slug']) ?>"><?= e($catName) ?> <span><?= (int)$cat['post_count'] ?></span></a>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <div class="bl-grid">
      <?php foreach ($posts as $post):
        $postTitle = $post["title_{$lang}"] ?? $post['title_pt'];
        $postExcerpt = $post["excerpt_{$lang}"] ?? $post['excerpt_pt'] ?? strip_tags($post["content_{$lang}"] ?? $post['content_pt'] ?? '');
      ?>
      <a class="post" href="<?= url('blog/' . $post['slug']) ?>">
        <div class="cv">
          <?php if (!empty($post['featured_image'])): ?>
          <img src="<?= e($post['featured_image']) ?>" alt="<?= e($postTitle) ?>" loading="lazy">
          <?php endif; ?>
        </div>
        <div class="pb">
          <?php if (!empty($post['category_name'])): ?><span class="ct"><?= e($post['category_name']) ?></span><?php endif; ?>
          <h2><?= e($postTitle) ?></h2>
          <p class="ml"><?= e(truncate($postExcerpt, 120)) ?></p>
          <span class="ml"><i class="bi bi-calendar3"></i> <?= $post['published_at'] ? e(formatDate($post['published_at'])) : '' ?></span>
        </div>
      </a>
      <?php endforeach; ?>
    </div>

    <?php if (($pg['total_pages'] ?? 1) > 1): ?>
    <nav class="pager" aria-label="<?= e(__('home2026.pagination_label')) ?>">
      <?php for ($i = 1; $i <= $pg['total_pages']; $i++): ?>
        <?php if ($i === (int)$pg['current_page']): ?>
        <span class="current"><?= $i ?></span>
        <?php else: ?>
        <a href="<?= url('blog?page=' . $i) ?>"><?= $i ?></a>
        <?php endif; ?>
      <?php endfor; ?>
    </nav>
    <?php endif; ?>
  </div>
</section>
<?php else: ?>
<section class="sec">
  <div class="w">
    <div class="empty">
      <h2 class="t2"><?= e(__('blog.coming_soon_title')) ?></h2>
      <p class="lead2" style="margin-inline:auto"><?= e(__('blog.coming_soon_text')) ?></p>
    </div>
  </div>
</section>
<?php endif; ?>
