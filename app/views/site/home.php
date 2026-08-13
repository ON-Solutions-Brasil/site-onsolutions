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
                        <div class="stat"><strong>100+</strong><span><?= __('home.stats_projects') ?></span></div>
                        <div class="stat"><strong>50+</strong><span><?= __('home.stats_clients') ?></span></div>
                        <div class="stat"><strong>99%</strong><span><?= __('home.stats_satisfaction') ?></span></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-block">
                <div class="hero-visual">
                    <div class="code-window">
                        <div class="code-header"><span></span><span></span><span></span></div>
                        <pre><code>&lt;solution&gt;
  <?= __('home.code_custom') ?>

  <?= __('home.code_scalable') ?>

  <?= __('home.code_smart') ?>

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
                        <?= __('home.learn_more') ?> <i class="bi bi-arrow-right"></i>
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
            <h2 class="section-title"><?= __('home.process_title') ?></h2>
            <p class="section-subtitle"><?= __('home.process_subtitle') ?></p>
        </div>
        <div class="row g-4 mt-4">
            <div class="col-md-3">
                <div class="process-step">
                    <div class="step-number">01</div>
                    <h4><?= __('home.process_step1_title') ?></h4>
                    <p><?= __('home.process_step1_desc') ?></p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="process-step">
                    <div class="step-number">02</div>
                    <h4><?= __('home.process_step2_title') ?></h4>
                    <p><?= __('home.process_step2_desc') ?></p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="process-step">
                    <div class="step-number">03</div>
                    <h4><?= __('home.process_step3_title') ?></h4>
                    <p><?= __('home.process_step3_desc') ?></p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="process-step">
                    <div class="step-number">04</div>
                    <h4><?= __('home.process_step4_title') ?></h4>
                    <p><?= __('home.process_step4_desc') ?></p>
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
                        <a href="<?= url('portfolio/' . $item['slug']) ?>" class="btn btn-sm btn-light"><?= __('home.view_case') ?></a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-5">
            <a href="<?= url('portfolio') ?>" class="btn btn-outline-primary btn-lg"><?= __('home.view_all_portfolio') ?></a>
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
            <p class="section-subtitle"><?= __('home.blog_subtitle') ?></p>
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
            <a href="<?= url('blog') ?>" class="btn btn-outline-primary btn-lg"><?= __('home.view_all_posts') ?></a>
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
<section class="section newsletter-section">
    <div class="container">
        <div class="newsletter-premium">
            <div class="newsletter-premium__bg"></div>
            <div class="newsletter-premium__content">
                <span class="newsletter-premium__badge"><i class="bi bi-envelope-paper"></i> Newsletter</span>
                <h2 class="newsletter-premium__title"><?= __('home.newsletter_title') ?></h2>
                <p class="newsletter-premium__text"><?= __('home.newsletter_text') ?></p>
                <form id="newsletterHomeForm" action="<?= url('newsletter/subscribe') ?>" method="POST" class="newsletter-premium__form">
                    <?= csrfField() ?>
                    <div class="newsletter-premium__input-group">
                        <input type="email" class="newsletter-premium__input" name="email" placeholder="<?= __('newsletter.placeholder') ?>" required>
                        <button type="submit" class="newsletter-premium__btn">
                            <span><?= __('home.newsletter_subscribe') ?></span>
                            <i class="bi bi-arrow-right"></i>
                        </button>
                    </div>
                </form>
                <div id="newsletterHomeMsg" style="display:none;"></div>
                <p class="newsletter-premium__note"><i class="bi bi-shield-check"></i> <?= __('home.newsletter_note') ?></p>
            </div>
        </div>
    </div>
</section>

