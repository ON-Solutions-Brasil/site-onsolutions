<?php
/**
 * Índice de Serviços — Tema 2026 (Fase B).
 * Dados dinâmicos do banco ($services) preservados; apenas a apresentação muda.
 */
$lang = defined('CURRENT_LANG') ? CURRENT_LANG : 'pt';
?>
<section class="hero compact">
  <div class="w">
    <nav class="crumb" aria-label="breadcrumb">
      <a href="<?= url('/') ?>"><?= __('menu.home') ?></a><i>/</i><span><?= __('services.title') ?></span>
    </nav>
    <span class="badge"><i></i><?= e(__('services.title')) ?></span>
    <h1 class="h"><?= e(__('home2026.services_hero_title')) ?></h1>
    <p class="sub"><?= e(__('services.meta_description')) ?></p>
  </div>
</section>

<section class="sec">
  <div class="w">
    <div class="sv-grid">
      <?php foreach ($services as $service):
        $title = $service["title_{$lang}"] ?? $service['title_pt'];
        $desc  = $service["short_description_{$lang}"] ?? $service['short_description_pt'] ?? '';
      ?>
      <a class="sv" href="<?= url('servicos/' . $service['slug']) ?>">
        <b><?= e($title) ?></b>
        <span class="d"><?= e($desc) ?></span>
        <span class="go"><?= __('home.learn_more') ?> <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M9 5l7 7-7 7"/></svg></span>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="sec sec-w">
  <div class="w">
    <a class="svc-box" data-wa-main data-pos="servicos" href="<?= e($waHref ?? url('contato')) ?>"
       <?php if (!empty($waMode)): ?>data-wa-mode="<?= e($waMode) ?>" data-wa-endpoint="<?= e($waEndpoint) ?>"<?php endif; ?>>
      <span>
        <small><?= e(__('home2026.cta_short')) ?></small>
        <b><?= e(__('home2026.svc_cta_title')) ?></b>
      </span>
      <span class="go"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M9 5l7 7-7 7"/></svg></span>
    </a>
  </div>
</section>
