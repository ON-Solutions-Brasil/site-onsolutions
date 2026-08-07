<!-- Hero -->
<section class="page-hero page-hero--about">
    <div class="container text-center">
        <span class="about-tag hero-fade-in">Legal</span>
        <h1 class="hero-fade-in"><?= __('legal.cookies_title') ?></h1>
        <p class="hero-fade-in">Como utilizamos cookies para melhorar sua experiência.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 scroll-reveal">
                <div class="legal-content">
                    <div class="legal-update-badge">
                        <i class="bi bi-calendar3"></i>
                        <span>Última atualização: <?= date('d/m/Y') ?></span>
                    </div>

                    <div class="content-body">
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
            </div>
        </div>
    </div>
</section>

<section class="section cta-section">
    <div class="container">
        <div class="cta-content text-center scroll-reveal">
            <h2 class="cta-title">Alguma dúvida?</h2>
            <p class="cta-subtitle">Entre em contato conosco para esclarecer qualquer questão.</p>
            <a href="<?= url('contato') ?>" class="btn btn-primary btn-lg">Fale Conosco</a>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var els = document.querySelectorAll('.scroll-reveal');
    var io = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) { if (entry.isIntersecting) { entry.target.classList.add('is-visible'); io.unobserve(entry.target); } });
    }, { threshold: 0.1 });
    els.forEach(function(el) { var r = el.getBoundingClientRect(); if (r.top < window.innerHeight) { el.classList.add('is-visible'); } else { io.observe(el); } });
});
</script>
