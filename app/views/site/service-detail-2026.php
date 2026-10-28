<?php
/**
 * Detalhe do Serviço — Tema 2026, fiel à referência (docs/referencia/home-ref.html).
 * Estrutura fixa: hero + painel antes/depois, "Você se reconhece?", "O que você
 * ganha" (bens), "Quem confia na ON" (stats + marquee de clientes), "Como
 * funciona" (trilha única de 4 passos), FAQ, "Veja também" e CTA final.
 *
 * Fonte de verdade do conteúdo por serviço: App\Services\ServiceContent2026
 * ($sc2026), preparado no controller. Os dados reais do banco ($service) são
 * preservados para título/SEO; os blocos estruturados seguem a referência.
 */
$lang = defined('CURRENT_LANG') ? CURRENT_LANG : 'pt';
$title = $service["title_{$lang}"] ?? $service['title_pt'];

$sc = $sc2026 ?? null;

// Fallbacks seguros quando um serviço não estiver no mapa da referência:
// usa o short_description do banco e listas vazias (seções somem sozinhas).
$heroTitle = $sc['hero_title'] ?? e($title);
$heroSub   = $sc['hero_sub'] ?? ($service["short_description_{$lang}"] ?? $service['short_description_pt'] ?? '');
$segWith   = $sc['seg_with'] ?? __('home2026.seg_with');
$before    = $sc['before'] ?? [];
$after     = $sc['after'] ?? [];
$pains     = $sc['pains'] ?? [];
$bens      = $sc['bens'] ?? [];
$faqs      = $sc['faqs'] ?? [];
$finalTitle= $sc['final_title'] ?? __('home2026.final_title');
$related   = $related_services ?? [];

// Ícones fixos dos benefícios (6 posições), idênticos à referência.
$benIcons = [
    '<path d="M13 3L5 13.5h6L10 21l8-10.5h-6z"/>',
    '<path d="M12 3l9 5-9 5-9-5z"/><path d="M3 13l9 5 9-5"/>',
    '<path d="M12 3l7 3v5c0 4.5-3 8-7 10-4-2-7-5.5-7-10V6z"/>',
    '<path d="M10 14a4 4 0 005.6 0l3-3a4 4 0 00-5.6-5.6l-1 1"/><path d="M14 10a4 4 0 00-5.6 0l-3 3a4 4 0 005.6 5.6l1-1"/>',
    '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>',
    '<circle cx="12" cy="12" r="9"/><path d="M8 12.5l2.7 2.7L16 9.5"/>',
];
$arrow = '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M9 5l7 7-7 7"/></svg>';
$check = '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12.5l4.5 4.5L19 7.5"/></svg>';
?>
<!-- Hero + painel antes/depois -->
<section class="hero">
  <div class="w hero-grid">
    <div>
      <nav class="crumb" aria-label="breadcrumb">
        <a href="<?= url('/') ?>"><?= __('menu.home') ?></a><i>/</i>
        <a href="<?= url('servicos') ?>"><?= __('services.title') ?></a><i>/</i>
        <span><?= e($title) ?></span>
      </nav>
      <h1 class="h"><?= $heroTitle /* contém <mark> da fonte de verdade */ ?></h1>
      <?php if ($heroSub): ?><p class="sub"><?= e($heroSub) ?></p><?php endif; ?>
      <div class="trust">
        <span><?= e(__('home2026.trust_1')) ?></span>
        <span><?= e(__('home2026.trust_2')) ?></span>
        <span><?= e(__('home2026.trust_3')) ?></span>
      </div>
    </div>
    <?php if ($before || $after): ?>
    <div class="panel" data-toggle aria-label="<?= e(__('home2026.sd_beforeafter_label')) ?>">
      <div class="seg" role="group" aria-label="<?= e(__('home2026.sd_choose_view')) ?>">
        <button type="button" data-t="a" aria-pressed="true"><?= e(__('home2026.sd_seg_today')) ?></button>
        <button type="button" data-t="b" aria-pressed="false"><?= e($segWith) ?></button>
      </div>
      <ul class="plist bad" data-p="a">
        <?php foreach ($before as $item): ?>
        <li><span><?= e($item) ?></span></li>
        <?php endforeach; ?>
      </ul>
      <ul class="plist ok" data-p="b" hidden>
        <?php foreach ($after as $item): ?>
        <li><span><?= e($item) ?></span></li>
        <?php endforeach; ?>
      </ul>
    </div>
    <?php endif; ?>
  </div>
</section>

<!-- Você se reconhece? -->
<?php if ($pains): ?>
<section class="sec" id="voce-se-identifica">
  <div class="w">
    <div class="eyebrow"><?= e(__('home2026.sd_recognize_eyebrow')) ?></div>
    <h2 class="t2"><?= e(__('home2026.sd_recognize_title')) ?></h2>
    <p class="lead2"><?= e(__('home2026.sd_recognize_lead')) ?></p>
    <div class="pains" role="group" aria-label="<?= e(__('home2026.pains_label')) ?>">
      <?php foreach ($pains as $p): ?>
      <button type="button" class="pain" aria-pressed="false" data-q="<?= e($p) ?>">
        <span class="qt"><?= e($p) ?></span>
        <span class="ck"><?= $check ?></span>
      </button>
      <?php endforeach; ?>
    </div>
    <p class="pains-hint" aria-live="polite" data-hint
       data-hint-one="<?= e(__('home2026.pains_hint_one')) ?>"
       data-hint-many="<?= e(__('home2026.pains_hint_many')) ?>"
       data-label-one="<?= e(__('home2026.wa_label_one')) ?>"
       data-label-many="<?= e(__('home2026.wa_label_many')) ?>"></p>
  </div>
