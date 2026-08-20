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

        <!-- Filtros de status -->
        <div style="padding: 1rem 1.5rem; border-bottom: 1px solid rgba(255,255,255,0.05); display: flex; flex-wrap: wrap; gap: 0.5rem;">
            <button class="quote-filter-btn active" data-filter="all">Todos</button>
            <button class="quote-filter-btn quote-filter-btn--draft" data-filter="draft"><span class="quote-filter-dot" style="background:#64748b;"></span> Rascunho</button>
            <button class="quote-filter-btn quote-filter-btn--sent" data-filter="sent"><span class="quote-filter-dot" style="background:#3b82f6;"></span> Enviado</button>
            <button class="quote-filter-btn quote-filter-btn--viewed" data-filter="viewed"><span class="quote-filter-dot" style="background:#8b5cf6;"></span> Visualizado</button>
            <button class="quote-filter-btn quote-filter-btn--accepted" data-filter="accepted"><span class="quote-filter-dot" style="background:#10b981;"></span> Aprovado</button>
            <button class="quote-filter-btn quote-filter-btn--rejected" data-filter="rejected"><span class="quote-filter-dot" style="background:#ef4444;"></span> Recusado</button>
            <button class="quote-filter-btn quote-filter-btn--expired" data-filter="expired"><span class="quote-filter-dot" style="background:#6b7280;"></span> Expirado</button>
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
                        <th width="120">Ações</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($quotes as $q): ?>
                <tr data-status="<?= e($q['status']) ?>">
                    <td>
                        <a href="<?= url('admin/quotes/' . $q['id']) ?>" class="team-member__name" style="text-decoration: none; color: var(--admin-primary);">
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
                        <?php elseif ($q['status'] === 'viewed'): ?>
                        <span class="logs-badge logs-badge--warning">Visualizado</span>
                        <?php elseif ($q['status'] === 'rejected'): ?>
                        <span class="team-status team-status--inactive"><span class="team-status__dot"></span> Rejeitado</span>
                        <?php elseif ($q['status'] === 'expired'): ?>
                        <span class="logs-badge logs-badge--secondary">Expirado</span>
                        <?php else: ?>
                        <span class="logs-badge logs-badge--secondary">Rascunho</span>
                        <?php endif; ?>
                    </td>
                    <td><span class="team-date"><?= $q['valid_until'] ? formatDate($q['valid_until']) : '-' ?></span></td>
                    <td>
                        <div class="team-actions">
                            <a href="<?= url('admin/quotes/' . $q['id']) ?>" class="team-action-btn team-action-btn--view" title="Ver">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="<?= url('admin/quotes/' . $q['id'] . '/edit') ?>" class="team-action-btn team-action-btn--edit" title="Editar">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form method="POST" action="<?= url('admin/quotes/' . $q['id'] . '/delete') ?>" style="display:inline;" onsubmit="return confirm('Excluir este orçamento?')">
                                <?= csrfField() ?>
                                <button type="submit" class="team-action-btn team-action-btn--delete" title="Excluir">
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

<style>
.quote-filter-btn {
    padding: 0.4rem 0.9rem;
    border-radius: 20px;
    border: 1px solid rgba(255,255,255,0.1);
    background: transparent;
    color: #94a3b8;
    font-size: 0.78rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
}
.quote-filter-btn:hover {
    border-color: rgba(255,255,255,0.2);
    color: #f1f5f9;
}
.quote-filter-btn.active {
    background: var(--admin-primary);
    border-color: var(--admin-primary);
    color: #fff;
    font-weight: 600;
}
.quote-filter-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    display: inline-block;
}
</style>

<script>
document.querySelectorAll('.quote-filter-btn').forEach(function(btn) {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.quote-filter-btn').forEach(function(b) { b.classList.remove('active'); });
        this.classList.add('active');
        var filter = this.dataset.filter;
        document.querySelectorAll('tbody tr[data-status]').forEach(function(row) {
            if (filter === 'all' || row.dataset.status === filter) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
});
</script>
