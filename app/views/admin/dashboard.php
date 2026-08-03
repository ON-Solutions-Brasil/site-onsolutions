<div class="page-header">
    <h1 class="page-title">Dashboard</h1>
    <p class="page-subtitle">Bem-vindo, <?= e(currentUser()['name'] ?? 'Admin') ?>!</p>
</div>

<!-- Cards de Estatísticas -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-2">
        <div class="stat-card">
            <div class="stat-icon bg-primary"><i class="bi bi-people"></i></div>
            <div class="stat-info">
                <h3><?= (int) $stats['clients'] ?></h3>
                <span>Clientes</span>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-2">
        <div class="stat-card">
            <div class="stat-icon bg-info"><i class="bi bi-kanban"></i></div>
            <div class="stat-info">
                <h3><?= (int) $stats['projects'] ?></h3>
                <span>Projetos Ativos</span>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-2">
        <div class="stat-card">
            <div class="stat-icon bg-warning"><i class="bi bi-receipt"></i></div>
            <div class="stat-info">
                <h3><?= (int) $stats['quotes'] ?></h3>
                <span>Orçamentos</span>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-2">
        <div class="stat-card">
            <div class="stat-icon bg-success"><i class="bi bi-journal"></i></div>
            <div class="stat-info">
                <h3><?= (int) $stats['posts'] ?></h3>
                <span>Posts</span>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-2">
        <div class="stat-card">
            <div class="stat-icon bg-danger"><i class="bi bi-envelope"></i></div>
            <div class="stat-info">
                <h3><?= (int) $stats['contacts'] ?></h3>
                <span>Contatos Novos</span>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-2">
        <div class="stat-card">
            <div class="stat-icon bg-secondary"><i class="bi bi-envelope-paper"></i></div>
            <div class="stat-info">
                <h3><?= (int) $stats['newsletter'] ?></h3>
                <span>Newsletter</span>
            </div>
        </div>
    </div>
</div>

<!-- Financeiro Resumo -->
<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h6 class="text-muted mb-1">Receitas do Mês</h6>
                <h3 class="text-success mb-0"><?= formatMoney((float) $monthly_income) ?></h3>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h6 class="text-muted mb-1">Despesas do Mês</h6>
                <h3 class="text-danger mb-0"><?= formatMoney((float) $monthly_expense) ?></h3>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    <!-- Últimos Contatos -->
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Últimos Contatos</h5>
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
                            <tr><td colspan="3" class="text-center text-muted py-3">Nenhum contato recente</td></tr>
                            <?php else: ?>
                            <?php foreach ($recent_contacts as $contact): ?>
                            <tr>
                                <td><?= e($contact['name']) ?></td>
                                <td><?= e($contact['email']) ?></td>
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
    
    <!-- Últimas Atividades -->
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Atividade Recente</h5>
                <a href="<?= url('admin/logs') ?>" class="btn btn-sm btn-outline-primary">Ver todas</a>
            </div>
            <div class="card-body">
                <?php if (empty($recent_activities)): ?>
                <p class="text-muted text-center py-3">Nenhuma atividade recente</p>
                <?php else: ?>
                <div class="activity-feed">
                    <?php foreach ($recent_activities as $activity): ?>
                    <div class="activity-item">
                        <div class="activity-dot"></div>
                        <div class="activity-content">
                            <p class="mb-0">
                                <strong><?= e($activity['user_name'] ?? 'Sistema') ?></strong>
                                <span class="text-muted"><?= e($activity['description'] ?? $activity['action']) ?></span>
                            </p>
                            <small class="text-muted"><?= formatDateTime($activity['created_at']) ?></small>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
