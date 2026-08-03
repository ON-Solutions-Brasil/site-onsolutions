<div class="page-header d-flex justify-content-between align-items-center">
    <div><h1 class="page-title">Newsletter</h1><p class="page-subtitle"><?= (int)$total_active ?> inscritos ativos</p></div>
    <div class="d-flex gap-2">
        <a href="<?= url('admin/newsletter/export') ?>" class="btn btn-outline-success"><i class="bi bi-download"></i> Exportar CSV</a>
        <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#importModal"><i class="bi bi-upload"></i> Importar</button>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead><tr><th>Email</th><th>Nome</th><th>Idioma</th><th>Fonte</th><th>Status</th><th>Inscrito em</th><th width="60">Ações</th></tr></thead>
            <tbody>
            <?php foreach ($subscribers as $sub): ?>
            <tr>
                <td><?= e($sub['email']) ?></td>
                <td><?= e($sub['name'] ?? '-') ?></td>
                <td><?= strtoupper($sub['language'] ?? 'pt') ?></td>
                <td><small><?= e($sub['source'] ?? '-') ?></small></td>
                <td><span class="badge bg-<?= $sub['status'] === 'active' ? 'success' : 'secondary' ?>"><?= e($sub['status']) ?></span></td>
                <td><small><?= formatDate($sub['subscribed_at'] ?? $sub['created_at']) ?></small></td>
                <td>
                    <form method="POST" action="<?= url('admin/newsletter/' . $sub['id'] . '/delete') ?>" onsubmit="return confirm('Remover?')"><?= csrfField() ?><button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button></form>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Import -->
<div class="modal fade" id="importModal" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
    <form method="POST" action="<?= url('admin/newsletter/import') ?>" enctype="multipart/form-data">
        <?= csrfField() ?>
        <div class="modal-header"><h5>Importar Emails</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
        <div class="modal-body"><p class="text-muted">CSV com colunas: email, nome</p><input type="file" class="form-control" name="csv_file" accept=".csv" required></div>
        <div class="modal-footer"><button type="submit" class="btn btn-primary">Importar</button></div>
    </form>
</div></div></div>
