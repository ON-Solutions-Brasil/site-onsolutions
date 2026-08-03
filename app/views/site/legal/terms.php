<section class="page-hero">
    <div class="container"><h1><?= __('legal.terms_title') ?></h1></div>
</section>

<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="content-body">
                    <p><strong>Última atualização:</strong> <?= date('d/m/Y') ?></p>

                    <h2>1. Aceitação dos Termos</h2>
                    <p>Ao acessar e utilizar o site da <?= e(SITE_NAME) ?>, você concorda com estes Termos de Uso. Se não concordar com qualquer parte destes termos, não utilize nosso site.</p>

                    <h2>2. Serviços</h2>
                    <p>A <?= e(SITE_NAME) ?> oferece serviços de desenvolvimento de software sob medida, integrações, automações e consultoria tecnológica. Os termos específicos de cada serviço são definidos em contrato individual.</p>

                    <h2>3. Propriedade Intelectual</h2>
                    <p>Todo o conteúdo do site, incluindo textos, imagens, código-fonte, logotipos e design, é propriedade da <?= e(SITE_NAME) ?> ou de seus licenciadores. É proibida a reprodução sem autorização prévia.</p>

                    <h2>4. Uso Aceitável</h2>
                    <p>Ao utilizar nosso site, você concorda em:</p>
                    <ul>
                        <li>Não tentar acessar áreas restritas sem autorização</li>
                        <li>Não utilizar o site para atividades ilegais</li>
                        <li>Não interferir no funcionamento do site</li>
                        <li>Fornecer informações verdadeiras nos formulários</li>
                    </ul>

                    <h2>5. Limitação de Responsabilidade</h2>
                    <p>A <?= e(SITE_NAME) ?> não se responsabiliza por danos indiretos decorrentes do uso do site. As informações são fornecidas "como estão" e podem ser alteradas sem aviso prévio.</p>

                    <h2>6. Orçamentos e Propostas</h2>
                    <p>Orçamentos apresentados pelo site têm caráter informativo. Valores e prazos definitivos são estabelecidos em proposta comercial formal.</p>

                    <h2>7. Modificações</h2>
                    <p>Reservamo-nos o direito de alterar estes termos a qualquer momento. Alterações entram em vigor após publicação no site.</p>

                    <h2>8. Legislação Aplicável</h2>
                    <p>Estes termos são regidos pelas leis da República Federativa do Brasil.</p>

                    <h2>9. Contato</h2>
                    <p>Email: <?= e(setting('email', 'contato@onsolutions.com.br')) ?></p>
                </div>
            </div>
        </div>
    </div>
</section>
