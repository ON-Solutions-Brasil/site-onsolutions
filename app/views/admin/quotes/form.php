<?php
$isEdit = isset($quote);
$title = $isEdit ? e($quote['title']) : 'Novo Orçamento';
?>

<div class="quotes-form-page">
    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title"><?= $isEdit ? 'Editar: ' . $title : 'Novo Orçamento' ?></h1>
            <p class="page-subtitle"><?= $isEdit ? 'Alterar dados do orçamento' : 'Preencha os dados do novo orçamento' ?></p>
        </div>
        <a href="<?= url('admin/quotes') ?>" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left"></i> Voltar</a>
    </div>

    <form method="POST" action="<?= $isEdit ? url('admin/quotes/' . $quote['id'] . '/update') : url('admin/quotes') ?>">
        <?= csrfField() ?>
        <?php if ($isEdit): ?><?= methodField('PUT') ?><?php endif; ?>

        <!-- Informações Gerais -->
        <div class="team-card mb-4">
            <div class="team-card__header">
                <div class="team-card__header-icon">
                    <i class="bi bi-receipt"></i>
                </div>
                <div>
                    <h3 class="team-card__title">Informações Gerais</h3>
                    <p class="team-card__desc">Dados principais da proposta</p>
                </div>
            </div>
            <div class="card-body" style="padding: 1.8rem;">
                <div class="row g-3">
                    <!-- Nome do Orçamento + Cliente -->
                    <div class="col-md-6">
                        <label class="form-label">Nome do Orçamento *</label>
                        <input type="text" class="form-control" name="title" value="<?= e($quote['title'] ?? '') ?>" placeholder="Ex: Proposta Web + E-commerce" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Cliente *</label>
                        <select class="form-select" name="client_id">
                            <option value="">-- Selecione o cliente --</option>
                            <?php foreach ($clients as $c): ?>
                            <option value="<?= $c['id'] ?>" <?= (($quote['client_id'] ?? '') == $c['id']) ? 'selected' : '' ?>>
                                <?= e($c['contact_name']) ?><?= $c['company_name'] ? ' (' . e($c['company_name']) . ')' : '' ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Status + Validade -->
                    <div class="col-md-4">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status">
                            <option value="draft" <?= ($quote['status'] ?? 'draft') === 'draft' ? 'selected' : '' ?>>Rascunho</option>
                            <option value="sent" <?= ($quote['status'] ?? '') === 'sent' ? 'selected' : '' ?>>Enviado</option>
                            <option value="viewed" <?= ($quote['status'] ?? '') === 'viewed' ? 'selected' : '' ?>>Visualizado</option>
                            <option value="accepted" <?= ($quote['status'] ?? '') === 'accepted' ? 'selected' : '' ?>>Aprovado</option>
                            <option value="rejected" <?= ($quote['status'] ?? '') === 'rejected' ? 'selected' : '' ?>>Recusado</option>
                            <option value="expired" <?= ($quote['status'] ?? '') === 'expired' ? 'selected' : '' ?>>Expirado</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Validade</label>
                        <input type="date" class="form-control" name="valid_until" value="<?= e($quote['valid_until'] ?? '') ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Número</label>
                        <input type="text" class="form-control" name="quote_number" value="<?= e($quote['quote_number'] ?? $quote_number ?? '') ?>" <?= $isEdit ? 'readonly' : '' ?>>
                    </div>

                    <!-- Desconto -->
                    <div class="col-md-4">
                        <label class="form-label">Desconto (%)</label>
                        <input type="number" class="form-control" name="discount_percent" value="<?= e($quote['discount_percent'] ?? '0') ?>" min="0" max="100" step="0.01">
                    </div>
                    <div class="col-md-8">
                        <label class="form-label">Descrição / Observações (visível ao cliente)</label>
                        <textarea class="form-control" name="description" rows="2" placeholder="Valores, condições de pagamento, informações importantes..."><?= e($quote['description'] ?? '') ?></textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Blocos de Serviço (Itens) -->
        <div class="team-card mb-4">
            <div class="team-card__header">
                <div class="team-card__header-icon" style="background: linear-gradient(135deg, #0891b2, #06b6d4);">
                    <i class="bi bi-list-check"></i>
                </div>
                <div>
                    <h3 class="team-card__title">Blocos de Serviço</h3>
                    <p class="team-card__desc">Adicione os serviços ou produtos da proposta</p>
                </div>
                <button type="button" class="btn btn-sm btn-primary ms-auto" id="addItemBtn"><i class="bi bi-plus-lg"></i> Adicionar Bloco</button>
            </div>
            <div class="card-body" style="padding: 1.5rem;">
                <div id="itemsContainer">
                    <?php if (!empty($items)): ?>
                    <?php foreach ($items as $i => $item): ?>
                    <div class="quote-item-row">
                        <div class="quote-item-row__fields">
                            <div class="quote-item-row__desc">
                                <label class="form-label">Descrição *</label>
                                <input type="text" class="form-control" name="item_description[]" value="<?= e($item['description']) ?>" required>
                            </div>
                            <div class="quote-item-row__qty">
                                <label class="form-label">Qtd</label>
                                <input type="number" class="form-control" name="item_quantity[]" value="<?= e($item['quantity']) ?>" min="1" step="0.01">
                            </div>
                            <div class="quote-item-row__price">
                                <label class="form-label">Valor Unit.</label>
                                <input type="text" class="form-control" name="item_price[]" value="<?= number_format($item['unit_price'], 2, ',', '.') ?>">
                            </div>
                            <div class="quote-item-row__remove">
                                <button type="button" class="btn btn-sm btn-outline-danger remove-item" title="Remover"><i class="bi bi-x-lg"></i></button>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <div class="quote-item-row">
                        <div class="quote-item-row__fields">
                            <div class="quote-item-row__desc">
                                <label class="form-label">Descrição *</label>
                                <input type="text" class="form-control" name="item_description[]" placeholder="Ex: Landing Page, Sistema Web..." required>
                            </div>
                            <div class="quote-item-row__qty">
                                <label class="form-label">Qtd</label>
                                <input type="number" class="form-control" name="item_quantity[]" value="1" min="1" step="0.01">
                            </div>
                            <div class="quote-item-row__price">
                                <label class="form-label">Valor Unit.</label>
                                <input type="text" class="form-control" name="item_price[]" placeholder="0,00">
                            </div>
                            <div class="quote-item-row__remove">
                                <button type="button" class="btn btn-sm btn-outline-danger remove-item" title="Remover"><i class="bi bi-x-lg"></i></button>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Termos e Condições -->
        <div class="team-card mb-4">
            <div class="team-card__header">
                <div class="team-card__header-icon" style="background: linear-gradient(135deg, #475569, #64748b);">
                    <i class="bi bi-shield-check"></i>
                </div>
                <div>
                    <h3 class="team-card__title">Termos e Condições</h3>
                    <p class="team-card__desc">Condições contratuais da proposta</p>
                </div>
            </div>
            <div class="card-body" style="padding: 1.8rem;">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Notas Internas (não visível ao cliente)</label>
                        <textarea class="form-control" name="notes" rows="3" placeholder="Notas para uso interno..."><?= e($quote['notes'] ?? '') ?></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Termos e Condições (visível ao cliente)</label>
                        <textarea class="form-control" name="terms" rows="3" placeholder="Prazo de entrega, formas de pagamento, garantias..."><?= e($quote['terms'] ?? '') ?></textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Botões -->
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i> <?= $isEdit ? 'Atualizar Orçamento' : 'Criar Orçamento' ?></button>
            <a href="<?= url('admin/quotes') ?>" class="btn btn-outline-secondary">Cancelar</a>
        </div>
    </form>
