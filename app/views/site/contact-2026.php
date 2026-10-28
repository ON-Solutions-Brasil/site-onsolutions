<?php
/**
 * Contato — Tema 2026 (Fase C).
 * Formulário, CSRF, nomes de campos, action/método e AJAX preservados — só visual.
 */
?>
<section class="hero compact">
  <div class="w">
    <nav class="crumb" aria-label="breadcrumb">
      <a href="<?= url('/') ?>"><?= __('menu.home') ?></a><i>/</i><span><?= __('contact.title') ?></span>
    </nav>
    <h1 class="h"><?= e(__('contact.hero_title')) ?></h1>
    <p class="sub"><?= e(__('contact.hero_subtitle')) ?></p>
  </div>
</section>

<section class="sec">
  <div class="w">
    <div class="contact-grid">
      <!-- Formulário (funcional: mesma action/CSRF/campos) -->
      <div class="form-card">
        <h2 class="t2" style="font-size:24px;margin:0 0 20px"><?= e(__('contact.form_title')) ?></h2>
        <form method="POST" action="<?= url('contato') ?>" id="contactForm">
          <?= csrfField() ?>
          <div class="fgrid two">
            <div class="field">
              <label><?= __('contact.form_name') ?> *</label>
              <input type="text" name="name" required>
            </div>
            <div class="field">
              <label><?= __('contact.form_email') ?> *</label>
              <input type="email" name="email" required>
            </div>
            <div class="field">
              <label><?= __('contact.form_phone') ?></label>
              <input type="tel" name="phone">
            </div>
            <div class="field">
              <label><?= __('contact.form_company') ?></label>
              <input type="text" name="company">
            </div>
            <div class="field full">
              <label><?= __('contact.form_subject') ?></label>
              <input type="text" name="subject">
            </div>
            <div class="field full">
              <label><?= __('contact.form_message') ?> *</label>
              <textarea name="message" rows="5" required></textarea>
            </div>
            <div class="field full">
              <button type="submit" class="btn2 btn2--primary" id="contactSubmitBtn"><?= __('contact.form_submit') ?></button>
            </div>
          </div>
        </form>
        <div class="notice notice--ok" id="contactSuccessAlert" style="display:none;">
          <i class="bi bi-check-circle-fill"></i>
          <div>
            <strong><?= __('contact.message_sent') ?></strong>
            <p style="margin:2px 0 0;font-size:14px;opacity:.9"><?= __('contact.message_sent_desc') ?></p>
          </div>
        </div>
      </div>

      <!-- Informações -->
      <div>
        <h2 class="t2" style="font-size:24px;margin:0 0 20px"><?= e(__('contact.info_title')) ?></h2>
        <div class="info-list">
          <?php if ($email = setting('email')): ?>
          <div class="info-item"><div class="bi"><i class="bi bi-envelope"></i></div><div><strong><?= __('contact.info_email') ?></strong><p><a href="mailto:<?= e($email) ?>"><?= e($email) ?></a></p></div></div>
          <?php endif; ?>
          <?php if ($phone = setting('phone')): ?>
          <div class="info-item"><div class="bi"><i class="bi bi-telephone"></i></div><div><strong><?= __('contact.info_phone') ?></strong><p><?= e($phone) ?></p></div></div>
          <?php endif; ?>
          <?php if ($whatsapp = setting('whatsapp_number')): ?>
          <div class="info-item"><div class="bi"><i class="bi bi-whatsapp"></i></div><div><strong><?= __('contact.info_whatsapp') ?></strong><p><a href="https://wa.me/<?= preg_replace('/\D/', '', $whatsapp) ?>"><?= e($whatsapp) ?></a></p></div></div>
          <?php endif; ?>
          <?php if ($address = setting('address')): ?>
          <div class="info-item"><div class="bi"><i class="bi bi-geo-alt"></i></div><div><strong><?= __('contact.info_address') ?></strong><p><?= e($address) ?><br><?= e(setting('city', '')) ?> - <?= e(setting('state', '')) ?></p></div></div>
          <?php endif; ?>
        </div>

        <div class="schedule">
          <h4><i class="bi bi-clock"></i> <?= __('contact.schedule_title') ?></h4>
          <div class="row-i"><span><?= __('contact.schedule_weekdays') ?></span><strong>09h — 18h</strong></div>
          <div class="row-i"><span><?= __('contact.schedule_saturday') ?></span><strong>09h — 13h</strong></div>
          <div class="row-i"><span><?= __('contact.schedule_sunday') ?></span><strong><?= __('contact.schedule_closed') ?></strong></div>
        </div>

        <div class="schedule">
          <h4><i class="bi bi-lightning-charge"></i> <?= __('contact.response_title') ?></h4>
          <p style="margin:0;color:var(--soft);font-size:14.5px"><?= __('contact.response_text') ?></p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="final">
  <div class="w">
    <h2 class="t2"><?= e(__('contact.cta_title')) ?></h2>
    <p class="l3"><?= e(__('contact.cta_subtitle')) ?></p>
    <div class="btn-row center">
      <?php if ($whatsapp = setting('whatsapp_number')): ?>
      <a class="btn2 btn2--wa" href="https://wa.me/<?= preg_replace('/\D/', '', $whatsapp) ?>" target="_blank" rel="noopener"><i class="bi bi-whatsapp"></i> <?= __('contact.cta_whatsapp') ?></a>
      <?php else: ?>
      <a class="btn2 btn2--primary" href="mailto:<?= e(setting('email', '')) ?>"><?= __('contact.cta_email') ?></a>
      <?php endif; ?>
    </div>
  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var form = document.getElementById('contactForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            var btn = document.getElementById('contactSubmitBtn');
            btn.innerHTML = '<?= __('contact.form_sending') ?>';
            btn.disabled = true;
            var formData = new FormData(form);
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(function() {
                form.style.display = 'none';
                document.getElementById('contactSuccessAlert').style.display = 'flex';
            })
            .catch(function() {
                form.style.display = 'none';
                document.getElementById('contactSuccessAlert').style.display = 'flex';
            });
        });
    }
});
</script>
