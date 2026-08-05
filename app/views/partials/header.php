<?php $currentLang = defined('CURRENT_LANG') ? CURRENT_LANG : 'pt'; ?>
<header class="site-header">
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="<?= url('/') ?>">
                <?php if ($logo = setting('logo')): ?>
                    <img src="<?= e($logo) ?>" alt="<?= e(SITE_NAME) ?>" height="40">
                <?php else: ?>
                    <span class="brand-text"><?= e(SITE_NAME) ?></span>
                <?php endif; ?>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link <?= ($_SERVER['REQUEST_URI'] === '/' || $_SERVER['REQUEST_URI'] === '') ? 'active' : '' ?>" href="<?= url('/') ?>"><?= __('menu.home') ?></a></li>
                    <li class="nav-item"><a class="nav-link <?= str_contains($_SERVER['REQUEST_URI'], 'quem-somos') ? 'active' : '' ?>" href="<?= url('quem-somos') ?>"><?= __('menu.about') ?></a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?= str_contains($_SERVER['REQUEST_URI'], 'servicos') ? 'active' : '' ?>" href="<?= url('servicos') ?>" role="button" data-bs-toggle="dropdown"><?= __('menu.services') ?></a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?= url('servicos') ?>"><?= __('menu.all_services') ?></a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?= url('servicos/sistemas-web') ?>">Sistemas Web</a></li>
                            <li><a class="dropdown-item" href="<?= url('servicos/integracoes-apis') ?>">Integrações & APIs</a></li>
                            <li><a class="dropdown-item" href="<?= url('servicos/automacoes') ?>">Automações</a></li>
                            <li><a class="dropdown-item" href="<?= url('servicos/inteligencia-artificial') ?>">Inteligência Artificial</a></li>
                            <li><a class="dropdown-item" href="<?= url('servicos/consultoria') ?>">Consultoria</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link <?= str_contains($_SERVER['REQUEST_URI'], 'portfolio') ? 'active' : '' ?>" href="<?= url('portfolio') ?>"><?= __('menu.portfolio') ?></a></li>
                    <li class="nav-item"><a class="nav-link <?= str_contains($_SERVER['REQUEST_URI'], 'blog') ? 'active' : '' ?>" href="<?= url('blog') ?>"><?= __('menu.blog') ?></a></li>
                    <li class="nav-item"><a class="nav-link <?= str_contains($_SERVER['REQUEST_URI'], 'contato') ? 'active' : '' ?>" href="<?= url('contato') ?>"><?= __('menu.contact') ?></a></li>
                    
                    <!-- Seletor de Idioma -->
                    <li class="nav-item dropdown ms-2">
                        <a class="nav-link dropdown-toggle lang-selector" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-globe2"></i> <?= strtoupper($currentLang) ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item <?= $currentLang === 'pt' ? 'active' : '' ?>" href="<?= url($_SERVER['REQUEST_URI']) ?>">Português</a></li>
                            <li><a class="dropdown-item <?= $currentLang === 'en' ? 'active' : '' ?>" href="<?= langUrl($_SERVER['REQUEST_URI'], 'en') ?>">English</a></li>
                            <li><a class="dropdown-item <?= $currentLang === 'es' ? 'active' : '' ?>" href="<?= langUrl($_SERVER['REQUEST_URI'], 'es') ?>">Español</a></li>
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
