<?php $isEdit = isset($user); ?>
<div class="page-header"><h1 class="page-title"><?= $isEdit ? 'Editar Usuário' : 'Novo Usuário' ?></h1></div>

<form method="POST" action="<?= $isEdit ? url('admin/users/' . $user['id']) : url('admin/users') ?>">
    <?= csrfField() ?>
    <div class="card border-0 shadow-sm"><div class="card-body">
        <div class="row g-3">
            <div class="col-md-6"><label class="form-label">Nome *</label><input type="text" class="form-control" name="name" value="<?= e($user['name'] ?? '') ?>" required></div>
            <div class="col-md-6"><label class="form-label">Email *</label><input type="email" class="form-control" name="email" value="<?= e($user['email'] ?? '') ?>" required></div>
            <div class="col-md-4"><label class="form-label">Perfil</label>
                <select class="form-select" name="role_id">
                    <?php foreach ($roles as $role): ?>
                    <option value="<?= $role['id'] ?>" <?= ($user['role_id'] ?? '') == $role['id'] ? 'selected' : '' ?>><?= e($role['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-4"><label class="form-label">Telefone</label><input type="text" class="form-control" name="phone" value="<?= e($user['phone'] ?? '') ?>"></div>
            <div class="col-md-4"><label class="form-label"><?= $isEdit ? 'Nova Senha (deixe vazio para manter)' : 'Senha será gerada automaticamente' ?></label>
                <?php if ($isEdit): ?><input type="password" class="form-control" name="new_password" placeholder="Nova senha..."><?php else: ?><input type="text" class="form-control" disabled value="Enviada por email"><?php endif; ?>
            </div>
            <div class="col-md-4"><div class="form-check mt-4"><input type="checkbox" class="form-check-input" name="is_active" id="is_active" <?= ($user['is_active'] ?? 1) ? 'checked' : '' ?>><label class="form-check-label" for="is_active">Ativo</label></div></div>
        </div>
        <button type="submit" class="btn btn-primary mt-3"><i class="bi bi-check-lg"></i> <?= $isEdit ? 'Atualizar' : 'Criar Usuário' ?></button>
        <a href="<?= url('admin/users') ?>" class="btn btn-outline-secondary mt-3">Cancelar</a>
    </div></div>
</form>
