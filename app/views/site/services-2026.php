<?php
/**
 * Índice de Serviços — Tema 2026, fiel à referência (docs/referencia/home-ref.html).
 * Hero compacto (sem badge) + 4 grupos (.grp) com título e lead por categoria,
 * cada um com sua grade de serviços. Dados reais do banco preservados
 * ($service_groups, montado no controller).
 */
$lang = defined('CURRENT_LANG') ? CURRENT_LANG : 'pt';
$groups = $service_groups ?? ['organize' => $services ?? [], 'sell' => [], 'automate' => [], 'products' => []];
$arrow = '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M9 5l7 7-7 7"/></svg>';

/** Rótulos/leads de cada grupo (referência), via i18n. */
$groupMeta = [
    'organize' => ['title' => __('home2026.si_group_organize'), 'lead' => __('home2026.si_group_organize_lead')],
    'sell'     => ['title' => __('home2026.si_group_sell'),     'lead' => __('home2026.si_group_sell_lead')],
    'automate' => ['title' => __('home2026.si_group_automate'), 'lead' => __('home2026.si_group_automate_lead')],
    'products' => ['title' => __('home2026.si_group_products'), 'lead' => __('home2026.si_group_products_lead')],
];
?>
<section class="hero compact">
  <div class="w">
    <nav class="crumb" aria-label="breadcrumb">
      <a href="<?= url('/') ?>"><?= __('menu.home') ?></a><i>/</i><span><?= __('services.title') ?></span>
    </nav>
    <h1 class="h"><?= __('home2026.si_hero_title') /* contém <mark> */ ?></h1>
    <p class="sub"><?= e(__('home2026.si_hero_sub')) ?></p>
  </div>
</section>

<section class="sec">
  <div class="w">
    <?php foreach ($groupMeta as $key => $meta): ?>
    <?php $items = $groups[$key] ?? []; if (empty($items)) continue; ?>
    <div class="grp">
      <h2 class="t2"><?= e($meta['title']) ?></h2>
      <p class="lead2"><?= e($meta['lead']) ?></p>
      <div class="sv-grid">
        <?php foreach ($items as $service):
          $title = $service["title_{$lang}"] ?? $service['title_pt'];
          $desc  = $service["short_description_{$lang}"] ?? $service['short_description_pt'] ?? '';
        ?>
        <a class="sv" href="<?= url('servicos/' . $service['slug']) ?>">
          <b><?= e($title) ?></b>
          <span class="d"><?= e($desc) ?></span>
          <span class="go"><?= __('home2026.see_how') ?> <?= $arrow ?></span>
        </a>
        <?php endforeach; ?>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</section>

<!-- CTA final (referência) -->
<section class="final" id="fale-com-a-on">
  <div class="w">
    <h2 class="t2"><?= e(__('home2026.si_final_title')) ?></h2>
    <p class="l3"><?= e(__('home2026.sd_final_lead')) ?></p>
    <p class="nt"><?= e(__('home2026.sd_final_note')) ?></p>
  </div>
</section>
