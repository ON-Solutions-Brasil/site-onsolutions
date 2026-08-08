<div class="quotes-page">
    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title">Orçamentos</h1>
            <p class="page-subtitle">Gerencie propostas e orçamentos para clientes</p>
        </div>
        <div class="d-flex align-items-center gap-3">
            <div class="team-stat">
                <span class="team-stat__value"><?= count($quotes ?? []) ?></span>
                <span class="team-stat__label">orçamentos</span>
            </div>
            <a href="<?= url('admin/quotes/create') ?>" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Novo Orçamento</a>
        </div>
    </div>

    <?php if (empty($quotes)): ?>
    <div class="team-empty">
        <div class="team-empty__icon">
            <i class="bi bi-receipt"></i>
        </div>
        <h4>Nenhum orçamento cadastrado</h4>
        <p>Crie o primeiro orçamento para enviar a um cliente.</p>
    </div>
    <?php else: ?>
    <div class="team-card">
        <div class="team-card__header">
            <div class="team-card__header-icon">
                <i class="bi bi-receipt"></i>
            </div>
            <div>
                <h3 class="team-card__title">Orçamentos</h3>
                <p class="team-card__desc">Propostas enviadas e em andamento</p>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0 team-table">
                <thead>
                    <tr>
                        <th>Nº</th>
                        <th>Título</th>
                        <th>Cliente</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Validade</th>
                        <th width="80">Ações</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($quotes as $q): ?>
                <tr>
                    <td>
                        <a href="<?= url('admin/quotes/' . $q['id']) ?>" class="team-member__name" style="text-decoration: none;">
                            <?= e($q['quote_number']) ?>
                        </a>
                    </td>
                    <td><span class="team-member__name"><?= e($q['title']) ?></span></td>
                    <td><span class="team-date"><?= e($q['client_name'] ?? '-') ?></span></td>
                    <td><strong style="color: #0f172a;"><?= formatMoney((float)$q['total']) ?></strong></td>
                    <td>
                        <?php if ($q['status'] === 'accepted'): ?>
                        <span class="team-status team-status--active"><span class="team-status__dot"></span> Aceito</span>
                        <?php elseif ($q['status'] === 'sent'): ?>
                        <span class="logs-badge logs-badge--info">Enviado</span>
                        <?php elseif ($q['status'] === 'rejected'): ?>
                        <span class="team-status team-status--inactive"><span class="team-status__dot"></span> Rejeitado</span>
                        <?php else: ?>
                        <span class="logs-badge logs-badge--secondary"><?= e($q['status']) ?></span>
                        <?php endif; ?>
                    </td>
                    <td><span class="team-date"><?= $q['valid_until'] ? formatDate($q['valid_until']) : '-' ?></span></td>
                    <td>
                        <div class="team-actions">
                            <a href="<?= url('admin/quotes/' . $q['id'] . '/edit') ?>" class="team-action-btn team-action-btn--edit" title="Editar">
                                <i class="bi bi-pencil"></i>
                            </a>
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
