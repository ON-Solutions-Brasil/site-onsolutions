<?php
/**
 * Parceiros — Tema 2026 (Fase C). Conteúdo preservado ($partners do banco); só visual.
 */
?>
<section class="hero compact">
  <div class="w">
    <nav class="crumb" aria-label="breadcrumb">
      <a href="<?= url('/') ?>"><?= __('menu.home') ?></a><i>/</i><span><?= __('partners.title') ?></span>
    </nav>
    <h1 class="h"><?= __('partners.title') ?></h1>
    <p class="sub">Alianças com empresas que compartilham nossa busca por excelência tecnológica e resultados extraordinários.</p>
  </div>
</section>

<!-- Por que parceiros -->
<section class="sec">
  <div class="w">
    <div class="split">
      <div>
        <div class="eyebrow">Por que parceiros?</div>
        <h2 class="t2">Juntos entregamos mais</h2>
        <p style="margin-top:18px">Acreditamos que as melhores soluções nascem da colaboração entre especialistas. Nossos parceiros são cuidadosamente selecionados para complementar nossas competências e garantir que cada projeto tenha o melhor time possível.</p>
        <p>Cada parceria é construída sobre confiança mútua, padrões elevados de qualidade e o compromisso de entregar resultados que superam expectativas.</p>
      </div>
      <div class="cards cols-2">
        <div class="icard"><div class="bi"><i class="bi bi-shield-check"></i></div><h3>Confiança</h3><p>Parceiros verificados e com histórico comprovado.</p></div>
        <div class="icard"><div class="bi"><i class="bi bi-trophy"></i></div><h3>Excelência</h3><p>Padrão premium em cada entrega conjunta.</p></div>
        <div class="icard"><div class="bi"><i class="bi bi-lightning-charge"></i></div><h3>Agilidade</h3><p>Times complementares, entregas mais rápidas.</p></div>
        <div class="icard"><div class="bi"><i class="bi bi-graph-up-arrow"></i></div><h3>Resultado</h3><p>Foco em gerar valor real para o cliente final.</p></div>
      </div>
    </div>
  </div>
</section>

<!-- Nossos parceiros -->
<section class="sec dark grad">
  <div class="w">
    <div class="eyebrow">Ecossistema</div>
    <h2 class="t2">Nossos Parceiros</h2>
    <p class="lead2">Empresas que fazem parte do nosso ecossistema de excelência</p>
    <?php if (!empty($partners)): ?>
    <div class="cards cols-2" style="margin-top:34px">
      <?php foreach ($partners as $partner): ?>
      <div class="partner-card">
        <div class="partner-card__head">
          <?php if (!empty($partner['logo'])): ?>
          <img class="partner-card__logo" src="<?= e($partner['logo']) ?>" alt="<?= e($partner['name']) ?>" loading="lazy">
          <?php else: ?>
          <div class="partner-card__ph"><i class="bi bi-building"></i></div>
          <?php endif; ?>
          <div>
            <h3><?= e($partner['name']) ?></h3>
            <span class="tag">Parceiro Estratégico</span>
          </div>
        </div>
        <p><?= e($partner['description_pt'] ?? '') ?></p>
        <?php if (!empty($partner['website'])): ?>
        <a class="lnk" href="<?= e($partner['website']) ?>" target="_blank" rel="noopener">Visitar site <i class="bi bi-arrow-right"></i></a>
        <?php endif; ?>
      </div>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>
  </div>
</section>

<!-- Torne-se parceiro -->
<section class="sec sec-w">
  <div class="w" style="text-align:center">
    <div class="eyebrow">Faça parte</div>
    <h2 class="t2">Torne-se um parceiro ON Solutions</h2>
    <p class="lead2" style="margin-inline:auto">Se sua empresa atua com tecnologia, design ou consultoria e busca parcerias de alto nível, queremos conhecer você. Juntos podemos criar soluções que fazem a diferença.</p>
    <div class="btn-row center">
      <a class="btn2 btn2--primary" href="<?= url('contato') ?>"><i class="bi bi-chat-dots"></i> Fale Conosco</a>
      <?php if ($whatsapp = setting('whatsapp_number')): ?>
      <a class="btn2 btn2--ghost" href="https://wa.me/<?= preg_replace('/\D/', '', $whatsapp) ?>?text=<?= urlencode('Olá! Gostaria de saber mais sobre parcerias com a ON Solutions.') ?>" target="_blank" rel="noopener"><i class="bi bi-whatsapp"></i> WhatsApp</a>
      <?php endif; ?>
    </div>
  </div>
</section>

<section class="final">
  <div class="w">
    <h2 class="t2">Pronto para transformar seu negócio?</h2>
    <p class="l3">Conheça nossos serviços e descubra como podemos ajudar.</p>
    <div class="btn-row center"><a class="btn2 btn2--primary" href="<?= url('servicos') ?>">Ver Serviços</a></div>
  </div>
</section>
