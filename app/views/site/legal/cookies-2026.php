<?php
/**
 * Política de Cookies — Tema 2026 (Fase C). Conteúdo preservado; só visual.
 */
?>
<section class="hero compact">
  <div class="w">
    <nav class="crumb" aria-label="breadcrumb">
      <a href="<?= url('/') ?>"><?= __('menu.home') ?></a><i>/</i><span><?= __('legal.cookies_title') ?></span>
    </nav>
    <h1 class="h"><?= __('legal.cookies_title') ?></h1>
    <p class="sub">Como utilizamos cookies para melhorar sua experiência.</p>
  </div>
</section>

<section class="sec">
  <div class="w">
    <div class="legal">
      <span class="upd"><i class="bi bi-calendar3"></i> Última atualização: <?= date('d/m/Y') ?></span>

      <h2>1. O que são Cookies?</h2>
      <p>Cookies são pequenos arquivos de texto armazenados no seu dispositivo quando você visita nosso site. Eles ajudam a melhorar sua experiência de navegação.</p>

      <h2>2. Cookies que Utilizamos</h2>
      <h3>Cookies Necessários</h3>
      <p>Essenciais para o funcionamento do site (sessão, segurança CSRF).</p>
      <h3>Cookies de Análise</h3>
      <p>Google Analytics para entender como o site é utilizado (anonimizados).</p>
      <h3>Cookies de Marketing</h3>
      <p>Meta Pixel e Google Tag Manager para medir campanhas.</p>
      <h3>Cookies de Preferência</h3>
      <p>Armazenam suas preferências (idioma, consentimento de cookies).</p>

      <h2>3. Como Gerenciar Cookies</h2>
      <p>Você pode configurar seu navegador para recusar cookies ou alertá-lo quando cookies estão sendo enviados. Note que desativar cookies pode afetar a funcionalidade do site.</p>

      <h2>4. Contato</h2>
      <p>Email: <a href="mailto:<?= e(setting('email', 'contato@onsolutions.com.br')) ?>"><?= e(setting('email', 'contato@onsolutions.com.br')) ?></a></p>
    </div>
  </div>
</section>
