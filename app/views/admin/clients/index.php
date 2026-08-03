<div class="page-header d-flex justify-content-between align-items-center">
    <div><h1 class="page-title">Clientes</h1><p class="page-subtitle">Gerenciar cadastro de clientes (CRM)</p></div>
    <a href="<?= url('admin/clients/create') ?>" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Novo Cliente</a>
</div>

<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead><tr><th>Nome</th><th>Empresa</th><th>Email</th><th>Status</th><th>Funil</th><th>Responsável</th><th width="100">Ações</th></tr></thead>
            <tbody>
            <?php if (empty($clients)): ?>
            <tr><td colspan="7" class="text-center py-4 text-muted">Nenhum cliente cadastrado.</td></tr>
            <?php else: foreach ($clients as $client): ?>
            <tr>
                <td><a href="<?= url('admin/clients/' . $client['id']) ?>"><strong><?= e($client['contact_name']) ?></strong></a></td>
                <td><?= e($client['company_name'] ?? '-') ?></td>
                <td><small><?= e($client['email'] ?? '') ?></small></td>
                <td><span class="badge bg-<?= $client['status'] === 'active' ? 'success' : ($client['status'] === 'lead' ? 'info' : 'secondary') ?>"><?= e($client['status']) ?></span></td>
                <td><small><?= e($client['funnel_stage']) ?></small></td>
                <td><small><?= e($client['assigned_name'] ?? '-') ?></small></td>
                <td>
                    <a href="<?= url('admin/clients/' . $client['id'] . '/edit') ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                    <form method="POST" action="<?= url('admin/clients/' . $client['id'] . '/delete') ?>" class="d-inline" onsubmit="return confirm('Excluir?')">
                        <?= csrfField() ?><button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
            <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
</div>
