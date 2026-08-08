<div class="versions-page">
    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title">Versionamento</h1>
            <p class="page-subtitle">Histórico de versões do sistema</p>
        </div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#versionModal">
            <i class="bi bi-plus-lg"></i> Nova Versão
        </button>
    </div>

    <?php if (empty($versions)): ?>
    <div class="versions-empty">
        <div class="versions-empty__icon">
            <i class="bi bi-git"></i>
        </div>
        <h4>Nenhuma versão registrada</h4>
        <p>Registre a primeira versão do sistema para iniciar o histórico.</p>
    </div>
    <?php else: ?>
    <div class="versions-timeline">
        <?php foreach ($versions as $i => $v): ?>
        <div class="version-card <?= $i === 0 ? 'version-card--latest' : '' ?>">
            <div class="version-card__indicator">
                <div class="version-card__dot"></div>
                <?php if ($i < count($versions) - 1): ?>
                <div class="version-card__line"></div>
                <?php endif; ?>
            </div>
            <div class="version-card__content">
                <div class="version-card__header">
                    <div class="version-card__info">
                        <div class="version-card__badge">v<?= e($v['version_number']) ?></div>
                        <h4 class="version-card__title"><?= e($v['title']) ?></h4>
                    </div>
                    <div class="version-card__meta">
                        <span class="version-card__date">
                            <i class="bi bi-calendar3"></i> <?= formatDate($v['released_at']) ?>
                        </span>
                        <span class="version-card__author">
                            <i class="bi bi-person"></i> <?= e($v['released_by_name'] ?? 'Sistema') ?>
                        </span>
                    </div>
                </div>
                <?php if (!empty($v['description'])): ?>
                <p class="version-card__description"><?= e($v['description']) ?></p>
                <?php endif; ?>
                <?php if (!empty($v['changelog'])): ?>
                <div class="version-card__changelog">
                    <div class="version-card__changelog-label">
                        <i class="bi bi-list-check"></i> Changelog
                    </div>
                    <pre class="version-card__changelog-content"><?= e($v['changelog']) ?></pre>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>

<!-- Modal Nova Versão -->
<div class="modal fade" id="versionModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="<?= url('admin/versions') ?>">
                <?= csrfField() ?>
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-git me-2"></i>Nova Versão</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Número</label>
                            <input type="text" class="form-control" name="version_number" placeholder="1.1.0" required>
                        </div>
                        <div class="col-md-8">
                            <label class="form-label">Título</label>
                            <input type="text" class="form-control" name="title" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Descrição</label>
                            <input type="text" class="form-control" name="description">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Changelog</label>
                            <textarea class="form-control" name="changelog" rows="6" placeholder="- Feature X adicionada&#10;- Bug Y corrigido"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i> Registrar Versão</button>
                </div>
            </form>
        </div>
    </div>
</div>
