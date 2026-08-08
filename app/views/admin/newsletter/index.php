<div class="newsletter-page">
    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title">Newsletter</h1>
            <p class="page-subtitle">Gerenciar inscritos da newsletter</p>
        </div>
        <div class="d-flex align-items-center gap-3">
            <div class="team-stat">
                <span class="team-stat__value"><?= (int)$total_active ?></span>
                <span class="team-stat__label">inscritos</span>
            </div>
            <a href="<?= url('admin/newsletter/export') ?>" class="btn btn-outline-success btn-sm"><i class="bi bi-download"></i> Exportar CSV</a>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#importModal"><i class="bi bi-upload"></i> Importar</button>
        </div>
    </div>

    <?php if (empty($subscribers)): ?>
    <div class="team-empty">
        <div class="team-empty__icon">
            <i class="bi bi-envelope-paper"></i>
        </div>
        <h4>Nenhum inscrito ainda</h4>
        <p>Os inscritos da newsletter aparecerão aqui conforme se cadastrarem.</p>
    </div>
    <?php else: ?>
    <div class="team-card">
        <div class="team-card__header">
            <div class="team-card__header-icon">
                <i class="bi bi-envelope-paper"></i>
            </div>
            <div>
                <h3 class="team-card__title">Inscritos</h3>
                <p class="team-card__desc">Lista de emails cadastrados na newsletter</p>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0 team-table">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Nome</th>
                        <th>Idioma</th>
                        <th>Fonte</th>
                        <th>Status</th>
                        <th>Inscrito em</th>
                        <th width="60">Ações</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($subscribers as $sub): ?>
                <tr>
                    <td>
                        <div class="team-member">
                            <div class="team-member__avatar">
                                <?= strtoupper(substr($sub['email'], 0, 1)) ?>
                            </div>
                            <span class="team-member__name"><?= e($sub['email']) ?></span>
                        </div>
                    </td>
                    <td><span class="team-date"><?= e($sub['name'] ?? '-') ?></span></td>
                    <td><span class="logs-badge logs-badge--info"><?= strtoupper($sub['language'] ?? 'pt') ?></span></td>
                    <td><span class="logs-module"><?= e($sub['source'] ?? '-') ?></span></td>
                    <td>
                        <span class="team-status team-status--<?= $sub['status'] === 'active' ? 'active' : 'inactive' ?>">
                            <span class="team-status__dot"></span>
                            <?= $sub['status'] === 'active' ? 'Ativo' : 'Inativo' ?>
                        </span>
                    </td>
                    <td><span class="team-date"><?= formatDate($sub['subscribed_at'] ?? $sub['created_at']) ?></span></td>
                    <td>
                        <div class="team-actions">
                            <form method="POST" action="<?= url('admin/newsletter/' . $sub['id'] . '/delete') ?>" onsubmit="return confirm('Remover este inscrito?')">
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

<!-- Modal Import -->
<div class="modal fade" id="importModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="<?= url('admin/newsletter/import') ?>" enctype="multipart/form-data">
                <?= csrfField() ?>
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-upload me-2"></i>Importar Emails</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="text-muted mb-3">Envie um arquivo CSV com as colunas: <code>email</code>, <code>nome</code></p>
                    <input type="file" class="form-control" name="csv_file" accept=".csv" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i> Importar</button>
                </div>
            </form>
        </div>
    </div>
</div>
