<aside class="admin-sidebar" id="adminSidebar">
    <div class="sidebar-header">
        <a href="<?= url('admin/dashboard') ?>" class="sidebar-brand">
            <img src="<?= asset('img/favicon.png') ?>" alt="" style="height: 28px; width: auto;">
            <span class="brand-text"><?= e(SITE_NAME) ?></span>
        </a>
        <button class="sidebar-toggle d-lg-none" id="sidebarClose">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>
    
    <nav class="sidebar-nav">
        <ul class="sidebar-menu">
            <li class="menu-item">
                <a href="<?= url('admin/dashboard') ?>" class="menu-link <?= strpos($_SERVER['REQUEST_URI'], '/admin/dashboard') !== false ? 'active' : '' ?>">
                    <i class="bi bi-speedometer2"></i> <span>Dashboard</span>
                </a>
            </li>
            
            <?php if (hasPermission('clients.view')): ?>
            <li class="menu-header">CRM</li>
            <li class="menu-item">
                <a href="<?= url('admin/clients') ?>" class="menu-link <?= strpos($_SERVER['REQUEST_URI'], '/admin/clients') !== false ? 'active' : '' ?>">
                    <i class="bi bi-people"></i> <span>Clientes</span>
                </a>
            </li>
            <?php endif; ?>
            
            <?php if (hasPermission('projects.view')): ?>
            <li class="menu-item">
                <a href="<?= url('admin/projects') ?>" class="menu-link <?= strpos($_SERVER['REQUEST_URI'], '/admin/projects') !== false ? 'active' : '' ?>">
                    <i class="bi bi-kanban"></i> <span>Projetos</span>
                </a>
            </li>
            <?php endif; ?>
            
            <?php if (hasPermission('quotes.view')): ?>
            <li class="menu-item">
                <a href="<?= url('admin/quotes') ?>" class="menu-link <?= strpos($_SERVER['REQUEST_URI'], '/admin/quotes') !== false ? 'active' : '' ?>">
                    <i class="bi bi-receipt"></i> <span>Orçamentos</span>
                </a>
            </li>
            <?php endif; ?>
            
            <?php if (hasPermission('finance.view')): ?>
            <li class="menu-item">
                <a href="<?= url('admin/finance') ?>" class="menu-link <?= strpos($_SERVER['REQUEST_URI'], '/admin/finance') !== false ? 'active' : '' ?>">
                    <i class="bi bi-cash-stack"></i> <span>Financeiro</span>
                </a>
            </li>
            <?php endif; ?>
            
            <li class="menu-header">Conteúdo</li>
            
            <?php if (hasPermission('blog.view')): ?>
            <li class="menu-item">
                <a href="<?= url('admin/blog') ?>" class="menu-link <?= strpos($_SERVER['REQUEST_URI'], '/admin/blog') !== false ? 'active' : '' ?>">
                    <i class="bi bi-journal-richtext"></i> <span>Blog</span>
                </a>
            </li>
            <?php endif; ?>
            
            <?php if (hasPermission('portfolio.view')): ?>
            <li class="menu-item">
                <a href="<?= url('admin/portfolio') ?>" class="menu-link <?= strpos($_SERVER['REQUEST_URI'], '/admin/portfolio') !== false ? 'active' : '' ?>">
                    <i class="bi bi-collection"></i> <span>Portfólio</span>
                </a>
            </li>
            <?php endif; ?>
            
            <?php if (hasPermission('pages.view')): ?>
            <li class="menu-item">
                <a href="<?= url('admin/pages') ?>" class="menu-link <?= strpos($_SERVER['REQUEST_URI'], '/admin/pages') !== false ? 'active' : '' ?>">
                    <i class="bi bi-file-earmark-text"></i> <span>Páginas</span>
                </a>
            </li>
            <?php endif; ?>
            
            <?php if (hasPermission('newsletter.view')): ?>
            <li class="menu-item">
                <a href="<?= url('admin/newsletter') ?>" class="menu-link <?= strpos($_SERVER['REQUEST_URI'], '/admin/newsletter') !== false ? 'active' : '' ?>">
                    <i class="bi bi-envelope-paper"></i> <span>Newsletter</span>
                </a>
            </li>
            <?php endif; ?>
            
            <li class="menu-header">Sistema</li>
            
            <?php if (hasPermission('users.view')): ?>
            <li class="menu-item">
                <a href="<?= url('admin/users') ?>" class="menu-link <?= strpos($_SERVER['REQUEST_URI'], '/admin/users') !== false ? 'active' : '' ?>">
                    <i class="bi bi-person-gear"></i> <span>Equipe</span>
                </a>
            </li>
            <?php endif; ?>
            
            <?php if (hasPermission('ai.use')): ?>
            <li class="menu-item">
                <a href="<?= url('admin/ai-assistant') ?>" class="menu-link <?= strpos($_SERVER['REQUEST_URI'], '/admin/ai-assistant') !== false ? 'active' : '' ?>">
                    <i class="bi bi-robot"></i> <span>Assistente IA</span>
                </a>
            </li>
            <?php endif; ?>
            
            <?php if (hasPermission('logs.view')): ?>
            <li class="menu-item">
                <a href="<?= url('admin/logs') ?>" class="menu-link <?= strpos($_SERVER['REQUEST_URI'], '/admin/logs') !== false ? 'active' : '' ?>">
                    <i class="bi bi-clock-history"></i> <span>Logs</span>
                </a>
            </li>
            <?php endif; ?>
            
            <?php if (hasPermission('backup.manage')): ?>
            <li class="menu-item">
                <a href="<?= url('admin/backup') ?>" class="menu-link <?= strpos($_SERVER['REQUEST_URI'], '/admin/backup') !== false ? 'active' : '' ?>">
                    <i class="bi bi-cloud-download"></i> <span>Backup</span>
                </a>
            </li>
            <?php endif; ?>
            
            <?php if (hasPermission('versions.manage')): ?>
            <li class="menu-item">
                <a href="<?= url('admin/versions') ?>" class="menu-link <?= strpos($_SERVER['REQUEST_URI'], '/admin/versions') !== false ? 'active' : '' ?>">
                    <i class="bi bi-git"></i> <span>Versões</span>
                </a>
            </li>
            <?php endif; ?>
            
            <?php if (hasPermission('settings.view')): ?>
            <li class="menu-item">
                <a href="<?= url('admin/settings') ?>" class="menu-link <?= strpos($_SERVER['REQUEST_URI'], '/admin/settings') !== false ? 'active' : '' ?>">
                    <i class="bi bi-gear"></i> <span>Configurações</span>
                </a>
            </li>
            <?php endif; ?>
        </ul>
    </nav>
    
    <div class="sidebar-footer">
        <a href="<?= url('/') ?>" target="_blank" class="btn btn-outline-light btn-sm w-100">
            <i class="bi bi-globe"></i> Ver Site
        </a>
    </div>
</aside>
