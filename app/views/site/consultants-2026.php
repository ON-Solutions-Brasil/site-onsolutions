<?php
/**
 * Consultores — Tema 2026 (Fase C). Usa $consultants do banco (type consultant/reseller).
 * Observação: a view antiga (site/consultants.php) não existia; aqui apresentamos
 * os mesmos dados do controller no tema novo.
 */
?>
<section class="hero compact">
  <div class="w">
    <nav class="crumb" aria-label="breadcrumb">
      <a href="<?= url('/') ?>"><?= __('menu.home') ?></a><i>/</i><span><?= __('partners.consultants_title') ?></span>
    </nav>
    <h1 class="h"><?= __('partners.consultants_title') ?></h1>
    <p class="sub">Profissionais e revendas que levam as soluções da ON Solutions a mais empresas.</p>
  </div>
</section>

<section class="sec">
  <div class="w">
    <?php if (!empty($consultants)): ?>
    <div class="cards cols-3">
      <?php foreach ($consultants as $c): ?>
      <div class="partner-card">
        <div class="partner-card__head">
          <?php if (!empty($c['logo'])): ?>
          <img class="partner-card__logo" src="<?= e($c['logo']) ?>" alt="<?= e($c['name']) ?>" loading="lazy">
          <?php else: ?>
          <div class="partner-card__ph"><i class="bi bi-person-badge"></i></div>
          <?php endif; ?>
          <div>
            <h3><?= e($c['name']) ?></h3>
            <span class="tag"><?= e($c['type'] === 'reseller' ? 'Revenda' : 'Consultor') ?></span>
          </div>
        </div>
        <p><?= e($c['description_pt'] ?? '') ?></p>
        <?php if (!empty($c['website'])): ?>
        <a class="lnk" href="<?= e($c['website']) ?>" target="_blank" rel="noopener">Visitar site <i class="bi bi-arrow-right"></i></a>
        <?php endif; ?>
      </div>
      <?php endforeach; ?>
    </div>
    <?php else: ?>
    <div class="empty">
      <h2 class="t2">Em breve</h2>
      <p class="lead2" style="margin-inline:auto">Nossa rede de consultores e revendas está sendo ampliada.</p>
    </div>
    <?php endif; ?>
  </div>
</section>

<section class="final">
  <div class="w">
    <h2 class="t2">Quer se tornar um consultor ON Solutions?</h2>
    <p class="l3">Fale com a gente e conheça o programa de parcerias.</p>
    <div class="btn-row center"><a class="btn2 btn2--primary" href="<?= url('contato') ?>">Fale Conosco</a></div>
  </div>
</section>
