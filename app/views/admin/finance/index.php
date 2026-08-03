<div class="page-header d-flex justify-content-between align-items-center">
    <div><h1 class="page-title">Financeiro</h1></div>
    <div class="d-flex gap-2">
        <a href="<?= url('admin/finance/income/create') ?>" class="btn btn-success"><i class="bi bi-plus-lg"></i> Receita</a>
        <a href="<?= url('admin/finance/expense/create') ?>" class="btn btn-danger"><i class="bi bi-plus-lg"></i> Despesa</a>
        <a href="<?= url('admin/finance/report') ?>" class="btn btn-outline-primary"><i class="bi bi-bar-chart"></i> Relatório</a>
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

<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead><tr><th>Tipo</th><th>Descrição</th><th>Categoria</th><th>Valor</th><th>Vencimento</th><th>Status</th><th width="60"></th></tr></thead>
            <tbody>
            <?php foreach ($transactions as $t): ?>
            <tr>
                <td><span class="badge bg-<?= $t['type'] === 'income' ? 'success' : 'danger' ?>"><?= $t['type'] === 'income' ? 'Receita' : 'Despesa' ?></span></td>
                <td><?= e($t['description']) ?></td>
                <td><small><?= e($t['category_name'] ?? '-') ?></small></td>
                <td class="text-<?= $t['type'] === 'income' ? 'success' : 'danger' ?>"><strong><?= formatMoney((float)$t['amount']) ?></strong></td>
                <td><small><?= $t['due_date'] ? formatDate($t['due_date']) : '-' ?></small></td>
                <td><span class="badge bg-<?= $t['status'] === 'paid' ? 'success' : ($t['status'] === 'overdue' ? 'danger' : 'warning') ?>"><?= e($t['status']) ?></span></td>
                <td><form method="POST" action="<?= url('admin/finance/' . $t['id'] . '/delete') ?>" onsubmit="return confirm('Excluir?')"><?= csrfField() ?><button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button></form></td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
