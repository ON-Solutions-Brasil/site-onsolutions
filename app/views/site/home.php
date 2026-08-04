<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-bg"></div>
    <div class="container">
        <div class="row align-items-center min-vh-100">
            <div class="col-lg-7">
                <div class="hero-content">
                    <h1 class="hero-title"><?= __('home.hero_title') ?></h1>
                    <p class="hero-subtitle"><?= __('home.hero_subtitle') ?></p>
                    <div class="hero-actions">
                        <a href="<?= url('contato') ?>" class="btn btn-primary btn-lg"><?= __('home.hero_cta') ?></a>
                        <a href="<?= url('portfolio') ?>" class="btn btn-outline-light btn-lg"><?= __('home.hero_secondary') ?></a>
                    </div>
                    <div class="hero-stats mt-5">
                        <div class="stat"><strong>100+</strong><span>Projetos Entregues</span></div>
                        <div class="stat"><strong>50+</strong><span>Clientes Ativos</span></div>
                        <div class="stat"><strong>99%</strong><span>Satisfação</span></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-block">
                <div class="hero-visual">
                    <div class="code-window">
                        <div class="code-header"><span></span><span></span><span></span></div>
                        <pre><code>&lt;solution&gt;
  personalizada
  escalável
  inteligente
&lt;/solution&gt;</code></pre>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Serviços -->
<section class="section services-section" id="servicos">
    <div class="container">
        <div class="section-header text-center">
            <h2 class="section-title"><?= __('home.services_title') ?></h2>
            <p class="section-subtitle"><?= __('home.services_subtitle') ?></p>
        </div>
        <div class="row g-4 mt-4">
            <?php
            $lang = defined('CURRENT_LANG') ? CURRENT_LANG : 'pt';
            foreach ($services as $service):
                $title = $service["title_{$lang}"] ?? $service['title_pt'];
                $desc = $service["short_description_{$lang}"] ?? $service['short_description_pt'];
            ?>
            <div class="col-md-6 col-lg-4">
                <div class="service-card">
                    <div class="service-icon"><i class="bi <?= e($service['icon'] ?? 'bi-gear') ?>"></i></div>
                    <h3 class="service-title"><?= e($title) ?></h3>
                    <p class="service-desc"><?= e($desc) ?></p>
                    <a href="<?= url('servicos/' . $service['slug']) ?>" class="service-link">
                        Saiba mais <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-5">
            <a href="<?= url('servicos') ?>" class="btn btn-outline-primary btn-lg"><?= __('menu.all_services') ?></a>
        </div>
    </div>
</section>

<!-- Como Trabalhamos -->
<section class="section process-section bg-light">
    <div class="container">
        <div class="section-header text-center">
            <h2 class="section-title">Como Trabalhamos</h2>
            <p class="section-subtitle">Metodologia ágil e focada em resultados</p>
        </div>
        <div class="row g-4 mt-4">
            <div class="col-md-3">
                <div class="process-step">
                    <div class="step-number">01</div>
                    <h4>Discovery</h4>
                    <p>Entendemos seu negócio, processos e objetivos.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="process-step">
                    <div class="step-number">02</div>
                    <h4>Planejamento</h4>
                    <p>Arquitetamos a solução ideal e definimos roadmap.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="process-step">
                    <div class="step-number">03</div>
                    <h4>Desenvolvimento</h4>
                    <p>Construímos com sprints, entregas contínuas e qualidade.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="process-step">
                    <div class="step-number">04</div>
                    <h4>Entrega & Suporte</h4>
                    <p>Deploy, treinamento e suporte contínuo.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Portfólio/Cases -->
<?php if (!empty($portfolio)): ?>
<section class="section portfolio-section">
    <div class="container">
        <div class="section-header text-center">
            <h2 class="section-title"><?= __('home.portfolio_title') ?></h2>
            <p class="section-subtitle"><?= __('home.portfolio_subtitle') ?></p>
        </div>
        <div class="row g-4 mt-4">
            <?php foreach (array_slice($portfolio, 0, 6) as $item): ?>
            <div class="col-md-6 col-lg-4">
                <div class="portfolio-card">
                    <?php if ($item['cover_image']): ?>
                    <img src="<?= e($item['cover_image']) ?>" alt="<?= e($item['title_pt']) ?>" class="portfolio-img" loading="lazy">
                    <?php else: ?>
                    <div class="portfolio-img-placeholder"><i class="bi bi-image"></i></div>
                    <?php endif; ?>
                    <div class="portfolio-overlay">
                        <h4><?= e($item['title_pt']) ?></h4>
                        <p><?= e($item['client_name'] ?? '') ?></p>
                        <a href="<?= url('portfolio/' . $item['slug']) ?>" class="btn btn-sm btn-light">Ver Case</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-5">
            <a href="<?= url('portfolio') ?>" class="btn btn-outline-primary btn-lg">Ver Todo Portfólio</a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Depoimentos -->
