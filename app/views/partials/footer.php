<footer class="site-footer">
    <div class="container">
        <div class="row g-4">
            <!-- Sobre -->
            <div class="col-lg-4 col-md-6">
                <h5 class="footer-title"><?= e(SITE_NAME) ?></h5>
                <p class="footer-description"><?= e(setting('site_description', '')) ?></p>
                <div class="footer-social">
                    <?php if ($fb = setting('social_facebook')): ?>
                    <a href="<?= e($fb) ?>" target="_blank" rel="noopener" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                    <?php endif; ?>
                    <?php if ($ig = setting('social_instagram')): ?>
                    <a href="<?= e($ig) ?>" target="_blank" rel="noopener" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                    <?php endif; ?>
                    <?php if ($li = setting('social_linkedin')): ?>
                    <a href="<?= e($li) ?>" target="_blank" rel="noopener" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
                    <?php endif; ?>
                    <?php if ($gh = setting('social_github')): ?>
                    <a href="<?= e($gh) ?>" target="_blank" rel="noopener" aria-label="GitHub"><i class="bi bi-github"></i></a>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Serviços -->
            <div class="col-lg-2 col-md-6">
                <h5 class="footer-title"><?= __('menu.services') ?></h5>
                <ul class="footer-links">
                    <li><a href="<?= url('servicos/sistemas-web') ?>"><?= __('services.web_systems') ?></a></li>
                    <li><a href="<?= url('servicos/integracoes-apis') ?>"><?= __('services.integrations') ?></a></li>
                    <li><a href="<?= url('servicos/automacoes') ?>"><?= __('services.automations') ?></a></li>
                    <li><a href="<?= url('servicos/inteligencia-artificial') ?>"><?= __('services.ai_short') ?></a></li>
                    <li><a href="<?= url('servicos/consultoria') ?>"><?= __('services.consulting') ?></a></li>
                </ul>
            </div>
            
            <!-- Links -->
            <div class="col-lg-2 col-md-6">
                <h5 class="footer-title"><?= __('footer.links') ?></h5>
                <ul class="footer-links">
                    <li><a href="<?= url('quem-somos') ?>"><?= __('menu.about') ?></a></li>
                    <li><a href="<?= url('portfolio') ?>"><?= __('menu.portfolio') ?></a></li>
                    <li><a href="<?= url('blog') ?>"><?= __('menu.blog') ?></a></li>
                    <li><a href="<?= url('parceiros') ?>"><?= __('menu.partners') ?></a></li>
                    <li><a href="<?= url('contato') ?>"><?= __('menu.contact') ?></a></li>
                </ul>
            </div>
            
            <!-- Contato -->
            <div class="col-lg-4 col-md-6">
                <h5 class="footer-title"><?= __('footer.contact') ?></h5>
                <ul class="footer-contact">
                    <?php if ($email = setting('email')): ?>
                    <li><i class="bi bi-envelope"></i> <a href="mailto:<?= e($email) ?>"><?= e($email) ?></a></li>
                    <?php endif; ?>
                    <?php if ($phone = setting('phone')): ?>
                    <li><i class="bi bi-telephone"></i> <?= e($phone) ?></li>
                    <?php endif; ?>
                    <?php if ($whatsapp = setting('whatsapp_number')): ?>
                    <li><i class="bi bi-whatsapp"></i> <?= e($whatsapp) ?></li>
                    <?php endif; ?>
                    <?php if ($address = setting('address')): ?>
                    <li><i class="bi bi-geo-alt"></i> <?= e($address) ?></li>
                    <?php endif; ?>
                </ul>
                
                <!-- Newsletter Mini -->
                <form action="<?= url('newsletter/subscribe') ?>" method="POST" class="footer-newsletter mt-3">
                    <?= csrfField() ?>
                    <div class="input-group">
                        <input type="email" name="email" class="form-control" placeholder="<?= __('newsletter.placeholder') ?>" required>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-send"></i></button>
                    </div>
                </form>
            </div>
        </div>
        
        <hr class="footer-divider">
        
        <div class="footer-bottom">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p>&copy; <?= date('Y') ?> <?= e(SITE_NAME) ?>. <?= __('footer.rights') ?></p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="<?= url('politica-de-privacidade') ?>"><?= __('footer.privacy') ?></a>
                    <a href="<?= url('termos-de-uso') ?>"><?= __('footer.terms') ?></a>
                    <a href="<?= url('politica-de-cookies') ?>"><?= __('footer.cookies') ?></a>
                    <a href="<?= url('lgpd') ?>"><?= __('legal.lgpd_title') ?></a>
                </div>
            </div>
        </div>
    </div>
</footer>
