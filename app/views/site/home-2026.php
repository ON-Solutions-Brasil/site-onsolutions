<?php
/**
 * Home — Tema 2026 (Fase A).
 * Estrutura portada de docs/referencia/home-ref.html.
 * Textos via i18n (home2026.*). Dados dinâmicos (FAQs, parceiros) preservados do banco.
 */
$lang = defined('CURRENT_LANG') ? CURRENT_LANG : 'pt';

/** Dores do checklist (base: referência). */
$pains = $home2026_pains ?? [];

/** Cards "o que resolvemos" por aba — ligados a serviços reais. */
$solveSell = $home2026_solve_sell ?? [];
$solveOps  = $home2026_solve_ops ?? [];

/** FAQs: usa banco quando disponível, senão cai nos textos da referência (i18n). */
$faqItems = [];
if (!empty($faqs)) {
    foreach ($faqs as $f) {
        $q = $f["question_{$lang}"] ?? $f['question_pt'] ?? '';
        $a = $f["answer_{$lang}"] ?? $f['answer_pt'] ?? '';
        if ($q !== '') $faqItems[] = ['q' => $q, 'a' => $a];
    }
}
if (empty($faqItems)) {
    $faqItems = $home2026_faqs ?? [];
}

/**
 * Clientes/parceiros da seção "Quem confia na ON".
 * Usa parceiros reais do banco quando disponíveis; caso contrário, cai nos
 * placeholders i18n (logos oficiais a confirmar).
 */
/**
 * Cards da seção "Quem confia na ON". Fonte de verdade: os clientes da
 * referência ($home2026_clients, preparados no controller com logos reais).
 * Caso um dia a seção precise vir do banco, basta popular 'home_clients' —
 * mantemos o fallback para os clientes da referência quando vazio.
 */
$clientCards = [];
if (!empty($home_clients)) {
    foreach ($home_clients as $p) {
        $desc = $p["description_{$lang}"] ?? $p['description_pt'] ?? '';
        $clientCards[] = [
            'name'    => $p['name'] ?? '',
            'logo'    => $p['logo'] ?? '',
            'segment' => $p['segment'] ?? ($p['type'] ?? ''),
            'title'   => $p['name'] ?? '',
            'desc'    => $desc,
        ];
    }
}
if (empty($clientCards)) {
    $clientCards = $home2026_clients ?? [];
}
?>
<!-- Hero -->
<section class="hero">
  <div class="w hero-grid">
    <div>
      <span class="badge"><i></i><?= e(__('home2026.hero_badge')) ?></span>
      <h1 class="h"><?= __('home2026.hero_title') ?> <mark><?= e(__('home2026.hero_title_mark')) ?></mark></h1>
      <p class="sub"><?= e(__('home2026.hero_sub')) ?></p>
      <div class="trust">
        <span><?= e(__('home2026.trust_1')) ?></span>
        <span><?= e(__('home2026.trust_2')) ?></span>
        <span><?= e(__('home2026.trust_3')) ?></span>
      </div>
    </div>
    <div class="panel" data-toggle aria-label="<?= e(__('home2026.beforeafter_label')) ?>">
      <div class="seg" role="group" aria-label="<?= e(__('home2026.beforeafter_label')) ?>">
        <button type="button" data-t="a" aria-pressed="true"><?= e(__('home2026.seg_today')) ?></button>
        <button type="button" data-t="b" aria-pressed="false"><?= e(__('home2026.seg_with')) ?></button>
      </div>
      <ul class="plist bad" data-p="a">
        <?php foreach (($home2026_before ?? []) as $item): ?>
        <li><span><?= $item /* já contém <b> da tradução */ ?></span></li>
        <?php endforeach; ?>
      </ul>
      <ul class="plist ok" data-p="b" hidden>
        <?php foreach (($home2026_after ?? []) as $item): ?>
        <li><span><?= e($item) ?></span></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</section>

