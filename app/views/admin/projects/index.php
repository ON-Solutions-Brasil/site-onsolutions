<div class="projects-page">
    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title">Projetos</h1>
            <p class="page-subtitle">Gerencie os projetos em andamento</p>
        </div>
        <div class="d-flex align-items-center gap-3">
            <div class="team-stat">
                <span class="team-stat__value"><?= count($projects ?? []) ?></span>
                <span class="team-stat__label">projetos</span>
            </div>
            <a href="<?= url('admin/projects/create') ?>" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Novo Projeto</a>
        </div>
    </div>

    <?php if (empty($projects)): ?>
    <div class="team-empty">
        <div class="team-empty__icon">
            <i class="bi bi-kanban"></i>
        </div>
        <h4>Nenhum projeto cadastrado</h4>
        <p>Crie o primeiro projeto para acompanhar o progresso.</p>
    </div>
    <?php else: ?>
    <div class="team-card">
        <div class="team-card__header">
            <div class="team-card__header-icon">
                <i class="bi bi-kanban"></i>
            </div>
            <div>
                <h3 class="team-card__title">Projetos</h3>
                <p class="team-card__desc">Acompanhamento de projetos ativos e concluídos</p>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0 team-table">
                <thead>
                    <tr>
                        <th>Projeto</th>
                        <th>Cliente</th>
                        <th>Gerente</th>
                        <th>Status</th>
                        <th>Prioridade</th>
                        <th>Progresso</th>
                        <th>Prazo</th>
                        <th width="80">Ações</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($projects as $p): ?>
                <tr>
                    <td>
                        <a href="<?= url('admin/projects/' . $p['id']) ?>" style="text-decoration: none;">
                            <div class="team-member">
                                <div class="team-member__avatar">
                                    <?= strtoupper(substr($p['name'], 0, 1)) ?>
                                </div>
                                <span class="team-member__name"><?= e($p['name']) ?></span>
                            </div>
                        </a>
                    </td>
                    <td><span class="team-date"><?= e($p['client_name'] ?? '-') ?></span></td>
                    <td><span class="team-date"><?= e($p['manager_name'] ?? '-') ?></span></td>
                    <td>
                        <?php if ($p['status'] === 'completed'): ?>
                        <span class="team-status team-status--active"><span class="team-status__dot"></span> Concluído</span>
                        <?php elseif ($p['status'] === 'in_progress'): ?>
                        <span class="logs-badge logs-badge--primary">Em andamento</span>
                        <?php else: ?>
                        <span class="logs-badge logs-badge--secondary"><?= e($p['status']) ?></span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($p['priority'] === 'urgent'): ?>
                        <span class="logs-badge logs-badge--danger">Urgente</span>
                        <?php elseif ($p['priority'] === 'high'): ?>
                        <span class="logs-badge logs-badge--warning">Alta</span>
                        <?php else: ?>
                        <span class="logs-badge logs-badge--info"><?= e($p['priority']) ?></span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div class="progress" style="width: 70px; height: 6px; flex-shrink: 0;">
                                <div class="progress-bar" style="width: <?= $p['progress_percent'] ?>%"></div>
                            </div>
                            <span class="team-date"><?= $p['progress_percent'] ?>%</span>
                        </div>
                    </td>
                    <td><span class="team-date"><?= $p['due_date'] ? formatDate($p['due_date']) : '-' ?></span></td>
                    <td>
                        <div class="team-actions">
                            <a href="<?= url('admin/projects/' . $p['id'] . '/edit') ?>" class="team-action-btn team-action-btn--edit" title="Editar">
                                <i class="bi bi-pencil"></i>
                            </a>
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
