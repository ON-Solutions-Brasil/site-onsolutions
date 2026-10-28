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
    <h1 class="h"><?= e(__('blog.hero_title')) ?></h1>
    <p class="sub"><?= e(__('blog.hero_subtitle')) ?></p>
  </div>
</section>

<?php if (!empty($posts)): ?>
<section class="sec">
  <div class="w">
    <div class="bl-grid" style="margin-top:0">
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
          <?php if ($post['published_at']): ?><span class="ml"><?= e(formatDate($post['published_at'])) ?></span><?php endif; ?>
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
