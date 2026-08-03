<div class="page-header d-flex justify-content-between align-items-center">
    <div><h1 class="page-title">Equipe</h1><p class="page-subtitle">Gerenciar usuários do sistema</p></div>
    <a href="<?= url('admin/users/create') ?>" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Novo Usuário</a>
</div>

<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead><tr><th>Nome</th><th>Email</th><th>Perfil</th><th>Status</th><th>Último Login</th><th width="100">Ações</th></tr></thead>
            <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><strong><?= e($user['name']) ?></strong></td>
                <td><?= e($user['email']) ?></td>
                <td><span class="badge bg-primary"><?= e($user['role_name'] ?? $user['role']) ?></span></td>
                <td><span class="badge bg-<?= $user['is_active'] ? 'success' : 'danger' ?>"><?= $user['is_active'] ? 'Ativo' : 'Inativo' ?></span></td>
                <td><small><?= $user['last_login_at'] ? formatDateTime($user['last_login_at']) : 'Nunca' ?></small></td>
                <td>
                    <a href="<?= url('admin/users/' . $user['id'] . '/edit') ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                    <?php if ($user['id'] != $_SESSION['user_id']): ?>
                    <form method="POST" action="<?= url('admin/users/' . $user['id'] . '/delete') ?>" class="d-inline" onsubmit="return confirm('Excluir este usuário?')">
                        <?= csrfField() ?><button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                    </form>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
