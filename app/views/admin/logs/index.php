<div class="page-header"><h1 class="page-title">Logs de Atividade</h1><p class="page-subtitle">Registro de todas as ações do sistema</p></div>

<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead><tr><th>Usuário</th><th>Ação</th><th>Módulo</th><th>Descrição</th><th>IP</th><th>Data</th></tr></thead>
            <tbody>
            <?php foreach ($logs as $log): ?>
            <tr>
                <td><?= e($log['user_name'] ?? 'Sistema') ?></td>
                <td><span class="badge bg-secondary"><?= e($log['action']) ?></span></td>
                <td><?= e($log['module']) ?></td>
                <td><small><?= e(truncate($log['description'] ?? '', 80)) ?></small></td>
                <td><small class="text-muted"><?= e($log['ip_address'] ?? '') ?></small></td>
                <td><small><?= formatDateTime($log['created_at']) ?></small></td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
