<div class="projects-form-page">
    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title"><?= isset($project) ? 'Editar Projeto' : 'Novo Projeto' ?></h1>
            <p class="page-subtitle"><?= isset($project) ? 'Alterar dados do projeto' : 'Preencha os dados do novo projeto' ?></p>
        </div>
        <a href="<?= url('admin/projects') ?>" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left"></i> Voltar</a>
    </div>

    <form method="POST" action="<?= isset($project) ? url('admin/projects/' . $project['id'] . '/update') : url('admin/projects') ?>">
        <?= csrfField() ?>
        <?php if (isset($project)): ?><?= methodField('PUT') ?><?php endif; ?>

        <!-- Dados Gerais -->
        <div class="team-card mb-4">
            <div class="team-card__header">
                <div class="team-card__header-icon">
                    <i class="bi bi-kanban"></i>
                </div>
                <div>
                    <h3 class="team-card__title">Dados do Projeto</h3>
                    <p class="team-card__desc">Informações gerais do projeto</p>
                </div>
            </div>
            <div class="card-body" style="padding: 1.8rem;">
                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-label">Nome do Projeto</label>
                        <input type="text" class="form-control" name="name" value="<?= e($project['name'] ?? '') ?>" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status">
                            <option value="planning" <?= ($project['status'] ?? '') === 'planning' ? 'selected' : '' ?>>Planejamento</option>
                            <option value="in_progress" <?= ($project['status'] ?? '') === 'in_progress' ? 'selected' : '' ?>>Em Andamento</option>
                            <option value="on_hold" <?= ($project['status'] ?? '') === 'on_hold' ? 'selected' : '' ?>>Pausado</option>
                            <option value="completed" <?= ($project['status'] ?? '') === 'completed' ? 'selected' : '' ?>>Concluído</option>
                            <option value="cancelled" <?= ($project['status'] ?? '') === 'cancelled' ? 'selected' : '' ?>>Cancelado</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Cliente</label>
                        <select class="form-select" name="client_id">
                            <option value="">-- Selecione --</option>
                            <?php foreach ($clients as $c): ?>
                            <option value="<?= $c['id'] ?>" <?= (($project['client_id'] ?? '') == $c['id']) ? 'selected' : '' ?>>
                                <?= e($c['contact_name']) ?><?= $c['company_name'] ? ' (' . e($c['company_name']) . ')' : '' ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Gerente</label>
                        <select class="form-select" name="manager_id">
                            <option value="">-- Selecione --</option>
                            <?php foreach ($users as $u): ?>
                            <option value="<?= $u['id'] ?>" <?= (($project['manager_id'] ?? '') == $u['id']) ? 'selected' : '' ?>>
                                <?= e($u['name']) ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Prioridade</label>
                        <select class="form-select" name="priority">
                            <option value="low" <?= ($project['priority'] ?? '') === 'low' ? 'selected' : '' ?>>Baixa</option>
                            <option value="medium" <?= ($project['priority'] ?? 'medium') === 'medium' ? 'selected' : '' ?>>Média</option>
                            <option value="high" <?= ($project['priority'] ?? '') === 'high' ? 'selected' : '' ?>>Alta</option>
                            <option value="urgent" <?= ($project['priority'] ?? '') === 'urgent' ? 'selected' : '' ?>>Urgente</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Descrição</label>
                        <textarea class="form-control" name="description" rows="3"><?= e($project['description'] ?? '') ?></textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Prazos e Orçamento -->
        <div class="team-card mb-4">
            <div class="team-card__header">
                <div class="team-card__header-icon" style="background: linear-gradient(135deg, #0891b2, #06b6d4);">
                    <i class="bi bi-calendar-range"></i>
                </div>
                <div>
                    <h3 class="team-card__title">Prazos e Orçamento</h3>
                    <p class="team-card__desc">Datas, horas estimadas e valor do projeto</p>
                </div>
            </div>
            <div class="card-body" style="padding: 1.8rem;">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Data Início</label>
                        <input type="date" class="form-control" name="start_date" value="<?= e($project['start_date'] ?? '') ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Prazo Final</label>
                        <input type="date" class="form-control" name="due_date" value="<?= e($project['due_date'] ?? '') ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Horas Estimadas</label>
                        <input type="number" class="form-control" name="estimated_hours" value="<?= e($project['estimated_hours'] ?? '') ?>" min="0">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Orçamento (R$)</label>
                        <input type="text" class="form-control" name="budget" value="<?= e($project['budget'] ?? '') ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Progresso (%)</label>
                        <input type="number" class="form-control" name="progress_percent" value="<?= e($project['progress_percent'] ?? '0') ?>" min="0" max="100">
                    </div>
                </div>
            </div>
        </div>

        <!-- Notas -->
        <div class="team-card mb-4">
            <div class="team-card__header">
                <div class="team-card__header-icon" style="background: linear-gradient(135deg, #475569, #64748b);">
                    <i class="bi bi-card-text"></i>
                </div>
                <div>
                    <h3 class="team-card__title">Notas</h3>
                    <p class="team-card__desc">Observações internas sobre o projeto</p>
                </div>
            </div>
            <div class="card-body" style="padding: 1.8rem;">
                <textarea class="form-control" name="notes" rows="3"><?= e($project['notes'] ?? '') ?></textarea>
            </div>
        </div>

        <!-- Botão Salvar -->
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i> <?= isset($project) ? 'Atualizar Projeto' : 'Criar Projeto' ?></button>
            <a href="<?= url('admin/projects') ?>" class="btn btn-outline-secondary">Cancelar</a>
        </div>
    </form>
</div>
