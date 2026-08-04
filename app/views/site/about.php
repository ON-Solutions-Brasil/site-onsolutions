<section class="page-hero">
    <div class="container"><h1><?= __('about.title') ?></h1></div>
</section>

<section class="section">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <h2>Quem é a <strong><?= e(SITE_NAME) ?></strong></h2>
                <p class="lead">Somos uma empresa de tecnologia especializada em desenvolvimento de software sob medida, integrações entre plataformas e inteligência artificial.</p>
                <p>Nossa missão é transformar a operação de empresas por meio de soluções tecnológicas personalizadas, construídas para atender necessidades únicas que o mercado de software pronto não resolve.</p>
                <p>Trabalhamos com empresas de todos os portes, desde startups até grandes corporações, entregando sistemas robustos, escaláveis e preparados para crescer junto com o negócio.</p>
            </div>
            <div class="col-lg-6">
                <div class="about-values">
                    <div class="value-item"><div class="value-icon"><i class="bi bi-lightbulb"></i></div><div><h5>Inovação</h5><p>Utilizamos as tecnologias mais modernas para entregar soluções de ponta.</p></div></div>
                    <div class="value-item"><div class="value-icon"><i class="bi bi-shield-check"></i></div><div><h5>Qualidade</h5><p>Código limpo, testes rigorosos e entregas dentro do prazo.</p></div></div>
                    <div class="value-item"><div class="value-icon"><i class="bi bi-people"></i></div><div><h5>Parceria</h5><p>Trabalhamos lado a lado com nossos clientes em cada etapa.</p></div></div>
                    <div class="value-item"><div class="value-icon"><i class="bi bi-graph-up-arrow"></i></div><div><h5>Resultados</h5><p>Focamos em soluções que geram impacto real no negócio.</p></div></div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section bg-light">
    <div class="container">
        <div class="section-header text-center">
            <h2 class="section-title">Tecnologias que Dominamos</h2>
        </div>
        <div class="row g-3 mt-4 justify-content-center">
            <?php
            $techs = ['PHP', 'JavaScript', 'Python', 'Node.js', 'React', 'Vue.js', 'MySQL', 'PostgreSQL', 'MongoDB', 'Redis', 'Docker', 'AWS', 'API REST', 'GraphQL', 'Machine Learning', 'OpenAI', 'Laravel', 'WordPress'];
            foreach ($techs as $tech):
            ?>
            <div class="col-auto"><span class="badge tech-badge"><?= $tech ?></span></div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section cta-section">
    <div class="container text-center">
        <h2><?= __('home.cta_title') ?></h2>
        <p><?= __('home.cta_subtitle') ?></p>
        <a href="<?= url('contato') ?>" class="btn btn-primary btn-lg mt-3"><?= __('home.cta_button') ?></a>
    </div>
</section>
