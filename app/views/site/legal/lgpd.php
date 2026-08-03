<section class="page-hero">
    <div class="container"><h1>LGPD - Lei Geral de Proteção de Dados</h1></div>
</section>

<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="content-body">
                    <p><strong>Última atualização:</strong> <?= date('d/m/Y') ?></p>

                    <h2>Compromisso com a LGPD</h2>
                    <p>A <?= e(SITE_NAME) ?> está comprometida com a Lei Geral de Proteção de Dados (Lei nº 13.709/2018). Tratamos seus dados pessoais com transparência, segurança e responsabilidade.</p>

                    <h2>Controlador de Dados</h2>
                    <p><strong><?= e(SITE_NAME) ?></strong><br>Email: <?= e(setting('email', '')) ?><br>Endereço: <?= e(setting('address', '')) ?></p>

                    <h2>Bases Legais para Tratamento</h2>
                    <ul>
                        <li><strong>Consentimento:</strong> Newsletter, cookies de marketing</li>
                        <li><strong>Execução de contrato:</strong> Prestação de serviços contratados</li>
                        <li><strong>Interesse legítimo:</strong> Análises de uso, melhoria dos serviços</li>
                        <li><strong>Obrigação legal:</strong> Cumprimento de legislação fiscal e tributária</li>
                    </ul>

                    <h2>Seus Direitos como Titular</h2>
                    <p>Conforme a LGPD, você possui os seguintes direitos:</p>
                    <ul>
                        <li>Confirmação da existência de tratamento</li>
                        <li>Acesso aos dados</li>
                        <li>Correção de dados incompletos ou desatualizados</li>
                        <li>Anonimização, bloqueio ou eliminação de dados desnecessários</li>
                        <li>Portabilidade dos dados</li>
                        <li>Eliminação dos dados tratados com consentimento</li>
                        <li>Informação sobre compartilhamento</li>
                        <li>Possibilidade de não fornecer consentimento e consequências</li>
                        <li>Revogação do consentimento</li>
                    </ul>

                    <h2>Como Exercer seus Direitos</h2>
                    <p>Para exercer qualquer um dos direitos listados acima, entre em contato conosco através do email: <a href="mailto:<?= e(setting('email', '')) ?>"><?= e(setting('email', '')) ?></a></p>
                    <p>Responderemos sua solicitação em até 15 dias úteis.</p>

                    <h2>Segurança</h2>
                    <p>Implementamos medidas de segurança técnicas e administrativas para proteger os dados pessoais, incluindo criptografia, controle de acesso, backups e monitoramento.</p>

                    <h2>Retenção de Dados</h2>
                    <p>Mantemos seus dados pessoais apenas pelo tempo necessário para as finalidades para as quais foram coletados, ou conforme exigido por lei.</p>
                </div>
            </div>
        </div>
    </div>
</section>
