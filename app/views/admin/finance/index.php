<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h1 class="page-title">Financeiro</h1>
        <p class="page-subtitle">Controle de receitas e despesas</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= url('admin/finance/income/create') ?>" class="btn btn-sm btn-success"><i class="bi bi-plus-lg me-1"></i>Receita</a>
        <a href="<?= url('admin/finance/expense/create') ?>" class="btn btn-sm btn-outline-danger"><i class="bi bi-plus-lg me-1"></i>Despesa</a>
        <a href="<?= url('admin/finance/report') ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-bar-chart me-1"></i>Relatório</a>
    </div>
</div>

<!-- Cards resumo -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm"><div class="card-body">
            <h6 class="text-muted">Receitas do Mês</h6>
            <h3 class="text-success"><?= formatMoney((float)$income_total) ?></h3>
        </div></div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm"><div class="card-body">
            <h6 class="text-muted">Despesas do Mês</h6>
            <h3 class="text-danger"><?= formatMoney((float)$expense_total) ?></h3>
        </div></div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm"><div class="card-body">
            <h6 class="text-muted">A Receber</h6>
            <h3 class="text-warning"><?= formatMoney((float)$pending_income) ?></h3>
        </div></div>
    </div>
</div>

<?php if (empty($transactions)): ?>
<div class="team-empty">
    <div class="team-empty__icon">
        <i class="bi bi-cash-stack"></i>
    </div>
    <h4>Nenhuma transação registrada</h4>
    <p>Adicione receitas ou despesas para começar o controle financeiro.</p>
</div>
<?php else: ?>
<div class="team-card">
    <div class="team-card__header">
        <div class="team-card__header-icon">
            <i class="bi bi-cash-stack"></i>
        </div>
        <div>
            <h3 class="team-card__title">Transações</h3>
            <p class="team-card__desc">Receitas e despesas do período</p>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0 team-table">
            <thead>
                <tr>
                    <th>Tipo</th>
                    <th>Descrição</th>
                    <th>Categoria</th>
                    <th>Valor</th>
                    <th>Vencimento</th>
                    <th>Status</th>
                    <th width="60">Ações</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($transactions as $t): ?>
            <tr>
                <td>
                    <?php if ($t['type'] === 'income'): ?>
                    <span class="logs-badge logs-badge--success">Receita</span>
                    <?php else: ?>
                    <span class="logs-badge logs-badge--danger">Despesa</span>
                    <?php endif; ?>
                </td>
                <td><span class="team-member__name"><?= e($t['description']) ?></span></td>
                <td><span class="logs-module"><?= e($t['category_name'] ?? '-') ?></span></td>
                <td>
                    <strong style="color: <?= $t['type'] === 'income' ? '#059669' : '#dc2626' ?>">
                        <?= formatMoney((float)$t['amount']) ?>
                    </strong>
                </td>
                <td><span class="team-date"><?= $t['due_date'] ? formatDate($t['due_date']) : '-' ?></span></td>
                <td>
                    <?php if ($t['status'] === 'paid'): ?>
                    <span class="team-status team-status--active"><span class="team-status__dot"></span> Pago</span>
                    <?php elseif ($t['status'] === 'overdue'): ?>
                    <span class="team-status team-status--inactive"><span class="team-status__dot"></span> Vencido</span>
                    <?php else: ?>
                    <span class="logs-badge logs-badge--warning">Pendente</span>
                    <?php endif; ?>
                </td>
                <td>
                    <div class="team-actions">
                        <form method="POST" action="<?= url('admin/finance/' . $t['id'] . '/delete') ?>" onsubmit="return confirm('Excluir esta transação?')">
                            <?= csrfField() ?>
                            <button class="team-action-btn team-action-btn--delete" title="Excluir">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php endif; ?>
