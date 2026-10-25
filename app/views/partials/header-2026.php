<?php
/**
 * Header do Tema 2026 (Fase A).
 * Topbar escura + mega-menu de serviços + nav mobile.
 * WhatsApp vem de setting('whatsapp_number') / setting('whatsapp_message').
 */
$currentLang = defined('CURRENT_LANG') ? CURRENT_LANG : 'pt';
$waNumber = preg_replace('/\D/', '', (string) setting('whatsapp_number', ''));
$waMessage = (string) setting('whatsapp_message', __('home2026.wa_default'));
// Com número: link wa.me. Sem número: cai no formulário de contato levando a
// mensagem como parâmetro (?msg=), para não descartar o que o visitante preencheu.
$waHasNumber = $waNumber !== '';
$waContactUrl = url('contato');
$waHref = $waHasNumber
    ? ('https://wa.me/' . $waNumber . '?text=' . rawurlencode($waMessage))
    : ($waContactUrl . '?msg=' . rawurlencode($waMessage));

/** Serviços exibidos no mega-menu (slug => rótulo i18n). */
$menuServices = [
    'sistemas-web'             => __('services.web_systems'),
    'erp-personalizado'        => __('services.erp'),
    'crm'                      => __('services.crm'),
    'integracoes-apis'         => __('services.integrations'),
    'automacoes'               => __('services.automations'),
    'dashboards-bi'            => __('services.dashboards'),
    'aplicativos-mobile'       => __('services.mobile'),
    'saas'                     => __('services.saas'),
    'inteligencia-artificial'  => __('services.ai'),
    'chatbots'                 => __('services.chatbots'),
    'machine-learning'         => __('services.machine_learning'),
    'consultoria'              => __('services.consulting'),
    'performance'              => __('services.performance'),
    'infraestrutura'           => __('services.infrastructure'),
];
?>
<header class="top">
  <div class="w top-in">
    <a class="brand" href="<?= url('/') ?>" aria-label="<?= e(SITE_NAME) ?>">
      <?php if ($logo = setting('logo')): ?>
        <img src="<?= e($logo) ?>" alt="<?= e(SITE_NAME) ?>">
      <?php else: ?>
        <img src="<?= asset('img/favicon.png') ?>" alt="<?= e(SITE_NAME) ?>">
      <?php endif; ?>
      <span><?= e(SITE_NAME) ?></span>
    </a>

    <nav class="nav" aria-label="<?= e(__('home2026.nav_label')) ?>">
      <a href="<?= url('quem-somos') ?>"><?= __('menu.about') ?></a>
      <span class="dd">
        <button type="button" class="dd-btn" aria-expanded="false" aria-haspopup="true">
          <?= __('menu.services') ?>
          <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M6 9l6 6 6-6"/></svg>
        </button>
        <div class="mega" role="menu" hidden>
          <div class="w mega-in">
            <div class="mega-cols">
              <?php foreach ($menuServices as $slug => $label): ?>
              <a class="mi" role="menuitem" href="<?= url('servicos/' . $slug) ?>"><b><?= e($label) ?></b></a>
              <?php endforeach; ?>
            </div>
            <div class="mega-foot">
              <a href="<?= url('servicos') ?>"><?= __('menu.all_services') ?> &rarr;</a>
            </div>
          </div>
        </div>
      </span>
      <a href="<?= url('blog') ?>"><?= __('menu.blog') ?></a>
      <a href="<?= url('contato') ?>"><?= __('menu.contact') ?></a>
    </nav>

    <div class="top-r">
      <a class="top-btn" data-wa-main data-pos="topo"
         href="<?= e($waHref) ?>"
         data-wa-mode="<?= $waHasNumber ? 'whatsapp' : 'contact' ?>"
         data-wa-endpoint="<?= e($waHasNumber ? ('https://wa.me/' . $waNumber) : $waContactUrl) ?>"
         target="_blank" rel="noopener">
        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12.04 2a9.9 9.9 0 00-8.47 15l-1.3 4.73 4.85-1.27A9.9 9.9 0 1012.04 2zm0 1.8a8.1 8.1 0 11-4.13 15.07l-.3-.18-2.88.75.77-2.8-.19-.3A8.1 8.1 0 0112.04 3.8zm4.67 11.44c-.26-.13-1.5-.74-1.73-.82-.23-.09-.4-.13-.57.13-.17.26-.65.82-.8.99-.14.17-.29.19-.55.06-.26-.13-1.08-.4-2.06-1.27-.76-.68-1.28-1.52-1.43-1.78-.15-.26-.02-.4.11-.53.12-.12.26-.3.39-.46.13-.15.17-.26.26-.43.09-.17.04-.32-.02-.45-.06-.13-.57-1.38-.78-1.88-.2-.49-.41-.42-.57-.43h-.49c-.17 0-.44.06-.67.32-.23.26-.88.86-.88 2.1 0 1.24.9 2.43 1.03 2.6.13.17 1.77 2.7 4.3 3.79.6.26 1.07.41 1.44.52.6.19 1.15.16 1.58.1.48-.07 1.5-.61 1.71-1.2.21-.59.21-1.1.15-1.2-.06-.11-.23-.17-.49-.3z"/></svg>
        <?= __('home2026.cta_short') ?>
      </a>
      <button type="button" class="burger" aria-expanded="false" aria-controls="mnav" aria-label="<?= e(__('home2026.menu_label')) ?>">
        <span></span><span></span><span></span>
      </button>
    </div>
  </div>

  <!-- Nav mobile -->
  <nav class="mnav" id="mnav" hidden aria-label="<?= e(__('home2026.nav_label')) ?>">
    <a class="l" href="<?= url('quem-somos') ?>"><?= __('menu.about') ?></a>
    <details>
      <summary><?= __('menu.services') ?></summary>
      <?php foreach ($menuServices as $slug => $label): ?>
      <a class="si" href="<?= url('servicos/' . $slug) ?>"><b><?= e($label) ?></b></a>
      <?php endforeach; ?>
      <a class="si all" href="<?= url('servicos') ?>"><?= __('menu.all_services') ?> &rarr;</a>
    </details>
    <a class="l" href="<?= url('blog') ?>"><?= __('menu.blog') ?></a>
    <a class="l" href="<?= url('contato') ?>"><?= __('menu.contact') ?></a>
    <div class="g"><?= __('home2026.language') ?></div>
    <?php $currentPath = currentPathWithoutLang(); ?>
    <a class="si" href="<?= langUrl($currentPath, 'pt') ?>"><b>Português</b></a>
    <a class="si" href="<?= langUrl($currentPath, 'en') ?>"><b>English</b></a>
    <a class="si" href="<?= langUrl($currentPath, 'es') ?>"><b>Español</b></a>
  </nav>
</header>
