<?php
/**
 * Artigo do Blog — Tema 2026 (Fase B).
 * Conteúdo dinâmico do banco ($post) preservado: content_* (HTML), tags, relacionados.
 */
$lang = defined('CURRENT_LANG') ? CURRENT_LANG : 'pt';
$title = $post["title_{$lang}"] ?? $post['title_pt'];
$content = $post["content_{$lang}"] ?? $post['content_pt'] ?? '';
$tags = $tags ?? [];
$related = $related_posts ?? [];
?>
<section class="hero compact">
  <div class="w">
    <nav class="crumb" aria-label="breadcrumb">
      <a href="<?= url('/') ?>"><?= __('menu.home') ?></a><i>/</i>
      <a href="<?= url('blog') ?>"><?= __('blog.title') ?></a><i>/</i>
      <span><?= e($title) ?></span>
    </nav>
    <?php if (!empty($post['category_name'])): ?>
    <span class="badge"><i></i><?= e($post['category_name']) ?></span>
    <?php endif; ?>
    <h1 class="h"><?= e($title) ?></h1>
    <div class="art-meta">
      <?php if (!empty($post['author_name'])): ?><span><i class="bi bi-person"></i> <?= e($post['author_name']) ?></span><?php endif; ?>
      <?php if (!empty($post['published_at'])): ?><span><i class="bi bi-calendar3"></i> <?= e(formatDate($post['published_at'])) ?></span><?php endif; ?>
      <span><i class="bi bi-eye"></i> <?= (int)($post['views_count'] ?? 0) ?></span>
    </div>
  </div>
</section>

<section class="sec">
  <div class="w art">
    <?php if (!empty($post['featured_image'])): ?>
    <img class="art-cover" src="<?= e($post['featured_image']) ?>" alt="<?= e($title) ?>">
    <?php endif; ?>

    <?= $content /* HTML vindo do banco/admin — conteúdo controlado */ ?>

    <?php if ($tags): ?>
    <div class="chips">
      <?php foreach ($tags as $tag): ?>
      <a class="chip" href="<?= url('blog/tag/' . $tag['slug']) ?>"><?= e($tag['name']) ?></a>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>
  </div>
</section>

<?php if ($related): ?>
<section class="sec sec-w">
  <div class="w">
    <div class="eyebrow"><?= e(__('blog.related')) ?></div>
    <h2 class="t2"><?= e(__('home2026.related_posts_title')) ?></h2>
    <div class="bl-grid">
      <?php foreach ($related as $rp):
        $rpTitle = $rp["title_{$lang}"] ?? $rp['title_pt'];
      ?>
      <a class="post" href="<?= url('blog/' . $rp['slug']) ?>">
        <div class="cv">
          <?php if (!empty($rp['featured_image'])): ?>
          <img src="<?= e($rp['featured_image']) ?>" alt="<?= e($rpTitle) ?>" loading="lazy">
          <?php endif; ?>
        </div>
        <div class="pb">
          <?php if (!empty($rp['category_name'])): ?><span class="ct"><?= e($rp['category_name']) ?></span><?php endif; ?>
          <h3><?= e($rpTitle) ?></h3>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>
