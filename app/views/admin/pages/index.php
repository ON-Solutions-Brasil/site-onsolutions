<div class="pages-page">
    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title">Páginas</h1>
            <p class="page-subtitle">Gerencie as páginas do site</p>
        </div>
        <div class="d-flex align-items-center gap-3">
            <div class="team-stat">
                <span class="team-stat__value"><?= count($pages ?? []) ?></span>
                <span class="team-stat__label">páginas</span>
            </div>
            <a href="<?= url('admin/pages/create') ?>" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Nova Página</a>
        </div>
    </div>

    <?php if (empty($pages)): ?>
    <div class="team-empty">
        <div class="team-empty__icon">
            <i class="bi bi-file-earmark-text"></i>
        </div>
        <h4>Nenhuma página cadastrada</h4>
        <p>Crie a primeira página para exibir no site.</p>
    </div>
    <?php else: ?>
    <div class="team-card">
        <div class="team-card__header">
            <div class="team-card__header-icon">
                <i class="bi bi-file-earmark-text"></i>
            </div>
            <div>
                <h3 class="team-card__title">Páginas do Site</h3>
                <p class="team-card__desc">Páginas estáticas publicadas e rascunhos</p>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0 team-table">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Menu</th>
                        <th>Autor</th>
                        <th width="120">Ações</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($pages as $page): ?>
                <tr>
                    <td>
                        <div class="team-member">
                            <div class="team-member__avatar">
                                <?= strtoupper(substr($page['title_pt'], 0, 1)) ?>
                            </div>
                            <span class="team-member__name"><?= e($page['title_pt']) ?></span>
                        </div>
                    </td>
                    <td><code class="logs-ip">/<?= e($page['slug']) ?></code></td>
                    <td>
                        <?php if ($page['status'] === 'published'): ?>
                        <span class="team-status team-status--active"><span class="team-status__dot"></span> Publicada</span>
                        <?php elseif ($page['status'] === 'draft'): ?>
                        <span class="logs-badge logs-badge--warning">Rascunho</span>
                        <?php else: ?>
                        <span class="logs-badge logs-badge--secondary">Arquivada</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($page['show_in_menu']): ?>
                        <span class="team-status team-status--active"><span class="team-status__dot"></span> Sim</span>
                        <?php else: ?>
                        <span class="team-date">Não</span>
                        <?php endif; ?>
                    </td>
                    <td><span class="team-date"><?= e($page['author_name'] ?? '-') ?></span></td>
                    <td>
                        <div class="team-actions">
                            <a href="<?= url('admin/pages/' . $page['id'] . '/edit') ?>" class="team-action-btn team-action-btn--edit" title="Editar">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form method="POST" action="<?= url('admin/pages/' . $page['id'] . '/delete') ?>" class="d-inline" onsubmit="return confirm('Tem certeza que deseja remover esta página?')">
                                <?= csrfField() ?>
                                <button class="team-action-btn team-action-btn--delete" title="Remover">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php endif; ?>
</div>
