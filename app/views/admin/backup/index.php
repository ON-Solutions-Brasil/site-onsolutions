<div class="page-header d-flex justify-content-between align-items-center">
    <div><h1 class="page-title">Backups</h1><p class="page-subtitle">Gerenciar backups do banco de dados</p></div>
    <form method="POST" action="<?= url('admin/backup/create') ?>"><?= csrfField() ?><button class="btn btn-primary"><i class="bi bi-cloud-download"></i> Criar Backup</button></form>
</div>

<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead><tr><th>Arquivo</th><th>Tamanho</th><th>Tipo</th><th>Status</th><th>Data</th><th width="150">Ações</th></tr></thead>
            <tbody>
            <?php if (empty($backups)): ?>
            <tr><td colspan="6" class="text-center py-4 text-muted">Nenhum backup encontrado.</td></tr>
            <?php else: foreach ($backups as $bk): ?>
            <tr>
                <td><strong><?= e($bk['filename']) ?></strong></td>
                <td><?= $bk['file_size'] ? formatFileSize((int)$bk['file_size']) : '-' ?></td>
                <td><span class="badge bg-info"><?= e($bk['type']) ?></span></td>
                <td><span class="badge bg-<?= $bk['status'] === 'completed' ? 'success' : 'danger' ?>"><?= e($bk['status']) ?></span></td>
                <td><small><?= formatDateTime($bk['created_at']) ?></small></td>
                <td>
                    <?php if ($bk['status'] === 'completed'): ?>
                    <a href="<?= url('admin/backup/' . $bk['filename'] . '/download') ?>" class="btn btn-sm btn-outline-success"><i class="bi bi-download"></i></a>
                    <form method="POST" action="<?= url('admin/backup/' . $bk['filename'] . '/restore') ?>" class="d-inline" onsubmit="return confirm('Restaurar este backup? Dados atuais serão sobrescritos!')"><?= csrfField() ?><button class="btn btn-sm btn-outline-warning"><i class="bi bi-arrow-counterclockwise"></i></button></form>
                    <?php endif; ?>
                    <form method="POST" action="<?= url('admin/backup/' . $bk['filename'] . '/delete') ?>" class="d-inline" onsubmit="return confirm('Excluir?')"><?= csrfField() ?><button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button></form>
                </td>
            </tr>
            <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
</div>
