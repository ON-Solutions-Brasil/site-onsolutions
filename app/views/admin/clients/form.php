<?php $isEdit = isset($client); ?>
<div class="page-header"><h1 class="page-title"><?= $isEdit ? 'Editar Cliente' : 'Novo Cliente' ?></h1></div>

<form method="POST" action="<?= $isEdit ? url('admin/clients/' . $client['id']) : url('admin/clients') ?>">
    <?= csrfField() ?>
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6"><label class="form-label">Nome do Contato *</label><input type="text" class="form-control" name="contact_name" value="<?= e($client['contact_name'] ?? '') ?>" required></div>
                <div class="col-md-6"><label class="form-label">Empresa</label><input type="text" class="form-control" name="company_name" value="<?= e($client['company_name'] ?? '') ?>"></div>
                <div class="col-md-4"><label class="form-label">Email</label><input type="email" class="form-control" name="email" value="<?= e($client['email'] ?? '') ?>"></div>
                <div class="col-md-4"><label class="form-label">Telefone</label><input type="text" class="form-control" name="phone" value="<?= e($client['phone'] ?? '') ?>"></div>
                <div class="col-md-4"><label class="form-label">WhatsApp</label><input type="text" class="form-control" name="whatsapp" value="<?= e($client['whatsapp'] ?? '') ?>"></div>
                <div class="col-md-4"><label class="form-label">CPF/CNPJ</label><input type="text" class="form-control" name="document" value="<?= e($client['document'] ?? '') ?>"></div>
                <div class="col-md-4"><label class="form-label">Status</label>
                    <select class="form-select" name="status">
                        <?php foreach (['lead','prospect','active','inactive','lost'] as $s): ?>
                        <option value="<?= $s ?>" <?= ($client['status'] ?? 'lead') === $s ? 'selected' : '' ?>><?= ucfirst($s) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4"><label class="form-label">Funil</label>
                    <select class="form-select" name="funnel_stage">
                        <?php foreach (['awareness','interest','consideration','intent','evaluation','purchase'] as $f): ?>
                        <option value="<?= $f ?>" <?= ($client['funnel_stage'] ?? 'awareness') === $f ? 'selected' : '' ?>><?= ucfirst($f) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6"><label class="form-label">Website</label><input type="url" class="form-control" name="website" value="<?= e($client['website'] ?? '') ?>"></div>
                <div class="col-md-6"><label class="form-label">Fonte</label><input type="text" class="form-control" name="source" value="<?= e($client['source'] ?? '') ?>" placeholder="Como nos encontrou?"></div>
                <div class="col-12"><label class="form-label">Endereço</label><input type="text" class="form-control" name="address" value="<?= e($client['address'] ?? '') ?>"></div>
                <div class="col-md-4"><label class="form-label">Cidade</label><input type="text" class="form-control" name="city" value="<?= e($client['city'] ?? '') ?>"></div>
                <div class="col-md-4"><label class="form-label">Estado</label><input type="text" class="form-control" name="state" value="<?= e($client['state'] ?? '') ?>"></div>
                <div class="col-md-4"><label class="form-label">CEP</label><input type="text" class="form-control" name="zip_code" value="<?= e($client['zip_code'] ?? '') ?>"></div>
                <div class="col-md-6"><label class="form-label">Responsável</label>
                    <select class="form-select" name="assigned_to"><option value="">Nenhum</option>
                        <?php foreach ($users as $u): ?><option value="<?= $u['id'] ?>" <?= ($client['assigned_to'] ?? '') == $u['id'] ? 'selected' : '' ?>><?= e($u['name']) ?></option><?php endforeach; ?>
                    </select>
                </div>
                <div class="col-12"><label class="form-label">Observações</label><textarea class="form-control" name="notes" rows="3"><?= e($client['notes'] ?? '') ?></textarea></div>
            </div>
            <button type="submit" class="btn btn-primary mt-3"><i class="bi bi-check-lg"></i> <?= $isEdit ? 'Atualizar' : 'Cadastrar' ?></button>
            <a href="<?= url('admin/clients') ?>" class="btn btn-outline-secondary mt-3">Cancelar</a>
        </div>
    </div>
</form>
