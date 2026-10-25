<?php
/**
 * Footer do Tema 2026 (Fase A) + barra fixa de WhatsApp (fixbar).
 * WhatsApp vem de setting('whatsapp_number') / setting('whatsapp_message').
 */
$waNumber = preg_replace('/\D/', '', (string) setting('whatsapp_number', ''));
$waMessage = (string) setting('whatsapp_message', __('home2026.wa_default'));
// Com número: link wa.me. Sem número: cai no formulário de contato levando a
// mensagem como parâmetro (?msg=), para não descartar o que o visitante preencheu.
$waHasNumber = $waNumber !== '';
$waContactUrl = url('contato');
$waHref = $waHasNumber
    ? ('https://wa.me/' . $waNumber . '?text=' . rawurlencode($waMessage))
    : ($waContactUrl . '?msg=' . rawurlencode($waMessage));

$footerServices = [
    'erp-personalizado'       => __('services.erp'),
    'sistemas-web'            => __('services.web_systems'),
    'crm'                     => __('services.crm'),
    'automacoes'              => __('services.automations'),
    'inteligencia-artificial' => __('services.ai'),
    'consultoria'             => __('services.consulting'),
];
?>
<footer class="foot">
  <div class="w foot-top">
    <div>
      <div class="lg">
        <?php if ($logo = setting('logo')): ?>
          <img src="<?= e($logo) ?>" alt="<?= e(SITE_NAME) ?>">
        <?php else: ?>
          <img src="<?= asset('img/favicon.png') ?>" alt="<?= e(SITE_NAME) ?>">
        <?php endif; ?>
        <span><?= e(SITE_NAME) ?></span>
      </div>
      <p><?= __('footer.site_description') ?></p>
    </div>

    <div>
      <div class="foot-links">
        <a href="<?= url('quem-somos') ?>"><?= __('menu.about') ?></a>
        <a href="<?= url('servicos') ?>"><?= __('menu.all_services') ?></a>
        <a href="<?= url('blog') ?>"><?= __('menu.blog') ?></a>
        <a href="<?= url('contato') ?>"><?= __('menu.contact') ?></a>
        <a href="<?= url('politica-de-privacidade') ?>"><?= __('footer.privacy') ?></a>
        <a href="<?= url('lgpd') ?>"><?= __('legal.lgpd_title') ?></a>
      </div>
      <div class="fs">
        <div class="fs-t"><?= __('menu.services') ?></div>
        <div class="fs-g">
          <?php foreach ($footerServices as $slug => $label): ?>
          <a href="<?= url('servicos/' . $slug) ?>"><?= e($label) ?></a>
          <?php endforeach; ?>
        </div>
      </div>
    </div>

    <div>
      <?php if ($email = setting('email')): ?>
      <div><a href="mailto:<?= e($email) ?>"><?= e($email) ?></a></div>
      <?php endif; ?>
      <?php if ($waNumber): ?>
      <div><a href="<?= e($waHref) ?>" target="_blank" rel="noopener"><?= __('home2026.whatsapp') ?> <?= e(setting('whatsapp_number')) ?></a></div>
      <?php endif; ?>
      <div class="foot-links" style="margin-top:14px">
        <?php if ($ig = setting('social_instagram')): ?><a href="<?= e($ig) ?>" target="_blank" rel="noopener">Instagram</a><?php endif; ?>
        <?php if ($li = setting('social_linkedin')): ?><a href="<?= e($li) ?>" target="_blank" rel="noopener">LinkedIn</a><?php endif; ?>
        <?php if ($fb = setting('social_facebook')): ?><a href="<?= e($fb) ?>" target="_blank" rel="noopener">Facebook</a><?php endif; ?>
      </div>
    </div>
  </div>

  <div class="w" style="margin-top:28px;font-size:13px;color:#64748B">
    &copy; <?= date('Y') ?> <?= e(SITE_NAME) ?>. <?= __('footer.rights') ?>
  </div>
</footer>

<!-- Barra fixa de WhatsApp (recebe mensagem dinâmica via JS) -->
<div class="fixbar">
  <a class="cta" data-wa-main data-pos="fixo"
     href="<?= e($waHref) ?>"
     data-wa-mode="<?= $waHasNumber ? 'whatsapp' : 'contact' ?>"
     data-wa-endpoint="<?= e($waHasNumber ? ('https://wa.me/' . $waNumber) : $waContactUrl) ?>"
     target="_blank" rel="noopener" data-wa="<?= e($waMessage) ?>">
    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12.04 2a9.9 9.9 0 00-8.47 15l-1.3 4.73 4.85-1.27A9.9 9.9 0 1012.04 2zm0 1.8a8.1 8.1 0 11-4.13 15.07l-.3-.18-2.88.75.77-2.8-.19-.3A8.1 8.1 0 0112.04 3.8zm4.67 11.44c-.26-.13-1.5-.74-1.73-.82-.23-.09-.4-.13-.57.13-.17.26-.65.82-.8.99-.14.17-.29.19-.55.06-.26-.13-1.08-.4-2.06-1.27-.76-.68-1.28-1.52-1.43-1.78-.15-.26-.02-.4.11-.53.12-.12.26-.3.39-.46.13-.15.17-.26.26-.43.09-.17.04-.32-.02-.45-.06-.13-.57-1.38-.78-1.88-.2-.49-.41-.42-.57-.43h-.49c-.17 0-.44.06-.67.32-.23.26-.88.86-.88 2.1 0 1.24.9 2.43 1.03 2.6.13.17 1.77 2.7 4.3 3.79.6.26 1.07.41 1.44.52.6.19 1.15.16 1.58.1.48-.07 1.5-.61 1.71-1.2.21-.59.21-1.1.15-1.2-.06-.11-.23-.17-.49-.3z"/></svg>
    <span><?= __('home2026.cta_fixed') ?></span>
    <svg class="arr" viewBox="0 0 24 24" aria-hidden="true"><path d="M9 5l7 7-7 7"/></svg>
  </a>
</div>