</section>
<?php endif; ?>

<!-- O que você ganha -->
<?php if ($bens): ?>
<section class="sec sec-w" id="o-que-voce-ganha">
  <div class="w">
    <div class="eyebrow"><?= e(__('home2026.sd_gains_eyebrow')) ?></div>
    <h2 class="t2"><?= e(__('home2026.sd_gains_title')) ?></h2>
    <div class="bens">
      <?php foreach ($bens as $i => $b): ?>
      <div class="ben">
        <div class="bi"><svg viewBox="0 0 24 24" aria-hidden="true"><?= $benIcons[$i % count($benIcons)] ?></svg></div>
        <h3><?= e($b['t']) ?></h3>
        <p><?= e($b['d']) ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- Quem confia na ON (stats + marquee) -->
<section class="sec dark grad" id="caso">
  <div class="w">
    <div class="eyebrow"><?= e(__('home2026.sd_trust_eyebrow')) ?></div>
    <h2 class="t2"><?= e(__('home2026.sd_trust_title')) ?></h2>
    <div class="stats">
      <div class="stat"><b>100+</b><span><?= e(__('home2026.stat_projects')) ?></span></div>
      <div class="stat"><b>50+</b><span><?= e(__('home2026.stat_clients')) ?></span></div>
      <div class="stat wide"><b><?= e(__('home2026.stat_reach')) ?></b><span><?= e(__('home2026.stat_reach_desc')) ?></span></div>
    </div>
  </div>
  <div class="marq" data-marquee aria-label="<?= e(__('home2026.clients_label')) ?>">
    <div class="track" data-track>
      <?php foreach (($home2026_clients ?? []) as $cl): ?>
      <div class="cs">
        <div class="lp">
          <?php if (!empty($cl['logo'])): ?>
          <img src="<?= e($cl['logo']) ?>" alt="<?= e($cl['name']) ?>" loading="lazy">
          <?php else: ?>
          <span class="wm"><?= e($cl['name']) ?></span>
          <?php endif; ?>
        </div>
        <h3><?= e($cl['title']) ?></h3>
        <?php if (!empty($cl['segment'])): ?><span class="tg"><?= e($cl['segment']) ?></span><?php endif; ?>
        <?php if (!empty($cl['desc'])): ?><p><?= e($cl['desc']) ?></p><?php endif; ?>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Como funciona (trilha única) -->
<section class="sec" id="como-funciona">
  <div class="w">
    <div class="eyebrow"><?= e(__('home2026.sd_how_eyebrow')) ?></div>
    <h2 class="t2"><?= e(__('home2026.sd_how_title')) ?></h2>
    <p class="lead2"><?= e(__('home2026.sd_how_lead')) ?></p>
    <div class="tracks" style="grid-template-columns:1fr;max-width:640px">
      <div class="tr">
        <div class="tl">
          <div class="s"><span class="n">1</span><b><?= e(__('home2026.sd_how_s1_t')) ?></b><p><?= e(__('home2026.sd_how_s1_d')) ?></p></div>
          <div class="s"><span class="n">2</span><b><?= e(__('home2026.sd_how_s2_t')) ?></b><p><?= e(__('home2026.sd_how_s2_d')) ?></p></div>
          <div class="s"><span class="n">3</span><b><?= e(__('home2026.sd_how_s3_t')) ?></b><p><?= e(__('home2026.sd_how_s3_d')) ?></p></div>
          <div class="s"><span class="n">4</span><b><?= e(__('home2026.sd_how_s4_t')) ?></b><p><?= e(__('home2026.sd_how_s4_d')) ?></p></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Dúvidas -->
<?php if ($faqs): ?>
<section class="sec" id="duvidas">
  <div class="w">
    <div class="eyebrow"><?= e(__('home2026.sd_faq_eyebrow')) ?></div>
    <h2 class="t2"><?= e(__('home2026.sd_faq_title')) ?></h2>
    <div class="faq">
      <?php foreach ($faqs as $i => $f): ?>
      <details <?= $i === 0 ? 'open' : '' ?>>
        <summary><?= e($f['q']) ?></summary>
        <p><?= e($f['a']) ?></p>
      </details>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- Veja também -->
<?php if ($related): ?>
<section class="sec sec-w" id="veja-tambem">
  <div class="w">
    <div class="eyebrow"><?= e(__('home2026.sd_also_eyebrow')) ?></div>
    <h2 class="t2"><?= e(__('home2026.sd_also_title')) ?></h2>
    <div class="sv-grid">
      <?php foreach ($related as $r):
        $rTitle = $r["title_{$lang}"] ?? $r['title_pt'];
        $rDesc  = $r["short_description_{$lang}"] ?? $r['short_description_pt'] ?? ''; ?>
      <a class="sv" href="<?= url('servicos/' . $r['slug']) ?>">
        <b><?= e($rTitle) ?></b>
        <span class="d"><?= e($rDesc) ?></span>
        <span class="go"><?= __('home2026.see_how') ?> <?= $arrow ?></span>
      </a>
      <?php endforeach; ?>
    </div>
    <div class="after-link">
      <a class="link" href="<?= url('servicos') ?>"><?= __('home2026.see_all_services') ?> <?= $arrow ?></a>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- CTA final -->
<section class="final" id="fale-com-a-on">
  <div class="w">
    <h2 class="t2"><?= e($finalTitle) ?></h2>
    <p class="l3"><?= e(__('home2026.sd_final_lead')) ?></p>
    <p class="nt"><?= e(__('home2026.sd_final_note')) ?></p>
  </div>
</section>
