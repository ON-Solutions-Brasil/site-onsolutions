<div class="page-header d-flex justify-content-between align-items-center">
    <div><h1 class="page-title">Projetos</h1></div>
    <a href="<?= url('admin/projects/create') ?>" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Novo Projeto</a>
</div>

<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead><tr><th>Projeto</th><th>Cliente</th><th>Gerente</th><th>Status</th><th>Prioridade</th><th>Progresso</th><th>Prazo</th><th width="80">Ações</th></tr></thead>
            <tbody>
            <?php if (empty($projects)): ?>
            <tr><td colspan="8" class="text-center py-4 text-muted">Nenhum projeto cadastrado.</td></tr>
            <?php else: foreach ($projects as $p): ?>
            <tr>
                <td><a href="<?= url('admin/projects/' . $p['id']) ?>"><strong><?= e($p['name']) ?></strong></a></td>
                <td><?= e($p['client_name'] ?? '-') ?></td>
                <td><?= e($p['manager_name'] ?? '-') ?></td>
                <td><span class="badge bg-<?= $p['status'] === 'completed' ? 'success' : ($p['status'] === 'in_progress' ? 'primary' : 'secondary') ?>"><?= e($p['status']) ?></span></td>
                <td><span class="badge bg-<?= $p['priority'] === 'urgent' ? 'danger' : ($p['priority'] === 'high' ? 'warning' : 'info') ?>"><?= e($p['priority']) ?></span></td>
                <td><div class="progress" style="width:80px;height:6px;"><div class="progress-bar" style="width:<?= $p['progress_percent'] ?>%"></div></div><small><?= $p['progress_percent'] ?>%</small></td>
                <td><small><?= $p['due_date'] ? formatDate($p['due_date']) : '-' ?></small></td>
                <td><a href="<?= url('admin/projects/' . $p['id'] . '/edit') ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a></td>
            </tr>
            <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
</div>