<!-- Prova / manifesto -->
<section class="sec dark" aria-label="<?= e(__('home2026.about_label')) ?>">
  <div class="w proof-grid">
    <div class="stats">
      <div class="stat"><b>100+</b><span><?= e(__('home2026.stat_projects')) ?></span></div>
      <div class="stat"><b>50+</b><span><?= e(__('home2026.stat_clients')) ?></span></div>
      <div class="stat wide"><b><?= e(__('home2026.stat_reach')) ?></b><span><?= e(__('home2026.stat_reach_desc')) ?></span></div>
    </div>
    <p class="manifesto"><?= e(__('home2026.manifesto')) ?><span><?= e(__('home2026.manifesto_sub')) ?></span></p>
  </div>
</section>

<!-- Você se reconhece? (checklist) -->
<section class="sec" id="voce-se-identifica">
  <div class="w">
    <div class="eyebrow"><?= e(__('home2026.recognize_eyebrow')) ?></div>
    <h2 class="t2"><?= e(__('home2026.recognize_title')) ?></h2>
    <p class="lead2"><?= e(__('home2026.recognize_lead')) ?></p>
    <div class="pains" role="group" aria-label="<?= e(__('home2026.pains_label')) ?>">
      <?php foreach ($pains as $p): ?>
      <button type="button" class="pain" aria-pressed="false" data-q="<?= e($p) ?>">
        <span class="qt"><?= e($p) ?></span>
        <span class="ck"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12.5l4.5 4.5L19 7.5"/></svg></span>
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

<!-- O que resolvemos -->
<section class="sec sec-w" id="problemas">
  <div class="w" data-tabs>
    <div class="eyebrow"><?= e(__('home2026.solve_eyebrow')) ?></div>
    <h2 class="t2"><?= e(__('home2026.solve_title')) ?></h2>
    <p class="lead2"><?= e(__('home2026.solve_lead')) ?></p>
    <div class="tabs" role="group" aria-label="<?= e(__('home2026.solve_tabs_label')) ?>">
      <button type="button" data-tab="v" aria-pressed="true"><?= e(__('home2026.solve_tab_sell')) ?></button>
      <button type="button" data-tab="o" aria-pressed="false"><?= e(__('home2026.solve_tab_ops')) ?></button>
    </div>

    <div class="mq-m" data-pane="v">
      <div class="mq-track">
        <?php foreach ($solveSell as $c): ?>
        <?php if (!empty($c['slug'])): ?>
        <a class="pk" href="<?= url('servicos/' . $c['slug']) ?>">
          <span class="q"><?= e($c['q']) ?></span>
          <span class="a"><?= e($c['a']) ?></span>
          <span class="f"><span><?= e($c['tag']) ?></span><span class="go"><?= __('home2026.see_how') ?> <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M9 5l7 7-7 7"/></svg></span></span>
        </a>
        <?php else: ?>
        <div class="pk">
          <span class="q"><?= e($c['q']) ?></span>
          <span class="a"><?= e($c['a']) ?></span>
          <span class="f"><span><?= e($c['tag']) ?></span></span>
        </div>
        <?php endif; ?>
        <?php endforeach; ?>
      </div>
    </div>

    <div class="mq-m" data-pane="o" hidden>
      <div class="mq-track">
        <?php foreach ($solveOps as $c): ?>
        <?php if (!empty($c['slug'])): ?>
        <a class="pk" href="<?= url('servicos/' . $c['slug']) ?>">
          <span class="q"><?= e($c['q']) ?></span>
          <span class="a"><?= e($c['a']) ?></span>
          <span class="f"><span><?= e($c['tag']) ?></span><span class="go"><?= __('home2026.see_how') ?> <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M9 5l7 7-7 7"/></svg></span></span>
        </a>
        <?php else: ?>
        <div class="pk">
          <span class="q"><?= e($c['q']) ?></span>
          <span class="a"><?= e($c['a']) ?></span>
          <span class="f"><span><?= e($c['tag']) ?></span></span>
        </div>
        <?php endif; ?>
        <?php endforeach; ?>
      </div>
    </div>

    <div class="after-link">
      <a class="link" href="<?= url('servicos') ?>"><?= __('home2026.see_all_services') ?> <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M9 5l7 7-7 7"/></svg></a>
    </div>
  </div>
