<div class="quotes-show-page">
    <!-- Header -->
    <div class="page-header d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="page-title">Orçamento: <?= e($quote['title']) ?></h1>
            <p class="page-subtitle"><?= e($quote['quote_number']) ?><?= !empty($quote['contact_name']) ? ' — ' . e($quote['contact_name']) : '' ?><?= !empty($quote['company_name']) ? ' | ' . e($quote['company_name']) : '' ?></p>
        </div>
        <div class="d-flex gap-2">
            <a href="<?= url('admin/quotes/' . $quote['id'] . '/edit') ?>" class="btn btn-primary btn-sm"><i class="bi bi-pencil me-1"></i> Editar</a>
            <a href="<?= url('admin/quotes') ?>" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i> Voltar</a>
        </div>
    </div>

    <div class="row g-4">
        <!-- Coluna principal - Itens -->
        <div class="col-lg-8">
            <!-- Blocos de Serviço -->
            <div class="team-card mb-4">
                <div class="team-card__header">
                    <div class="team-card__header-icon" style="background: linear-gradient(135deg, #0891b2, #06b6d4);">
                        <i class="bi bi-list-check"></i>
                    </div>
                    <div>
                        <h3 class="team-card__title">Blocos de Serviço</h3>
                        <p class="team-card__desc"><?= count($items) ?> item(ns) neste orçamento</p>
                    </div>
                </div>
                <div class="card-body" style="padding: 0;">
                    <?php if (!empty($items)): ?>
                    <?php foreach ($items as $item): ?>
                    <div class="quote-show-item">
                        <div class="quote-show-item__info">
                            <h4 class="quote-show-item__title"><?= e($item['description']) ?></h4>
                            <?php if ($item['quantity'] > 1): ?>
                            <span class="quote-show-item__qty"><?= number_format($item['quantity'], $item['quantity'] == (int)$item['quantity'] ? 0 : 2, ',', '.') ?>x de <?= formatMoney((float)$item['unit_price']) ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="quote-show-item__price">
                            <?= formatMoney((float)$item['total_price']) ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <div class="p-4 text-center text-muted">
                        <i class="bi bi-inbox" style="font-size: 2rem;"></i>
                        <p class="mt-2 mb-0">Nenhum item cadastrado</p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Descrição -->
            <?php if (!empty($quote['description'])): ?>
            <div class="team-card mb-4">
                <div class="team-card__header">
                    <div class="team-card__header-icon" style="background: linear-gradient(135deg, #475569, #64748b);">
                        <i class="bi bi-file-text"></i>
                    </div>
                    <div>
                        <h3 class="team-card__title">Descrição da Proposta</h3>
                    </div>
                </div>
                <div class="card-body" style="padding: 1.5rem;">
                    <p style="color: #94a3b8; line-height: 1.8; white-space: pre-wrap; margin: 0;"><?= e($quote['description']) ?></p>
                </div>
            </div>
            <?php endif; ?>

            <!-- Termos -->
            <?php if (!empty($quote['terms'])): ?>
            <div class="team-card mb-4">
                <div class="team-card__header">
                    <div class="team-card__header-icon" style="background: linear-gradient(135deg, #7c3aed, #8b5cf6);">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <div>
                        <h3 class="team-card__title">Termos e Condições</h3>
                    </div>
                </div>
                <div class="card-body" style="padding: 1.5rem;">
                    <p style="color: #94a3b8; line-height: 1.8; white-space: pre-wrap; margin: 0;"><?= e($quote['terms']) ?></p>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <!-- Sidebar - Resumo e Detalhes -->
        <div class="col-lg-4">
            <!-- Resumo -->
            <div class="team-card mb-4">
                <div class="card-body" style="padding: 1.5rem;">
                    <h4 style="font-size: 0.9rem; font-weight: 700; color: #f1f5f9; margin-bottom: 1rem;">Resumo</h4>
                    <div class="quote-show-summary">
                        <div class="quote-show-summary__row">
                            <span>Status</span>
                            <?php
                            $statusColors = ['draft' => '#64748b', 'sent' => '#3b82f6', 'viewed' => '#8b5cf6', 'accepted' => '#10b981', 'rejected' => '#ef4444', 'expired' => '#6b7280'];
                            $statusLabels = ['draft' => 'Rascunho', 'sent' => 'Enviado', 'viewed' => 'Visualizado', 'accepted' => 'Aceito', 'rejected' => 'Rejeitado', 'expired' => 'Expirado'];
                            ?>
                            <span style="color: <?= $statusColors[$quote['status']] ?? '#64748b' ?>; font-weight: 600;"><?= $statusLabels[$quote['status']] ?? $quote['status'] ?></span>
                        </div>
                        <div class="quote-show-summary__row">
                            <span>Subtotal</span>
                            <span><?= formatMoney((float)($quote['subtotal'] ?? 0)) ?></span>
                        </div>
                        <?php if (($quote['discount_value'] ?? 0) > 0): ?>
                        <div class="quote-show-summary__row">
                            <span>Desconto</span>
                            <span style="color: #10b981;">-<?= formatMoney((float)$quote['discount_value']) ?></span>
                        </div>
                        <?php endif; ?>
                        <?php if (($quote['tax_value'] ?? 0) > 0): ?>
                        <div class="quote-show-summary__row">
                            <span>Impostos</span>
                            <span><?= formatMoney((float)$quote['tax_value']) ?></span>
                        </div>
                        <?php endif; ?>
                        <div class="quote-show-summary__row quote-show-summary__row--total">
                            <span>Valor Final</span>
                            <span style="color: var(--admin-primary); font-size: 1.1rem;"><?= formatMoney((float)($quote['total'] ?? 0)) ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detalhes -->
            <div class="team-card mb-4">
                <div class="card-body" style="padding: 1.5rem;">
                    <h4 style="font-size: 0.9rem; font-weight: 700; color: #f1f5f9; margin-bottom: 1rem;">Detalhes</h4>
                    <div class="quote-show-summary">
                        <div class="quote-show-summary__row">
                            <span>Criado em</span>
                            <span><?= formatDate($quote['created_at'], 'd/m/Y') ?></span>
                        </div>
                        <?php if (!empty($quote['valid_until'])): ?>
                        <div class="quote-show-summary__row">
                            <span>Validade</span>
                            <span><?= formatDate($quote['valid_until'], 'd/m/Y') ?></span>
                        </div>
                        <?php endif; ?>
                        <?php if (!empty($quote['viewed_at'])): ?>
                        <div class="quote-show-summary__row">
                            <span>Visualizado em</span>
                            <span><?= formatDateTime($quote['viewed_at']) ?></span>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Link Público -->
            <?php if (!empty($quote['public_token'])): ?>
            <div class="team-card mb-4" style="border-color: var(--admin-primary);">
                <div class="card-body" style="padding: 1.5rem;">
                    <h4 style="font-size: 0.9rem; font-weight: 700; color: var(--admin-primary); margin-bottom: 0.8rem;">Link público</h4>
                    <div style="background: rgba(13,148,136,0.1); border: 1px solid rgba(13,148,136,0.3); border-radius: 8px; padding: 0.8rem; word-break: break-all;">
                        <a href="<?= BASE_URL . '/orcamento/' . e($quote['public_token']) ?>" target="_blank" style="color: var(--admin-primary); font-size: 0.8rem; text-decoration: none;">
                            <?= BASE_URL . '/orcamento/' . e($quote['public_token']) ?>
                        </a>
                    </div>
                    <button type="button" class="btn btn-outline-primary btn-sm mt-2 w-100" onclick="navigator.clipboard.writeText('<?= BASE_URL . '/orcamento/' . e($quote['public_token']) ?>'); this.innerHTML='<i class=\'bi bi-check-lg\'></i> Copiado!'; setTimeout(() => { this.innerHTML='<i class=\'bi bi-link-45deg\'></i> Copiar link'; }, 2000);">
                        <i class="bi bi-link-45deg"></i> Copiar link
                    </button>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
.quote-show-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.2rem 1.5rem;
    border-bottom: 1px solid rgba(255,255,255,0.05);
    transition: background 0.2s ease;
}
.quote-show-item:last-child { border-bottom: none; }
.quote-show-item:hover { background: rgba(255,255,255,0.02); }
.quote-show-item__title {
    font-size: 0.92rem;
    font-weight: 600;
    color: #f1f5f9;
    margin: 0;
}
.quote-show-item__qty {
    font-size: 0.78rem;
    color: #64748b;
    margin-top: 0.2rem;
    display: block;
}
.quote-show-item__price {
    font-size: 0.95rem;
    font-weight: 700;
    color: var(--admin-primary);
    white-space: nowrap;
}
.quote-show-summary__row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.5rem 0;
    font-size: 0.85rem;
    color: #94a3b8;
}
.quote-show-summary__row--total {
    border-top: 1px solid rgba(255,255,255,0.1);
    margin-top: 0.5rem;
    padding-top: 0.8rem;
    font-weight: 700;
    font-size: 0.95rem;
    color: #f1f5f9;
}
</style>
