<div class="team-page">
    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title">Equipe</h1>
            <p class="page-subtitle">Gerenciar usuários do sistema</p>
        </div>
        <div class="d-flex align-items-center gap-3">
            <div class="team-stat">
                <span class="team-stat__value"><?= count($users) ?></span>
                <span class="team-stat__label">membros</span>
            </div>
            <a href="<?= url('admin/users/create') ?>" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Novo Usuário</a>
        </div>
    </div>

    <?php if (empty($users)): ?>
    <div class="team-empty">
        <div class="team-empty__icon">
            <i class="bi bi-people"></i>
        </div>
        <h4>Nenhum usuário cadastrado</h4>
        <p>Adicione membros à equipe para gerenciar o sistema.</p>
    </div>
    <?php else: ?>
    <div class="team-card">
        <div class="team-card__header">
            <div class="team-card__header-icon">
                <i class="bi bi-people"></i>
            </div>
            <div>
                <h3 class="team-card__title">Membros da Equipe</h3>
                <p class="team-card__desc">Usuários com acesso ao painel administrativo</p>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0 team-table">
                <thead>
                    <tr>
                        <th>Membro</th>
                        <th>Perfil</th>
                        <th>Status</th>
                        <th>Último Login</th>
                        <th width="120">Ações</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td>
                        <div class="team-member">
                            <div class="team-member__avatar">
                                <?= strtoupper(substr($user['name'], 0, 1)) ?>
                            </div>
                            <div class="team-member__info">
                                <span class="team-member__name"><?= e($user['name']) ?></span>
                                <span class="team-member__email"><?= e($user['email']) ?></span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <?php
                        $roleClass = 'secondary';
                        $role = strtolower($user['role'] ?? '');
                        if ($role === 'super_admin') $roleClass = 'primary';
                        elseif ($role === 'admin') $roleClass = 'info';
                        elseif ($role === 'editor') $roleClass = 'warning';
                        ?>
                        <span class="team-role team-role--<?= $roleClass ?>"><?= e($user['role_name'] ?? $user['role']) ?></span>
                    </td>
                    <td>
                        <span class="team-status team-status--<?= $user['is_active'] ? 'active' : 'inactive' ?>">
                            <span class="team-status__dot"></span>
                            <?= $user['is_active'] ? 'Ativo' : 'Inativo' ?>
                        </span>
                    </td>
                    <td><span class="team-date"><?= $user['last_login_at'] ? formatDateTime($user['last_login_at']) : 'Nunca' ?></span></td>
                    <td>
                        <div class="team-actions">
                            <a href="<?= url('admin/users/' . $user['id'] . '/edit') ?>" class="team-action-btn team-action-btn--edit" title="Editar">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <?php if ($user['id'] != $_SESSION['user_id']): ?>
                            <form method="POST" action="<?= url('admin/users/' . $user['id'] . '/delete') ?>" class="d-inline" onsubmit="return confirm('Excluir este usuário?')">
                                <?= csrfField() ?>
                                <button class="team-action-btn team-action-btn--delete" title="Excluir">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php endif; ?>
</div>
