<?php
/**
 * Quem Somos — Tema 2026 (Fase C). Conteúdo preservado (mesmas chaves i18n); só visual.
 */
?>
<section class="hero compact">
  <div class="w">
    <nav class="crumb" aria-label="breadcrumb">
      <a href="<?= url('/') ?>"><?= __('menu.home') ?></a><i>/</i><span><?= __('about.tag') ?></span>
    </nav>
    <h1 class="h"><?= __('about.hero_title_prefix') ?> <?= e(SITE_NAME) ?></h1>
    <p class="sub"><?= e(__('about.hero_subtitle')) ?></p>
  </div>
</section>

<!-- Nossa História -->
<section class="sec">
  <div class="w">
    <div class="split">
      <div>
        <div class="eyebrow"><?= e(__('about.history_tag')) ?></div>
        <h2 class="t2"><?= e(__('about.history_title')) ?></h2>
        <p style="margin-top:18px"><?= __('about.history_p1', ['name' => SITE_NAME]) ?></p>
        <p><?= __('about.history_p2') ?></p>
        <p><?= __('about.history_p3') ?></p>
      </div>
      <div class="highlight-card">
        <i class="bi bi-code-slash"></i>
        <span class="v"><?= e(__('about.experience_value')) ?></span>
        <span class="l"><?= e(__('about.experience_label')) ?></span>
      </div>
    </div>
  </div>
</section>

<!-- Pilares -->
<section class="sec sec-w">
  <div class="w">
    <div class="eyebrow"><?= e(__('about.pillars_tag')) ?></div>
    <h2 class="t2"><?= e(__('about.pillars_title')) ?></h2>
    <div class="cards cols-3">
      <div class="icard"><div class="bi"><i class="bi bi-bullseye"></i></div><h3><?= e(__('about.mission_title')) ?></h3><p><?= e(__('about.mission_text')) ?></p></div>
      <div class="icard"><div class="bi"><i class="bi bi-eye"></i></div><h3><?= e(__('about.vision_title')) ?></h3><p><?= e(__('about.vision_text')) ?></p></div>
      <div class="icard"><div class="bi"><i class="bi bi-heart"></i></div><h3><?= e(__('about.values_title')) ?></h3><p><?= e(__('about.values_text')) ?></p></div>
    </div>
  </div>
</section>

<!-- Diferenciais -->
<section class="sec">
  <div class="w">
    <div class="eyebrow"><?= e(__('about.why_tag')) ?></div>
    <h2 class="t2"><?= e(__('about.why_title')) ?></h2>
    <div class="cards cols-4">
      <div class="icard"><div class="bi"><i class="bi bi-shield-lock"></i></div><h3><?= e(__('about.security_title')) ?></h3><p><?= e(__('about.security_text')) ?></p></div>
      <div class="icard"><div class="bi"><i class="bi bi-speedometer2"></i></div><h3><?= e(__('about.performance_title')) ?></h3><p><?= e(__('about.performance_text')) ?></p></div>
      <div class="icard"><div class="bi"><i class="bi bi-headset"></i></div><h3><?= e(__('about.support_title')) ?></h3><p><?= e(__('about.support_text')) ?></p></div>
      <div class="icard"><div class="bi"><i class="bi bi-graph-up-arrow"></i></div><h3><?= e(__('about.results_title')) ?></h3><p><?= e(__('about.results_text')) ?></p></div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="final">
  <div class="w">
    <h2 class="t2"><?= e(__('about.cta_title')) ?></h2>
    <p class="l3"><?= e(__('about.cta_subtitle')) ?></p>
    <div class="btn-row center">
      <a class="btn2 btn2--primary" href="<?= url('contato') ?>"><?= __('about.cta_button') ?></a>
    </div>
  </div>
</section>
