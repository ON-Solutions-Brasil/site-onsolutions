<div class="page-header d-flex justify-content-between align-items-center">
    <div><h1 class="page-title">Orçamentos</h1></div>
    <a href="<?= url('admin/quotes/create') ?>" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Novo Orçamento</a>
</div>

<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead><tr><th>Nº</th><th>Título</th><th>Cliente</th><th>Total</th><th>Status</th><th>Validade</th><th width="80">Ações</th></tr></thead>
            <tbody>
            <?php if (empty($quotes)): ?>
            <tr><td colspan="7" class="text-center py-4 text-muted">Nenhum orçamento.</td></tr>
            <?php else: foreach ($quotes as $q): ?>
            <tr>
                <td><a href="<?= url('admin/quotes/' . $q['id']) ?>"><strong><?= e($q['quote_number']) ?></strong></a></td>
                <td><?= e($q['title']) ?></td>
                <td><?= e($q['client_name'] ?? '-') ?></td>
                <td><strong><?= formatMoney((float)$q['total']) ?></strong></td>
                <td><span class="badge bg-<?= $q['status'] === 'accepted' ? 'success' : ($q['status'] === 'sent' ? 'info' : ($q['status'] === 'rejected' ? 'danger' : 'secondary')) ?>"><?= e($q['status']) ?></span></td>
                <td><small><?= $q['valid_until'] ? formatDate($q['valid_until']) : '-' ?></small></td>
                <td><a href="<?= url('admin/quotes/' . $q['id'] . '/edit') ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a></td>
            </tr>
            <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
</div>