</div>

<style>
.quote-item-row {
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 10px;
    padding: 1rem 1.2rem;
    margin-bottom: 0.8rem;
    background: rgba(255,255,255,0.02);
    transition: border-color 0.2s ease;
}
.quote-item-row:hover {
    border-color: rgba(13, 148, 136, 0.3);
}
.quote-item-row__fields {
    display: flex;
    gap: 1rem;
    align-items: flex-end;
}
.quote-item-row__desc { flex: 1; }
.quote-item-row__qty { width: 80px; }
.quote-item-row__price { width: 140px; }
.quote-item-row__remove { 
    display: flex;
    align-items: flex-end;
    padding-bottom: 2px;
}
@media (max-width: 768px) {
    .quote-item-row__fields {
        flex-wrap: wrap;
    }
    .quote-item-row__desc { flex: 1 1 100%; }
    .quote-item-row__qty { flex: 1; }
    .quote-item-row__price { flex: 1; }
}
</style>

<script>
document.getElementById('addItemBtn')?.addEventListener('click', function() {
    var container = document.getElementById('itemsContainer');
    var row = document.createElement('div');
    row.className = 'quote-item-row';
    row.innerHTML = '<div class="quote-item-row__fields"><div class="quote-item-row__desc"><label class="form-label">Descrição *</label><input type="text" class="form-control" name="item_description[]" placeholder="Ex: Landing Page, Sistema Web..." required></div><div class="quote-item-row__qty"><label class="form-label">Qtd</label><input type="number" class="form-control" name="item_quantity[]" value="1" min="1" step="0.01"></div><div class="quote-item-row__price"><label class="form-label">Valor Unit.</label><input type="text" class="form-control" name="item_price[]" placeholder="0,00"></div><div class="quote-item-row__remove"><button type="button" class="btn btn-sm btn-outline-danger remove-item" title="Remover"><i class="bi bi-x-lg"></i></button></div></div>';
    container.appendChild(row);
});

document.addEventListener('click', function(e) {
    if (e.target.closest('.remove-item')) {
        var rows = document.querySelectorAll('.quote-item-row');
        if (rows.length > 1) {
            e.target.closest('.quote-item-row').remove();
        }
    }
});
</script>
