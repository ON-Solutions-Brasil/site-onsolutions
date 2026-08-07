<?php $months = ['', 'Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez']; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="page-title">Relatório Financeiro</h1>
        <p class="page-subtitle">Resumo anual • <?= $year ?></p>
    </div>
    <div class="d-flex gap-2 align-items-center">
        <a href="<?= url('admin/finance/report?year=' . ($year - 1)) ?>" class="btn btn-outline-secondary btn-sm"><i class="bi bi-chevron-left"></i></a>
        <span class="fw-bold"><?= $year ?></span>
        <a href="<?= url('admin/finance/report?year=' . ($year + 1)) ?>" class="btn btn-outline-secondary btn-sm"><i class="bi bi-chevron-right"></i></a>
        <a href="<?= url('admin/finance') ?>" class="btn btn-outline-primary btn-sm ms-2"><i class="bi bi-arrow-left me-1"></i> Voltar</a>
    </div>
</div>

<!-- Totais do ano -->
<?php
$totalIncome = array_sum(array_column($monthly_data, 'income'));
$totalExpense = array_sum(array_column($monthly_data, 'expense'));
$totalBalance = $totalIncome - $totalExpense;
?>
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm"><div class="card-body text-center">
            <span style="font-size: 0.72rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">Total Receitas</span>
            <h3 class="text-success mt-1 mb-0" style="font-size: 1.5rem; font-weight: 800;"><?= formatMoney((float)$totalIncome) ?></h3>
        </div></div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm"><div class="card-body text-center">
            <span style="font-size: 0.72rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">Total Despesas</span>
            <h3 class="text-danger mt-1 mb-0" style="font-size: 1.5rem; font-weight: 800;"><?= formatMoney((float)$totalExpense) ?></h3>
        </div></div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm"><div class="card-body text-center">
            <span style="font-size: 0.72rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">Saldo</span>
            <h3 class="<?= $totalBalance >= 0 ? 'text-success' : 'text-danger' ?> mt-1 mb-0" style="font-size: 1.5rem; font-weight: 800;"><?= formatMoney((float)$totalBalance) ?></h3>
        </div></div>
    </div>
</div>

<!-- Tabela mensal -->
<div class="card border-0 shadow-sm">
    <div class="card-header bg-transparent"><h5 class="mb-0" style="font-size: 1rem;">Demonstrativo Mensal</h5></div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Mês</th>
                    <th class="text-end">Receitas</th>
                    <th class="text-end">Despesas</th>
                    <th class="text-end">Saldo</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($m = 1; $m <= 12; $m++): 
                    $row = $monthly_data[$m];
                ?>
                <tr>
                    <td><strong><?= $months[$m] ?></strong></td>
                    <td class="text-end text-success"><?= formatMoney((float)$row['income']) ?></td>
                    <td class="text-end text-danger"><?= formatMoney((float)$row['expense']) ?></td>
                    <td class="text-end <?= $row['balance'] >= 0 ? 'text-success' : 'text-danger' ?>">
                        <strong><?= formatMoney((float)$row['balance']) ?></strong>
                    </td>
                </tr>
                <?php endfor; ?>
            </tbody>
            <tfoot style="border-top: 2px solid #e2e8f0;">
                <tr>
                    <td><strong>Total</strong></td>
                    <td class="text-end text-success"><strong><?= formatMoney((float)$totalIncome) ?></strong></td>
                    <td class="text-end text-danger"><strong><?= formatMoney((float)$totalExpense) ?></strong></td>
                    <td class="text-end <?= $totalBalance >= 0 ? 'text-success' : 'text-danger' ?>"><strong><?= formatMoney((float)$totalBalance) ?></strong></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
