<div class="page-header d-flex justify-content-between align-items-center">
    <div><h1 class="page-title">Portfólio</h1></div>
    <a href="<?= url('admin/portfolio/create') ?>" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Novo Projeto</a>
</div>

<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead><tr><th>Projeto</th><th>Categoria</th><th>Cliente</th><th>Destaque</th><th>Ativo</th><th width="100">Ações</th></tr></thead>
            <tbody>
            <?php if (empty($items)): ?>
            <tr><td colspan="6" class="text-center py-4 text-muted">Nenhum item no portfólio.</td></tr>
            <?php else: foreach ($items as $item): ?>
            <tr>
                <td><strong><?= e($item['title_pt']) ?></strong></td>
                <td><?= e($item['category_name'] ?? '-') ?></td>
                <td><?= e($item['client_name'] ?? '-') ?></td>
                <td><?= $item['is_featured'] ? '<i class="bi bi-star-fill text-warning"></i>' : '' ?></td>
                <td><span class="badge bg-<?= $item['is_active'] ? 'success' : 'secondary' ?>"><?= $item['is_active'] ? 'Sim' : 'Não' ?></span></td>
                <td>
                    <a href="<?= url('admin/portfolio/' . $item['id'] . '/edit') ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                    <form method="POST" action="<?= url('admin/portfolio/' . $item['id'] . '/delete') ?>" class="d-inline" onsubmit="return confirm('Excluir?')"><?= csrfField() ?><button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button></form>
                </td>
            </tr>
            <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
</div>