<?php if (!empty($testimonials)): ?>
<section class="section testimonials-section bg-dark text-white">
    <div class="container">
        <div class="section-header text-center">
            <h2 class="section-title text-white"><?= __('home.testimonials_title') ?></h2>
        </div>
        <div class="row g-4 mt-4">
            <?php foreach (array_slice($testimonials, 0, 3) as $t): ?>
            <div class="col-md-4">
                <div class="testimonial-card">
                    <div class="testimonial-rating">
                        <?php for ($i = 0; $i < ($t['rating'] ?? 5); $i++): ?>
                        <i class="bi bi-star-fill text-warning"></i>
                        <?php endfor; ?>
                    </div>
                    <p class="testimonial-text">"<?= e($t['content_pt']) ?>"</p>
                    <div class="testimonial-author">
                        <strong><?= e($t['client_name']) ?></strong>
                        <span><?= e($t['role'] ?? '') ?> - <?= e($t['company'] ?? '') ?></span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- FAQ -->
<?php if (!empty($faqs)): ?>
<section class="section faq-section">
    <div class="container">
        <div class="section-header text-center">
            <h2 class="section-title"><?= __('home.faq_title') ?></h2>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-lg-8">
                <div class="accordion" id="faqAccordion">
                    <?php foreach ($faqs as $i => $faq): ?>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button <?= $i > 0 ? 'collapsed' : '' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#faq<?= $i ?>">
                                <?= e($faq['question_pt']) ?>
                            </button>
                        </h2>
                        <div id="faq<?= $i ?>" class="accordion-collapse collapse <?= $i === 0 ? 'show' : '' ?>" data-bs-parent="#faqAccordion">
                            <div class="accordion-body"><?= e($faq['answer_pt']) ?></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Blog Recente -->
<?php if (!empty($recent_posts)): ?>
<section class="section blog-section bg-light">
    <div class="container">
        <div class="section-header text-center">
            <h2 class="section-title">Blog</h2>
            <p class="section-subtitle">Últimas novidades sobre tecnologia e inovação</p>
        </div>
        <div class="row g-4 mt-4">
            <?php foreach ($recent_posts as $post): ?>
            <div class="col-md-4">
                <div class="blog-card">
                    <?php if ($post['featured_image']): ?>
                    <img src="<?= e($post['featured_image']) ?>" alt="<?= e($post['title_pt']) ?>" class="blog-card-img" loading="lazy">
                    <?php endif; ?>
                    <div class="blog-card-body">
                        <span class="blog-card-category"><?= e($post['category_name'] ?? '') ?></span>
                        <h4><a href="<?= url('blog/' . $post['slug']) ?>"><?= e($post['title_pt']) ?></a></h4>
                        <p><?= truncate($post['excerpt_pt'] ?? strip_tags($post['content_pt'] ?? ''), 120) ?></p>
                        <div class="blog-card-meta">
                            <span><i class="bi bi-person"></i> <?= e($post['author_name'] ?? '') ?></span>
                            <span><i class="bi bi-calendar"></i> <?= $post['published_at'] ? formatDate($post['published_at']) : '' ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-5">
            <a href="<?= url('blog') ?>" class="btn btn-outline-primary btn-lg">Ver Todos os Posts</a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- CTA -->
<section class="section cta-section">
    <div class="container">
        <div class="cta-content text-center">
            <h2 class="cta-title"><?= __('home.cta_title') ?></h2>
            <p class="cta-subtitle"><?= __('home.cta_subtitle') ?></p>
            <a href="<?= url('contato') ?>" class="btn btn-primary btn-lg"><?= __('home.cta_button') ?></a>
        </div>
    </div>
</section>

<!-- Newsletter -->
<section class="section newsletter-section bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <h3><?= __('home.newsletter_title') ?></h3>
                <p class="text-muted"><?= __('home.newsletter_text') ?></p>
                <form action="<?= url('newsletter/subscribe') ?>" method="POST" class="newsletter-form mt-3">
                    <?= csrfField() ?>
                    <div class="input-group input-group-lg">
                        <input type="email" class="form-control" name="email" placeholder="<?= __('newsletter.placeholder') ?>" required>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-send"></i> Assinar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
