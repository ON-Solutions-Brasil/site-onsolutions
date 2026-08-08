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
<div class="team-card">
    <div class="team-card__header">
        <div class="team-card__header-icon">
            <i class="bi bi-calendar3"></i>
        </div>
        <div>
            <h3 class="team-card__title">Demonstrativo Mensal</h3>
            <p class="team-card__desc">Receitas, despesas e saldo por mês em <?= $year ?></p>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0 team-table">
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
                    <td><span class="team-member__name"><?= $months[$m] ?></span></td>
                    <td class="text-end" style="color: #059669; font-weight: 600;"><?= formatMoney((float)$row['income']) ?></td>
                    <td class="text-end" style="color: #dc2626; font-weight: 600;"><?= formatMoney((float)$row['expense']) ?></td>
                    <td class="text-end <?= $row['balance'] >= 0 ? '' : '' ?>" style="color: <?= $row['balance'] >= 0 ? '#059669' : '#dc2626' ?>; font-weight: 700;">
                        <?= formatMoney((float)$row['balance']) ?>
                    </td>
                </tr>
                <?php endfor; ?>
            </tbody>
            <tfoot style="border-top: 2px solid #e2e8f0; background: #f8fafc;">
                <tr>
                    <td><strong style="font-size: 0.88rem; color: #0f172a;">Total</strong></td>
                    <td class="text-end" style="color: #059669; font-weight: 800;"><?= formatMoney((float)$totalIncome) ?></td>
                    <td class="text-end" style="color: #dc2626; font-weight: 800;"><?= formatMoney((float)$totalExpense) ?></td>
                    <td class="text-end" style="color: <?= $totalBalance >= 0 ? '#059669' : '#dc2626' ?>; font-weight: 800;"><?= formatMoney((float)$totalBalance) ?></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
