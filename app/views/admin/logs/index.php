<div class="logs-page">
    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title">Logs de Atividade</h1>
            <p class="page-subtitle">Registro de todas as ações do sistema</p>
        </div>
        <div class="d-flex gap-2">
            <div class="logs-stat">
                <span class="logs-stat__value"><?= count($logs) ?></span>
                <span class="logs-stat__label">registros</span>
            </div>
        </div>
    </div>

    <?php if (empty($logs)): ?>
    <div class="logs-empty">
        <div class="logs-empty__icon">
            <i class="bi bi-clock-history"></i>
        </div>
        <h4>Nenhum registro encontrado</h4>
        <p>Os logs de atividade aparecerão aqui conforme o sistema for utilizado.</p>
    </div>
    <?php else: ?>
    <div class="logs-card">
        <div class="logs-card__header">
            <div class="logs-card__header-icon">
                <i class="bi bi-activity"></i>
            </div>
            <div>
                <h3 class="logs-card__title">Atividade Recente</h3>
                <p class="logs-card__desc">Últimas ações registradas no sistema</p>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0 logs-table">
                <thead>
                    <tr>
                        <th>Usuário</th>
                        <th>Ação</th>
                        <th>Módulo</th>
                        <th>Descrição</th>
                        <th>IP</th>
                        <th>Data</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($logs as $log): ?>
                <tr>
                    <td>
                        <div class="logs-user">
                            <div class="logs-user__avatar">
                                <i class="bi bi-person"></i>
                            </div>
                            <span class="logs-user__name"><?= e($log['user_name'] ?? 'Sistema') ?></span>
                        </div>
                    </td>
                    <td>
                        <?php
                        $actionClass = 'secondary';
                        $action = strtolower($log['action'] ?? '');
                        if (str_contains($action, 'login')) $actionClass = 'primary';
                        elseif (str_contains($action, 'create') || str_contains($action, 'add')) $actionClass = 'success';
                        elseif (str_contains($action, 'update') || str_contains($action, 'edit')) $actionClass = 'info';
                        elseif (str_contains($action, 'delete') || str_contains($action, 'remove')) $actionClass = 'danger';
                        elseif (str_contains($action, 'failed') || str_contains($action, 'error')) $actionClass = 'danger';
                        ?>
                        <span class="badge logs-badge logs-badge--<?= $actionClass ?>"><?= e($log['action']) ?></span>
                    </td>
                    <td><span class="logs-module"><?= e($log['module']) ?></span></td>
                    <td><span class="logs-description"><?= e(truncate($log['description'] ?? '', 80)) ?></span></td>
                    <td><code class="logs-ip"><?= e($log['ip_address'] ?? '') ?></code></td>
                    <td><span class="logs-date"><?= formatDateTime($log['created_at']) ?></span></td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php endif; ?>
</div>
