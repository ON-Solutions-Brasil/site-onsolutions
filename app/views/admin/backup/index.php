<div class="backup-page">
    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title">Backups</h1>
            <p class="page-subtitle">Gerenciar backups do banco de dados</p>
        </div>
        <div class="d-flex align-items-center gap-3">
            <div class="team-stat">
                <span class="team-stat__value"><?= count($backups ?? []) ?></span>
                <span class="team-stat__label">backups</span>
            </div>
            <form method="POST" action="<?= url('admin/backup/create') ?>"><?= csrfField() ?><button class="btn btn-primary"><i class="bi bi-cloud-download"></i> Criar Backup</button></form>
        </div>
    </div>

    <?php if (empty($backups)): ?>
    <div class="team-empty">
        <div class="team-empty__icon">
            <i class="bi bi-cloud-download"></i>
        </div>
        <h4>Nenhum backup encontrado</h4>
        <p>Crie o primeiro backup para garantir a segurança dos dados.</p>
    </div>
    <?php else: ?>
    <div class="team-card">
        <div class="team-card__header">
            <div class="team-card__header-icon">
                <i class="bi bi-cloud-download"></i>
            </div>
            <div>
                <h3 class="team-card__title">Histórico de Backups</h3>
                <p class="team-card__desc">Backups do banco de dados disponíveis</p>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0 team-table">
                <thead>
                    <tr>
                        <th>Arquivo</th>
                        <th>Tamanho</th>
                        <th>Tipo</th>
                        <th>Status</th>
                        <th>Data</th>
                        <th width="150">Ações</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($backups as $bk): ?>
                <tr>
                    <td>
                        <div class="team-member">
                            <div class="team-member__avatar">
                                <i class="bi bi-file-earmark-zip" style="font-size: 0.85rem;"></i>
                            </div>
                            <span class="team-member__name"><?= e($bk['filename']) ?></span>
                        </div>
                    </td>
                    <td><span class="team-date"><?= $bk['file_size'] ? formatFileSize((int)$bk['file_size']) : '-' ?></span></td>
                    <td><span class="logs-badge logs-badge--info"><?= e($bk['type']) ?></span></td>
                    <td>
                        <?php if ($bk['status'] === 'completed'): ?>
                        <span class="team-status team-status--active"><span class="team-status__dot"></span> Completo</span>
                        <?php else: ?>
                        <span class="team-status team-status--inactive"><span class="team-status__dot"></span> Falhou</span>
                        <?php endif; ?>
                    </td>
                    <td><span class="team-date"><?= formatDateTime($bk['created_at']) ?></span></td>
                    <td>
                        <div class="team-actions">
                            <?php if ($bk['status'] === 'completed'): ?>
                            <a href="<?= url('admin/backup/' . $bk['filename'] . '/download') ?>" class="team-action-btn team-action-btn--edit" title="Download">
                                <i class="bi bi-download"></i>
                            </a>
                            <form method="POST" action="<?= url('admin/backup/' . $bk['filename'] . '/restore') ?>" class="d-inline" onsubmit="return confirm('Restaurar este backup? Dados atuais serão sobrescritos!')">
                                <?= csrfField() ?>
                                <button class="team-action-btn" style="color: #d97706; border-color: #e2e8f0;" title="Restaurar">
                                    <i class="bi bi-arrow-counterclockwise"></i>
                                </button>
                            </form>
                            <?php endif; ?>
                            <form method="POST" action="<?= url('admin/backup/' . $bk['filename'] . '/delete') ?>" class="d-inline" onsubmit="return confirm('Excluir este backup?')">
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
