<section class="page-hero">
    <div class="container"><h1><?= __('legal.cookies_title') ?></h1></div>
</section>

<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="content-body">
                    <p><strong>Última atualização:</strong> <?= date('d/m/Y') ?></p>

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
                    <p>Email: <?= e(setting('email', 'contato@onsolutions.com.br')) ?></p>
                </div>
            </div>
        </div>
    </div>
</section>
