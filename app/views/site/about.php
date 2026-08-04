<!-- Page Hero -->
<section class="page-hero page-hero--about">
    <div class="container text-center">
        <span class="page-hero__tag">Quem Somos</span>
        <h1>Somos a <?= e(SITE_NAME) ?></h1>
        <p>Uma empresa apaixonada por tecnologia, focada em entregar soluções digitais que realmente transformam negócios.</p>
    </div>
</section>

<!-- Nossa História -->
<section class="section about-history">
    <div class="container">
        <div class="row align-items-center gy-5">
            <div class="col-lg-6">
                <div class="about-history__content">
                    <span class="about-label">Nossa História</span>
                    <h2 class="about-heading">Do código à transformação digital</h2>
                    <p>A <?= e(SITE_NAME) ?> nasceu da paixão por resolver problemas reais com tecnologia. Começamos com desenvolvimento de sistemas sob medida e rapidamente expandimos para integrações, automações e inteligência artificial.</p>
                    <p>Hoje, somos parceiros estratégicos de empresas que buscam não apenas presença online, mas resultados mensuráveis e crescimento sustentável.</p>
                    <p>Cada projeto que entregamos carrega nosso compromisso com qualidade, performance e inovação.</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-history__visual">
                    <div class="about-experience-card">
                        <div class="about-experience-card__icon">
                            <i class="bi bi-code-slash"></i>
                        </div>
                        <div class="about-experience-card__number">+5 Anos</div>
                        <div class="about-experience-card__text">de Experiência</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pilares -->
<section class="section about-pillars">
    <div class="container">
        <div class="section-header text-center">
            <span class="about-label about-label--center">Nossos Pilares</span>
            <h2 class="section-title">O que nos move</h2>
        </div>
        <div class="row g-4 mt-3">
            <div class="col-lg-4">
                <div class="about-pillar">
                    <div class="about-pillar__icon"><i class="bi bi-bullseye"></i></div>
                    <h4 class="about-pillar__title">Missão</h4>
                    <p class="about-pillar__text">Transformar negócios através de soluções digitais inovadoras e de altíssima qualidade, gerando resultados reais e mensuráveis para nossos clientes.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="about-pillar">
                    <div class="about-pillar__icon"><i class="bi bi-eye"></i></div>
                    <h4 class="about-pillar__title">Visão</h4>
                    <p class="about-pillar__text">Ser referência em desenvolvimento de software sob medida, reconhecida pela excelência técnica e pelo impacto positivo nos negócios que atendemos.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="about-pillar">
                    <div class="about-pillar__icon"><i class="bi bi-heart"></i></div>
                    <h4 class="about-pillar__title">Valores</h4>
                    <p class="about-pillar__text">Transparência total, compromisso com resultados, inovação contínua, qualidade sem concessões e foco absoluto na experiência do cliente.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Diferenciais -->
<section class="section about-diff">
    <div class="container">
        <div class="section-header text-center">
            <span class="about-label about-label--center">Por que nós?</span>
            <h2 class="section-title">Diferenciais que fazem a diferença</h2>
        </div>
        <div class="row g-4 mt-3">
            <div class="col-md-6 col-lg-3">
                <div class="about-diff__card">
                    <div class="about-diff__icon"><i class="bi bi-shield-lock"></i></div>
                    <h4 class="about-diff__title">Segurança</h4>
                    <p class="about-diff__text">Proteção total com criptografia, autenticação avançada e monitoramento contínuo.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="about-diff__card">
                    <div class="about-diff__icon"><i class="bi bi-speedometer2"></i></div>
                    <h4 class="about-diff__title">Performance</h4>
                    <p class="about-diff__text">Arquitetura otimizada para velocidade e escalabilidade em qualquer cenário.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="about-diff__card">
                    <div class="about-diff__icon"><i class="bi bi-headset"></i></div>
                    <h4 class="about-diff__title">Suporte Premium</h4>
                    <p class="about-diff__text">Atendimento humano e dedicado. Sua demanda resolvida com agilidade.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="about-diff__card">
                    <div class="about-diff__icon"><i class="bi bi-graph-up-arrow"></i></div>
                    <h4 class="about-diff__title">Resultados</h4>
                    <p class="about-diff__text">Foco em métricas reais: conversão, eficiência e ROI para seu negócio.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="section cta-section">
    <div class="container text-center">
        <h2>Vamos construir algo incrível juntos?</h2>
        <p>Conte para nós o que você precisa. A primeira conversa é por nossa conta.</p>
        <div class="d-flex gap-3 justify-content-center flex-wrap mt-4">
            <a href="<?= url('contato') ?>" class="btn btn-primary btn-lg">Fale com Nossa Equipe</a>
        </div>
    </div>
</section>
