<div class="quotes-form-page">
    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title"><?= isset($quote) ? 'Editar Orçamento' : 'Novo Orçamento' ?></h1>
            <p class="page-subtitle"><?= isset($quote) ? 'Alterar dados do orçamento #' . e($quote['quote_number']) : 'Preencha os dados do novo orçamento' ?></p>
        </div>
        <a href="<?= url('admin/quotes') ?>" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left"></i> Voltar</a>
    </div>

    <form method="POST" action="<?= isset($quote) ? url('admin/quotes/' . $quote['id'] . '/update') : url('admin/quotes') ?>">
        <?= csrfField() ?>
        <?php if (isset($quote)): ?><?= methodField('PUT') ?><?php endif; ?>

        <!-- Dados Gerais -->
        <div class="team-card mb-4">
            <div class="team-card__header">
                <div class="team-card__header-icon">
                    <i class="bi bi-receipt"></i>
                </div>
                <div>
                    <h3 class="team-card__title">Dados do Orçamento</h3>
                    <p class="team-card__desc">Informações gerais da proposta</p>
                </div>
            </div>
            <div class="card-body" style="padding: 1.8rem;">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Número</label>
                        <input type="text" class="form-control" name="quote_number" value="<?= e($quote['quote_number'] ?? $quote_number ?? '') ?>" <?= isset($quote) ? 'readonly' : '' ?>>
                    </div>
                    <div class="col-md-5">
                        <label class="form-label">Título</label>
                        <input type="text" class="form-control" name="title" value="<?= e($quote['title'] ?? '') ?>" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Cliente</label>
                        <select class="form-select" name="client_id">
                            <option value="">-- Selecione --</option>
                            <?php foreach ($clients as $c): ?>
                            <option value="<?= $c['id'] ?>" <?= (($quote['client_id'] ?? '') == $c['id']) ? 'selected' : '' ?>>
                                <?= e($c['contact_name']) ?><?= $c['company_name'] ? ' (' . e($c['company_name']) . ')' : '' ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Validade</label>
                        <input type="date" class="form-control" name="valid_until" value="<?= e($quote['valid_until'] ?? '') ?>">
                    </div>
                    <?php if (isset($quote)): ?>
                    <div class="col-md-4">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status">
                            <option value="draft" <?= ($quote['status'] ?? '') === 'draft' ? 'selected' : '' ?>>Rascunho</option>
                            <option value="sent" <?= ($quote['status'] ?? '') === 'sent' ? 'selected' : '' ?>>Enviado</option>
                            <option value="accepted" <?= ($quote['status'] ?? '') === 'accepted' ? 'selected' : '' ?>>Aceito</option>
                            <option value="rejected" <?= ($quote['status'] ?? '') === 'rejected' ? 'selected' : '' ?>>Rejeitado</option>
                        </select>
                    </div>
                    <?php endif; ?>
                    <div class="col-12">
                        <label class="form-label">Descrição</label>
                        <textarea class="form-control" name="description" rows="2"><?= e($quote['description'] ?? '') ?></textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Itens -->
        <div class="team-card mb-4">
            <div class="team-card__header">
                <div class="team-card__header-icon" style="background: linear-gradient(135deg, #0891b2, #06b6d4);">
                    <i class="bi bi-list-check"></i>
                </div>
                <div>
                    <h3 class="team-card__title">Itens do Orçamento</h3>
                    <p class="team-card__desc">Adicione os serviços ou produtos da proposta</p>
                </div>
                <button type="button" class="btn btn-sm btn-outline-primary ms-auto" id="addItemBtn"><i class="bi bi-plus-lg"></i> Adicionar Item</button>
            </div>
            <div class="card-body" style="padding: 1.8rem;">
                <div id="itemsContainer">
                    <?php if (!empty($items)): ?>
                    <?php foreach ($items as $i => $item): ?>
                    <div class="quote-item-row row g-2 mb-2 align-items-end">
                        <div class="col-md-6">
                            <label class="form-label">Descrição</label>
                            <input type="text" class="form-control" name="item_description[]" value="<?= e($item['description']) ?>" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Qtd</label>
                            <input type="number" class="form-control" name="item_quantity[]" value="<?= e($item['quantity']) ?>" min="1" step="0.01">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Preço Unit.</label>
                            <input type="text" class="form-control" name="item_price[]" value="<?= number_format($item['unit_price'], 2, ',', '.') ?>">
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-sm btn-outline-danger remove-item"><i class="bi bi-trash"></i></button>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <div class="quote-item-row row g-2 mb-2 align-items-end">
                        <div class="col-md-6">
                            <label class="form-label">Descrição</label>
                            <input type="text" class="form-control" name="item_description[]" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Qtd</label>
                            <input type="number" class="form-control" name="item_quantity[]" value="1" min="1" step="0.01">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Preço Unit.</label>
                            <input type="text" class="form-control" name="item_price[]" placeholder="0,00">
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-sm btn-outline-danger remove-item"><i class="bi bi-trash"></i></button>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Observações -->
        <div class="team-card mb-4">
            <div class="team-card__header">
                <div class="team-card__header-icon" style="background: linear-gradient(135deg, #475569, #64748b);">
                    <i class="bi bi-card-text"></i>
                </div>
                <div>
                    <h3 class="team-card__title">Observações e Termos</h3>
                    <p class="team-card__desc">Informações adicionais para o cliente</p>
                </div>
            </div>
            <div class="card-body" style="padding: 1.8rem;">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Notas Internas</label>
                        <textarea class="form-control" name="notes" rows="3"><?= e($quote['notes'] ?? '') ?></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Termos e Condições</label>
                        <textarea class="form-control" name="terms" rows="3"><?= e($quote['terms'] ?? '') ?></textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Botão Salvar -->
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i> <?= isset($quote) ? 'Atualizar Orçamento' : 'Criar Orçamento' ?></button>
            <a href="<?= url('admin/quotes') ?>" class="btn btn-outline-secondary">Cancelar</a>
        </div>
    </form>
</div>

<script>
document.getElementById('addItemBtn')?.addEventListener('click', function() {
    const container = document.getElementById('itemsContainer');
    const row = document.createElement('div');
    row.className = 'quote-item-row row g-2 mb-2 align-items-end';
    row.innerHTML = `
        <div class="col-md-6"><input type="text" class="form-control" name="item_description[]" placeholder="Descrição do item" required></div>
        <div class="col-md-2"><input type="number" class="form-control" name="item_quantity[]" value="1" min="1" step="0.01"></div>
        <div class="col-md-3"><input type="text" class="form-control" name="item_price[]" placeholder="0,00"></div>
        <div class="col-md-1"><button type="button" class="btn btn-sm btn-outline-danger remove-item"><i class="bi bi-trash"></i></button></div>
    `;
    container.appendChild(row);
});

document.addEventListener('click', function(e) {
    if (e.target.closest('.remove-item')) {
        const rows = document.querySelectorAll('.quote-item-row');
        if (rows.length > 1) {
            e.target.closest('.quote-item-row').remove();
        }
    }
});
</script>
