<div class="page-header"><h1 class="page-title">Meu Perfil</h1></div>

<div class="row g-4">
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5>Dados Pessoais</h5>
                <form method="POST" action="<?= url('admin/profile') ?>">
                    <?= csrfField() ?>
                    <div class="mb-3"><label class="form-label">Nome</label><input type="text" class="form-control" name="name" value="<?= e($user['name'] ?? '') ?>" required></div>
                    <div class="mb-3"><label class="form-label">Email</label><input type="email" class="form-control" value="<?= e($user['email'] ?? '') ?>" disabled></div>
                    <div class="mb-3"><label class="form-label">Telefone</label><input type="text" class="form-control" name="phone" value="<?= e($user['phone'] ?? '') ?>"></div>
                    <div class="mb-3"><label class="form-label">Perfil</label><input type="text" class="form-control" value="<?= e($user['role_name'] ?? '') ?>" disabled></div>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i> Salvar</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5>Alterar Senha</h5>
                <form method="POST" action="<?= url('admin/profile/password') ?>">
                    <?= csrfField() ?>
                    <div class="mb-3"><label class="form-label">Senha Atual</label><input type="password" class="form-control" name="current_password" required></div>
                    <div class="mb-3"><label class="form-label">Nova Senha</label><input type="password" class="form-control" name="new_password" required minlength="8"></div>
                    <div class="mb-3"><label class="form-label">Confirmar Nova Senha</label><input type="password" class="form-control" name="confirm_password" required></div>
                    <button type="submit" class="btn btn-warning"><i class="bi bi-shield-lock"></i> Alterar Senha</button>
                </form>
            </div>
        </div>
    </div>
</div>