</section>

<!-- Quem confia na ON (clientes) -->
<section class="sec dark grad" id="resultados">
  <div class="w">
    <div class="eyebrow"><?= e(__('home2026.clients_eyebrow')) ?></div>
    <h2 class="t2"><?= e(__('home2026.clients_title')) ?></h2>
  </div>
  <div class="marq" data-marquee aria-label="<?= e(__('home2026.clients_label')) ?>">
    <div class="track" data-track>
      <?php foreach ($clientCards as $cl): ?>
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

<!-- Calculadora -->
<section class="sec" id="calculadora">
  <div class="w calc">
    <div>
      <div class="eyebrow"><?= e(__('home2026.calc_eyebrow')) ?></div>
      <h2 class="t2"><?= e(__('home2026.calc_title')) ?></h2>
      <p class="lead2"><?= e(__('home2026.calc_lead')) ?></p>
    </div>
    <div class="calc-card" data-calc
         data-l-sale-one="<?= e(__('home2026.calc_sale_one')) ?>"
         data-l-sale-many="<?= e(__('home2026.calc_sale_many')) ?>"
         data-l-fill="<?= e(__('home2026.calc_fill')) ?>"
         data-l-txt="<?= e(__('home2026.calc_txt')) ?>"
         data-l-msg="<?= e(__('home2026.calc_msg')) ?>">
      <div class="calc-row">
        <label><?= e(__('home2026.calc_price')) ?><input type="number" data-c="ticket" min="0" step="100" value="5000" inputmode="numeric"></label>
        <label><?= e(__('home2026.calc_margin')) ?><input type="number" data-c="margem" min="1" max="100" step="1" value="50" inputmode="numeric"></label>
      </div>
      <label><?= e(__('home2026.calc_invest')) ?><input type="number" data-c="invest" min="0" step="500" value="10000" inputmode="numeric"></label>
      <div class="calc-out" aria-live="polite"><b data-c="out"></b><p data-c="txt"></p></div>
      <p class="calc-hint"><?= e(__('home2026.calc_hint')) ?></p>
    </div>
  </div>
</section>

<!-- Como funciona -->
<section class="sec sec-w" id="como-funciona">
  <div class="w">
    <div class="eyebrow"><?= e(__('home2026.how_eyebrow')) ?></div>
    <h2 class="t2"><?= e(__('home2026.how_title')) ?></h2>
    <p class="lead2"><?= e(__('home2026.how_lead')) ?></p>
    <div class="tracks">
      <div class="tr">
        <h3><?= e(__('home2026.track_sell_title')) ?></h3>
        <div class="tl">
          <?php foreach (($home2026_track_sell ?? []) as $n => $step): ?>
          <div class="s"><span class="n"><?= $n + 1 ?></span><b><?= e($step['t']) ?></b><p><?= e($step['d']) ?></p></div>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="tr alt">
        <h3><?= e(__('home2026.track_ops_title')) ?></h3>
        <div class="tl">
          <?php foreach (($home2026_track_ops ?? []) as $n => $step): ?>
          <div class="s"><span class="n"><?= $n + 1 ?></span><b><?= e($step['t']) ?></b><p><?= e($step['d']) ?></p></div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Dúvidas / FAQ -->
<section class="sec" id="duvidas">
  <div class="w">
    <div class="eyebrow"><?= e(__('home2026.faq_eyebrow')) ?></div>
    <h2 class="t2"><?= e(__('home2026.faq_title')) ?></h2>
    <div class="faq">
      <?php foreach ($faqItems as $i => $item): ?>
      <details <?= $i === 0 ? 'open' : '' ?>>
        <summary><?= e($item['q']) ?></summary>
        <p><?= e($item['a']) ?></p>
      </details>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- CTA final -->
<section class="final" id="fale-com-a-on">
  <div class="w">
    <h2 class="t2"><?= e(__('home2026.final_title')) ?></h2>
    <p class="l3"><?= e(__('home2026.final_lead')) ?></p>
    <p class="nt"><?= e(__('home2026.final_note')) ?></p>
  </div>
</section>
