<?php $currentLang = defined('CURRENT_LANG') ? CURRENT_LANG : 'pt'; ?>
<header class="site-header">
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="<?= url('/') ?>">
                <?php if ($logo = setting('logo')): ?>
                    <img src="<?= e($logo) ?>" alt="<?= e(SITE_NAME) ?>" height="40">
                <?php else: ?>
                    <img src="<?= asset('img/favicon.png') ?>" alt="<?= e(SITE_NAME) ?>" class="brand-icon"><span class="brand-text"><?= e(SITE_NAME) ?></span>
                <?php endif; ?>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav mx-auto align-items-center">
                    <li class="nav-item"><a class="nav-link <?= ($_SERVER['REQUEST_URI'] === '/' || $_SERVER['REQUEST_URI'] === '') ? 'active' : '' ?>" href="<?= url('/') ?>"><?= __('menu.home') ?></a></li>
                    <li class="nav-item"><a class="nav-link <?= str_contains($_SERVER['REQUEST_URI'], 'quem-somos') ? 'active' : '' ?>" href="<?= url('quem-somos') ?>"><?= __('menu.about') ?></a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?= str_contains($_SERVER['REQUEST_URI'], 'servicos') ? 'active' : '' ?>" href="<?= url('servicos') ?>" role="button" data-bs-toggle="dropdown"><?= __('menu.services') ?></a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?= url('servicos') ?>"><?= __('menu.all_services') ?></a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?= url('servicos/sistemas-web') ?>"><?= __('services.web_systems') ?></a></li>
                            <li><a class="dropdown-item" href="<?= url('servicos/integracoes-apis') ?>"><?= __('services.integrations') ?></a></li>
                            <li><a class="dropdown-item" href="<?= url('servicos/automacoes') ?>"><?= __('services.automations') ?></a></li>
                            <li><a class="dropdown-item" href="<?= url('servicos/inteligencia-artificial') ?>"><?= __('services.ai') ?></a></li>
                            <li><a class="dropdown-item" href="<?= url('servicos/consultoria') ?>"><?= __('services.consulting') ?></a></li>
                        </ul>
                    </li>
                    <?php if (!empty($has_portfolio)): ?>
                    <li class="nav-item"><a class="nav-link <?= str_contains($_SERVER['REQUEST_URI'], 'portfolio') ? 'active' : '' ?>" href="<?= url('portfolio') ?>"><?= __('menu.portfolio') ?></a></li>
                    <?php endif; ?>
                    <li class="nav-item"><a class="nav-link <?= str_contains($_SERVER['REQUEST_URI'], 'blog') ? 'active' : '' ?>" href="<?= url('blog') ?>"><?= __('menu.blog') ?></a></li>
                    <li class="nav-item"><a class="nav-link <?= str_contains($_SERVER['REQUEST_URI'], 'contato') ? 'active' : '' ?>" href="<?= url('contato') ?>"><?= __('menu.contact') ?></a></li>
                    
                    <!-- Seletor de Idioma -->
                    <li class="nav-item dropdown ms-2">
                        <a class="nav-link dropdown-toggle lang-selector" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-globe2"></i> <?= strtoupper($currentLang) ?>
                        </a>
                        <?php $currentPath = currentPathWithoutLang(); ?>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item <?= $currentLang === 'pt' ? 'active' : '' ?>" href="<?= langUrl($currentPath, 'pt') ?>">Português</a></li>
                            <li><a class="dropdown-item <?= $currentLang === 'en' ? 'active' : '' ?>" href="<?= langUrl($currentPath, 'en') ?>">English</a></li>
                            <li><a class="dropdown-item <?= $currentLang === 'es' ? 'active' : '' ?>" href="<?= langUrl($currentPath, 'es') ?>">Español</a></li>
                        </ul>
                    </li>
                    
                    <!-- Ícone de Usuário -->
                    <li class="nav-item dropdown ms-2">
                        <a class="nav-link user-icon-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Menu do usuário">
                            <i class="bi bi-person"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end user-dropdown">
                            <?php if (isLoggedIn()): ?>
                                <li><a class="dropdown-item" href="<?= url('admin/profile') ?>"><i class="bi bi-person me-2"></i><?= __('menu.my_account') ?></a></li>
                                <?php if (hasRole('super_admin') || hasRole('admin')): ?>
                                <li><a class="dropdown-item" href="<?= url('admin') ?>"><i class="bi bi-gear me-2"></i><?= __('menu.admin_panel') ?></a></li>
                                <?php endif; ?>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="<?= url('admin/logout') ?>"><i class="bi bi-box-arrow-right me-2"></i><?= __('menu.logout') ?></a></li>
                            <?php else: ?>
                                <li><a class="dropdown-item" href="<?= url('admin/login') ?>"><i class="bi bi-box-arrow-in-right me-2"></i><?= __('menu.login') ?></a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    
                    <li class="nav-item ms-3">
                        <a class="btn btn-primary btn-sm" href="<?= url('contato') ?>"><?= __('menu.get_quote') ?></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
