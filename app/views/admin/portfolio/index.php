<div class="portfolio-page">
    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title">Portfólio</h1>
            <p class="page-subtitle">Gerencie os projetos exibidos no site</p>
        </div>
        <div class="d-flex align-items-center gap-3">
            <div class="team-stat">
                <span class="team-stat__value"><?= count($items ?? []) ?></span>
                <span class="team-stat__label">projetos</span>
            </div>
            <a href="<?= url('admin/portfolio/create') ?>" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Novo Projeto</a>
        </div>
    </div>

    <?php if (empty($items)): ?>
    <div class="team-empty">
        <div class="team-empty__icon">
            <i class="bi bi-collection"></i>
        </div>
        <h4>Nenhum item no portfólio</h4>
        <p>Adicione projetos para exibir no portfólio do site.</p>
    </div>
    <?php else: ?>
    <div class="team-card">
        <div class="team-card__header">
            <div class="team-card__header-icon">
                <i class="bi bi-collection"></i>
            </div>
            <div>
                <h3 class="team-card__title">Projetos do Portfólio</h3>
                <p class="team-card__desc">Trabalhos realizados exibidos publicamente</p>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0 team-table">
                <thead>
                    <tr>
                        <th>Projeto</th>
                        <th>Categoria</th>
                        <th>Cliente</th>
                        <th>Destaque</th>
                        <th>Status</th>
                        <th width="120">Ações</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($items as $item): ?>
                <tr>
                    <td>
                        <div class="team-member">
                            <div class="team-member__avatar">
                                <?= strtoupper(substr($item['title_pt'], 0, 1)) ?>
                            </div>
                            <span class="team-member__name"><?= e($item['title_pt']) ?></span>
                        </div>
                    </td>
                    <td><span class="logs-badge logs-badge--info"><?= e($item['category_name'] ?? '-') ?></span></td>
                    <td><span class="team-date"><?= e($item['client_name'] ?? '-') ?></span></td>
                    <td>
                        <?php if ($item['is_featured']): ?>
                        <span class="logs-badge logs-badge--warning"><i class="bi bi-star-fill"></i> Destaque</span>
                        <?php else: ?>
                        <span class="team-date">—</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <span class="team-status team-status--<?= $item['is_active'] ? 'active' : 'inactive' ?>">
                            <span class="team-status__dot"></span>
                            <?= $item['is_active'] ? 'Ativo' : 'Inativo' ?>
                        </span>
                    </td>
                    <td>
                        <div class="team-actions">
                            <a href="<?= url('admin/portfolio/' . $item['id'] . '/edit') ?>" class="team-action-btn team-action-btn--edit" title="Editar">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form method="POST" action="<?= url('admin/portfolio/' . $item['id'] . '/delete') ?>" class="d-inline" onsubmit="return confirm('Excluir este projeto?')">
                                <?= csrfField() ?>
                                <button class="team-action-btn team-action-btn--delete" title="Excluir">
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