<style>
@keyframes newsletterPulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}
@keyframes newsletterSlideIn {
    from { opacity: 0; transform: translateY(12px) scale(0.95); }
    to { opacity: 1; transform: translateY(0) scale(1); }
}
@keyframes newsletterCheckDraw {
    from { stroke-dashoffset: 24; }
    to { stroke-dashoffset: 0; }
}
@keyframes newsletterShimmer {
    0% { background-position: -200% center; }
    100% { background-position: 200% center; }
}
.nl-notification {
    margin-top: 1.2rem;
    padding: 1.2rem 1.5rem;
    border-radius: 12px;
    animation: newsletterSlideIn 0.5s cubic-bezier(0.4, 0, 0.2, 1) forwards;
    position: relative;
    overflow: hidden;
}
.nl-notification::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.08), transparent);
    background-size: 200% 100%;
    animation: newsletterShimmer 2s ease-in-out;
    pointer-events: none;
}
.nl-notification--success {
    background: linear-gradient(135deg, #0d9488 0%, #115e59 100%);
    border: 1px solid rgba(20, 184, 166, 0.5);
    box-shadow: 0 8px 32px rgba(13, 148, 136, 0.25), 0 0 0 1px rgba(20, 184, 166, 0.1), inset 0 1px 0 rgba(255,255,255,0.1);
}
.nl-notification--info {
    background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
    border: 1px solid rgba(13, 148, 136, 0.4);
    box-shadow: 0 8px 32px rgba(13, 148, 136, 0.15), 0 0 0 1px rgba(20, 184, 166, 0.08);
}
.nl-notification--error {
    background: linear-gradient(135deg, #7f1d1d 0%, #450a0a 100%);
    border: 1px solid rgba(239, 68, 68, 0.4);
    box-shadow: 0 8px 32px rgba(239, 68, 68, 0.15);
}
.nl-notification__inner {
    display: flex;
    align-items: center;
    gap: 14px;
    position: relative;
    z-index: 1;
}
.nl-notification__icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.nl-notification--success .nl-notification__icon {
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(4px);
}
.nl-notification--info .nl-notification__icon {
    background: rgba(13, 148, 136, 0.2);
}
.nl-notification--error .nl-notification__icon {
    background: rgba(239, 68, 68, 0.2);
}
.nl-notification__icon i {
    font-size: 1.2rem;
}
.nl-notification--success .nl-notification__icon i { color: #ffffff; }
.nl-notification--info .nl-notification__icon i { color: #5eead4; }
.nl-notification--error .nl-notification__icon i { color: #fca5a5; }
.nl-notification__text {
    flex: 1;
}
.nl-notification__title {
    font-size: 0.85rem;
    font-weight: 700;
    margin-bottom: 2px;
    letter-spacing: -0.2px;
}
.nl-notification--success .nl-notification__title { color: #ffffff; }
.nl-notification--info .nl-notification__title { color: #99f6e4; }
.nl-notification--error .nl-notification__title { color: #fca5a5; }
.nl-notification__desc {
    font-size: 0.8rem;
    font-weight: 400;
    opacity: 0.85;
    line-height: 1.4;
}
.nl-notification--success .nl-notification__desc { color: #ccfbf1; }
.nl-notification--info .nl-notification__desc { color: #94a3b8; }
.nl-notification--error .nl-notification__desc { color: #fecaca; }
</style>

<script>
(function() {
    var form = document.getElementById('newsletterHomeForm');
    if (!form) return;
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        var btn = form.querySelector('button[type="submit"]');
        var originalHtml = btn.innerHTML;
        var msgBox = document.getElementById('newsletterHomeMsg');
        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status"></span>';

        msgBox.style.display = 'none';
        msgBox.innerHTML = '';

        var formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(function(r) { return r.json(); })
        .then(function(data) {
            var success = data.success;
            var message = data.message || data.error || '';

            if (success) {
                msgBox.innerHTML = '<div class="nl-notification nl-notification--success"><div class="nl-notification__inner"><div class="nl-notification__icon"><i class="bi bi-check-circle-fill"></i></div><div class="nl-notification__text"><div class="nl-notification__title"><?= __('newsletter.success_title') ?></div><div class="nl-notification__desc"><?= __('newsletter.success_desc') ?></div></div></div></div>';
                form.reset();
            } else {
                msgBox.innerHTML = '<div class="nl-notification nl-notification--info"><div class="nl-notification__inner"><div class="nl-notification__icon"><i class="bi bi-envelope-check-fill"></i></div><div class="nl-notification__text"><div class="nl-notification__title"><?= __('newsletter.already_title') ?></div><div class="nl-notification__desc">' + message + '</div></div></div></div>';
            }
            msgBox.style.display = 'block';
            btn.disabled = false;
            btn.innerHTML = originalHtml;
        })
        .catch(function() {
            msgBox.innerHTML = '<div class="nl-notification nl-notification--error"><div class="nl-notification__inner"><div class="nl-notification__icon"><i class="bi bi-exclamation-triangle-fill"></i></div><div class="nl-notification__text"><div class="nl-notification__title"><?= __('newsletter.error_title') ?></div><div class="nl-notification__desc"><?= __('newsletter.error_desc') ?></div></div></div></div>';
            msgBox.style.display = 'block';
            btn.disabled = false;
            btn.innerHTML = originalHtml;
        });
    });
})();
</script>
