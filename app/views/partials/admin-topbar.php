<header class="admin-topbar">
    <div class="topbar-left">
        <button class="sidebar-toggle d-lg-none" id="sidebarOpen">
            <i class="bi bi-list"></i>
        </button>
        <nav aria-label="breadcrumb" class="d-none d-md-block">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="<?= url('admin/dashboard') ?>">Admin</a></li>
            </ol>
        </nav>
    </div>
    
    <div class="topbar-right">
        <!-- Notificações -->
        <div class="dropdown me-3">
            <button class="btn btn-link topbar-icon" data-bs-toggle="dropdown" aria-label="Notificações">
                <i class="bi bi-bell"></i>
                <?php
                $newContacts = $this->db->fetch("SELECT COUNT(*) as c FROM contact_messages WHERE status = 'new'")['c'] ?? 0;
                if ($newContacts > 0):
                ?>
                <span class="badge bg-danger"><?= $newContacts ?></span>
                <?php endif; ?>
            </button>
            <div class="dropdown-menu dropdown-menu-end notification-dropdown">
                <h6 class="dropdown-header">Notificações</h6>
                <?php if ($newContacts > 0): ?>
                <a class="dropdown-item" href="<?= url('admin/clients') ?>">
                    <i class="bi bi-envelope text-primary"></i>
                    <?= $newContacts ?> nova(s) mensagem(ns) de contato
                </a>
                <?php else: ?>
                <span class="dropdown-item text-muted">Sem novas notificações</span>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Usuário -->
        <div class="dropdown">
            <button class="btn btn-link topbar-user" data-bs-toggle="dropdown">
                <span class="user-name d-none d-md-inline"><?= e(currentUser()['name'] ?? 'Admin') ?></span>
                <span class="user-avatar">
                    <?php if ($avatar = currentUser()['avatar'] ?? null): ?>
                        <img src="<?= e($avatar) ?>" alt="Avatar">
                    <?php else: ?>
                        <i class="bi bi-shield-check"></i>
                    <?php endif; ?>
                </span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <a class="dropdown-item admin-profile-btn" href="<?= url('admin/profile') ?>">
                        <i class="bi bi-person"></i> Meu Perfil
                    </a>
                </li>
                <li><a class="dropdown-item" href="<?= url('admin/settings') ?>"><i class="bi bi-gear"></i> Configurações</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-danger" href="<?= url('admin/logout') ?>"><i class="bi bi-box-arrow-right"></i> Sair</a></li>
            </ul>
        </div>
    </div>
</header>
