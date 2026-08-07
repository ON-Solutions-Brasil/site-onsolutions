<!-- Hero -->
<section class="page-hero page-hero--about">
    <div class="container text-center">
        <span class="about-tag hero-fade-in">Legal</span>
        <h1 class="hero-fade-in"><?= __('legal.privacy_title') ?></h1>
        <p class="hero-fade-in">Transparência sobre como tratamos seus dados.</p>
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
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="section cta-section">
    <div class="container">
        <div class="cta-content text-center scroll-reveal">
            <h2 class="cta-title">Alguma dúvida?</h2>
            <p class="cta-subtitle">Entre em contato conosco para esclarecer qualquer questão sobre privacidade e dados.</p>
            <a href="<?= url('contato') ?>" class="btn btn-primary btn-lg">Fale Conosco</a>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var els = document.querySelectorAll('.scroll-reveal');
    var io = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                io.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });
    els.forEach(function(el) {
        var rect = el.getBoundingClientRect();
        if (rect.top < window.innerHeight) {
            el.classList.add('is-visible');
        } else {
            io.observe(el);
        }
    });
});
</script>
