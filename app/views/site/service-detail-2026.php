<?php
/**
 * Detalhe do Serviço — Tema 2026 (Fase B).
 * Conteúdo dinâmico do banco ($service) preservado: content_* (HTML), features/technologies (JSON).
 */
$lang = defined('CURRENT_LANG') ? CURRENT_LANG : 'pt';
$title     = $service["title_{$lang}"] ?? $service['title_pt'];
$shortDesc = $service["short_description_{$lang}"] ?? $service['short_description_pt'] ?? '';
$content   = $service["content_{$lang}"] ?? $service['content_pt'] ?? '';
$features  = json_decode($service['features'] ?? '[]', true) ?: [];
$techs     = json_decode($service['technologies'] ?? '[]', true) ?: [];
$others    = $other_services ?? [];
?>
<section class="hero compact">
  <div class="w">
    <nav class="crumb" aria-label="breadcrumb">
      <a href="<?= url('/') ?>"><?= __('menu.home') ?></a><i>/</i>
      <a href="<?= url('servicos') ?>"><?= __('services.title') ?></a><i>/</i>
      <span><?= e($title) ?></span>
    </nav>
    <span class="badge"><i></i><?= __('services.title') ?></span>
    <h1 class="h"><?= e($title) ?></h1>
    <?php if ($shortDesc): ?><p class="sub"><?= e($shortDesc) ?></p><?php endif; ?>
  </div>
</section>

<section class="sec">
  <div class="w art">
    <?php if ($content): ?>
    <?= $content /* HTML vindo do banco/admin — conteúdo controlado */ ?>
    <?php endif; ?>

    <?php if ($features): ?>
    <h2><?= e(__('services.included_title')) ?></h2>
    <div class="feats">
      <?php foreach ($features as $feature): ?>
      <div class="feat"><span><?= e($feature) ?></span></div>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <?php if ($techs): ?>
    <h2><?= e(__('services.technologies')) ?></h2>
    <div class="chips">
      <?php foreach ($techs as $tech): ?>
      <span class="chip"><?= e($tech) ?></span>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <a class="svc-box" data-wa-main data-pos="servico-detalhe" href="<?= e($waHref ?? url('contato')) ?>"
       <?php if (!empty($waMode)): ?>data-wa-mode="<?= e($waMode) ?>" data-wa-endpoint="<?= e($waEndpoint) ?>"<?php endif; ?>>
      <span>
        <small><?= e(__('home2026.cta_short')) ?></small>
        <b><?= e(__('services.cta_title')) ?></b>
      </span>
      <span class="go"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M9 5l7 7-7 7"/></svg></span>
    </a>
  </div>
</section>

<?php if ($others): ?>
<section class="sec sec-w">
  <div class="w">
    <div class="eyebrow"><?= e(__('services.also_offer')) ?></div>
    <h2 class="t2"><?= e(__('home2026.other_services_title')) ?></h2>
    <div class="sv-grid">
      <?php foreach (array_slice($others, 0, 6) as $other):
        $otherTitle = $other["title_{$lang}"] ?? $other['title_pt'];
        $otherDesc  = $other["short_description_{$lang}"] ?? $other['short_description_pt'] ?? '';
      ?>
      <a class="sv" href="<?= url('servicos/' . $other['slug']) ?>">
        <b><?= e($otherTitle) ?></b>
        <span class="d"><?= e($otherDesc) ?></span>
        <span class="go"><?= __('home.learn_more') ?> <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M9 5l7 7-7 7"/></svg></span>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>
