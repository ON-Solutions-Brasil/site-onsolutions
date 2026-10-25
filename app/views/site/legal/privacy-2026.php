<?php
/**
 * Política de Privacidade — Tema 2026 (Fase C). Conteúdo preservado; só visual.
 */
?>
<section class="hero compact">
  <div class="w">
    <nav class="crumb" aria-label="breadcrumb">
      <a href="<?= url('/') ?>"><?= __('menu.home') ?></a><i>/</i><span><?= __('legal.privacy_title') ?></span>
    </nav>
    <span class="badge"><i></i>Legal</span>
    <h1 class="h"><?= __('legal.privacy_title') ?></h1>
    <p class="sub">Transparência sobre como tratamos seus dados.</p>
  </div>
</section>

<section class="sec">
  <div class="w">
    <div class="legal">
      <span class="upd"><i class="bi bi-calendar3"></i> Última atualização: <?= date('d/m/Y') ?></span>

      <h2>1. Informações que Coletamos</h2>
      <p>A <?= e(SITE_NAME) ?> coleta informações pessoais que você nos fornece voluntariamente ao entrar em contato, assinar nossa newsletter, solicitar orçamentos ou utilizar nossos serviços. As informações podem incluir:</p>
      <ul>
        <li>Nome completo</li>
        <li>Endereço de email</li>
        <li>Número de telefone</li>
        <li>Nome da empresa</li>
        <li>Informações de projeto</li>
      </ul>

      <h2>2. Como Utilizamos suas Informações</h2>
      <p>Utilizamos as informações coletadas para:</p>
      <ul>
        <li>Responder às suas solicitações e mensagens</li>
        <li>Enviar orçamentos e propostas comerciais</li>
        <li>Enviar comunicações sobre nossos serviços (com consentimento)</li>
        <li>Melhorar nossos serviços e experiência do usuário</li>
        <li>Cumprir obrigações legais</li>
      </ul>

      <h2>3. Compartilhamento de Dados</h2>
      <p>Não vendemos, alugamos ou compartilhamos suas informações pessoais com terceiros para fins de marketing. Podemos compartilhar informações com:</p>
      <ul>
        <li>Prestadores de serviço que nos auxiliam na operação do negócio</li>
        <li>Autoridades legais, quando exigido por lei</li>
      </ul>

      <h2>4. Segurança dos Dados</h2>
      <p>Implementamos medidas técnicas e organizacionais para proteger suas informações contra acesso não autorizado, alteração, divulgação ou destruição.</p>

      <h2>5. Seus Direitos</h2>
      <p>Você tem o direito de:</p>
      <ul>
        <li>Acessar seus dados pessoais</li>
        <li>Solicitar correção de dados incorretos</li>
        <li>Solicitar exclusão de seus dados</li>
        <li>Revogar consentimento</li>
        <li>Solicitar portabilidade dos dados</li>
      </ul>

      <h2>6. Cookies</h2>
      <p>Utilizamos cookies para melhorar sua experiência em nosso site. Consulte nossa <a href="<?= url('politica-de-cookies') ?>">Política de Cookies</a> para mais informações.</p>

      <h2>7. Contato</h2>
      <p>Para dúvidas sobre esta política ou exercer seus direitos, entre em contato conosco pelo email: <a href="mailto:<?= e(setting('email', 'contato@onsolutions.com.br')) ?>"><?= e(setting('email', 'contato@onsolutions.com.br')) ?></a></p>
    </div>
  </div>
</section>
