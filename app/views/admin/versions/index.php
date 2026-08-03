<div class="page-header d-flex justify-content-between align-items-center">
    <div><h1 class="page-title">Versionamento</h1><p class="page-subtitle">Histórico de versões do sistema</p></div>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#versionModal"><i class="bi bi-plus-lg"></i> Nova Versão</button>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <?php if (empty($versions)): ?>
        <p class="text-center text-muted py-4">Nenhuma versão registrada.</p>
        <?php else: ?>
        <div class="timeline">
            <?php foreach ($versions as $v): ?>
            <div class="timeline-item mb-4 pb-4 border-bottom">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h5 class="mb-1"><span class="badge bg-primary me-2">v<?= e($v['version_number']) ?></span> <?= e($v['title']) ?></h5>
                        <p class="text-muted mb-1"><?= e($v['description'] ?? '') ?></p>
                        <?php if ($v['changelog']): ?>
                        <pre class="bg-light p-3 rounded mt-2" style="font-size:0.85rem;"><?= e($v['changelog']) ?></pre>
                        <?php endif; ?>
                    </div>
                    <small class="text-muted"><?= formatDate($v['released_at']) ?><br>por <?= e($v['released_by_name'] ?? 'Sistema') ?></small>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</div>

<!-- Modal Nova Versão -->
<div class="modal fade" id="versionModal" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
    <form method="POST" action="<?= url('admin/versions') ?>">
        <?= csrfField() ?>
        <div class="modal-header"><h5>Nova Versão</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
        <div class="modal-body">
            <div class="mb-3"><label class="form-label">Número</label><input type="text" class="form-control" name="version_number" placeholder="1.1.0" required></div>
            <div class="mb-3"><label class="form-label">Título</label><input type="text" class="form-control" name="title" required></div>
            <div class="mb-3"><label class="form-label">Descrição</label><input type="text" class="form-control" name="description"></div>
            <div class="mb-3"><label class="form-label">Changelog</label><textarea class="form-control" name="changelog" rows="6" placeholder="- Feature X adicionada&#10;- Bug Y corrigido"></textarea></div>
        </div>
        <div class="modal-footer"><button type="submit" class="btn btn-primary">Registrar Versão</button></div>
    </form>
</div></div></div>
