<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="page-title">Páginas</h1>
        <p class="page-subtitle">Gerencie as páginas do site</p>
    </div>
    <a href="<?= url('admin/pages/create') ?>" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i> Nova Página
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Menu</th>
                        <th>Autor</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($pages)): ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">Nenhuma página cadastrada.</td>
                    </tr>
                    <?php else: ?>
                    <?php foreach ($pages as $page): ?>
                    <tr>
                        <td><strong><?= e($page['title_pt']) ?></strong></td>
                        <td><code>/<?= e($page['slug']) ?></code></td>
                        <td>
                            <?php if ($page['status'] === 'published'): ?>
                            <span class="badge bg-success">Publicada</span>
                            <?php elseif ($page['status'] === 'draft'): ?>
                            <span class="badge bg-warning">Rascunho</span>
                            <?php else: ?>
                            <span class="badge bg-secondary">Arquivada</span>
                            <?php endif; ?>
                        </td>
                        <td><?= $page['show_in_menu'] ? '<i class="bi bi-check-circle text-success"></i>' : '<i class="bi bi-x-circle text-muted"></i>' ?></td>
                        <td><?= e($page['author_name'] ?? '-') ?></td>
                        <td>
                            <a href="<?= url('admin/pages/' . $page['id'] . '/edit') ?>" class="btn btn-sm btn-outline-primary" title="Editar">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form method="POST" action="<?= url('admin/pages/' . $page['id'] . '/delete') ?>" class="d-inline" onsubmit="return confirm('Tem certeza que deseja remover esta página?')">
                                <?= csrfField() ?>
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Remover">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
