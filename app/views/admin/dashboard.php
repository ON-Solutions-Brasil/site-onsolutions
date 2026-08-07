<div class="page-header">
    <h1 class="page-title">Dashboard</h1>
    <p class="page-subtitle">Visão geral do sistema • <?= date('d/m/Y') ?></p>
</div>

<!-- Cards de Estatísticas -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-4">
        <div class="dashboard-metric-card">
            <div class="dashboard-metric-card__icon" style="background: linear-gradient(135deg, #0d9488, #14b8a6);">
                <i class="bi bi-people"></i>
            </div>
            <div class="dashboard-metric-card__info">
                <span class="dashboard-metric-card__label">Clientes</span>
                <h3 class="dashboard-metric-card__value"><?= (int) $stats['clients'] ?></h3>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-4">
        <div class="dashboard-metric-card">
            <div class="dashboard-metric-card__icon" style="background: linear-gradient(135deg, #0891b2, #06b6d4);">
                <i class="bi bi-kanban"></i>
            </div>
            <div class="dashboard-metric-card__info">
                <span class="dashboard-metric-card__label">Projetos Ativos</span>
                <h3 class="dashboard-metric-card__value"><?= (int) $stats['projects'] ?></h3>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-4">
        <div class="dashboard-metric-card">
            <div class="dashboard-metric-card__icon" style="background: linear-gradient(135deg, #d97706, #f59e0b);">
                <i class="bi bi-receipt"></i>
            </div>
            <div class="dashboard-metric-card__info">
                <span class="dashboard-metric-card__label">Orçamentos</span>
                <h3 class="dashboard-metric-card__value"><?= (int) $stats['quotes'] ?></h3>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-4">
        <div class="dashboard-metric-card">
            <div class="dashboard-metric-card__icon" style="background: linear-gradient(135deg, #059669, #10b981);">
                <i class="bi bi-journal-richtext"></i>
            </div>
            <div class="dashboard-metric-card__info">
                <span class="dashboard-metric-card__label">Posts Publicados</span>
                <h3 class="dashboard-metric-card__value"><?= (int) $stats['posts'] ?></h3>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-4">
        <div class="dashboard-metric-card">
            <div class="dashboard-metric-card__icon" style="background: linear-gradient(135deg, #dc2626, #ef4444);">
                <i class="bi bi-envelope-open"></i>
            </div>
            <div class="dashboard-metric-card__info">
                <span class="dashboard-metric-card__label">Contatos Novos</span>
                <h3 class="dashboard-metric-card__value"><?= (int) $stats['contacts'] ?></h3>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-4">
        <div class="dashboard-metric-card">
            <div class="dashboard-metric-card__icon" style="background: linear-gradient(135deg, #7c3aed, #8b5cf6);">
                <i class="bi bi-envelope-paper"></i>
            </div>
            <div class="dashboard-metric-card__info">
                <span class="dashboard-metric-card__label">Newsletter</span>
                <h3 class="dashboard-metric-card__value"><?= (int) $stats['newsletter'] ?></h3>
            </div>
        </div>
    </div>
</div>

<!-- Financeiro -->
<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="dashboard-finance-card dashboard-finance-card--income">
            <div class="dashboard-finance-card__icon">
                <i class="bi bi-arrow-up-circle"></i>
            </div>
            <div>
                <span class="dashboard-finance-card__label">Receitas do Mês</span>
                <h3 class="dashboard-finance-card__value"><?= formatMoney((float) $monthly_income) ?></h3>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="dashboard-finance-card dashboard-finance-card--expense">
            <div class="dashboard-finance-card__icon">
                <i class="bi bi-arrow-down-circle"></i>
            </div>
            <div>
                <span class="dashboard-finance-card__label">Despesas do Mês</span>
                <h3 class="dashboard-finance-card__value"><?= formatMoney((float) $monthly_expense) ?></h3>
            </div>
        </div>
    </div>
</div>

<!-- Contatos e Atividades -->
<div class="row g-3">
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                <h5 class="mb-0" style="font-size: 1rem; font-weight: 700;">Últimos Contatos</h5>
                <a href="<?= url('admin/clients') ?>" class="btn btn-sm btn-outline-primary">Ver todos</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($recent_contacts)): ?>
                            <tr><td colspan="3" class="text-center text-muted py-4">Nenhum contato recente</td></tr>
                            <?php else: ?>
                            <?php foreach ($recent_contacts as $contact): ?>
                            <tr>
                                <td><strong><?= e($contact['name']) ?></strong></td>
                                <td class="text-muted"><?= e($contact['email']) ?></td>
                                <td><small class="text-muted"><?= formatDateTime($contact['created_at']) ?></small></td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                <h5 class="mb-0" style="font-size: 1rem; font-weight: 700;">Atividade Recente</h5>
                <a href="<?= url('admin/logs') ?>" class="btn btn-sm btn-outline-primary">Ver todas</a>
            </div>
            <div class="card-body">
                <?php if (empty($recent_activities)): ?>
                <p class="text-muted text-center py-4 mb-0">Nenhuma atividade recente</p>
                <?php else: ?>
                <div class="dashboard-activity-feed">
                    <?php foreach (array_slice($recent_activities, 0, 6) as $activity): ?>
                    <div class="dashboard-activity-item">
                        <div class="dashboard-activity-item__dot"></div>
                        <div class="dashboard-activity-item__content">
                            <p>
                                <strong><?= e($activity['user_name'] ?? 'Sistema') ?></strong>
                                <?= e($activity['description'] ?? $activity['action']) ?>
                            </p>
                            <span><?= formatDateTime($activity['created_at']) ?></span>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
