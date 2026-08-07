<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="page-title"><?= $type === 'income' ? 'Nova Receita' : 'Nova Despesa' ?></h1>
        <p class="page-subtitle">Registre um novo lançamento financeiro</p>
    </div>
    <a href="<?= url('admin/finance') ?>" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i> Voltar
    </a>
</div>

<form method="POST" action="<?= url('admin/finance/' . ($type === 'income' ? 'income' : 'expense')) ?>">
    <?= csrfField() ?>
    
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Descrição *</label>
                        <input type="text" class="form-control" name="description" required placeholder="Ex: Pagamento projeto X">
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Valor (R$) *</label>
                            <input type="text" class="form-control" name="amount" required placeholder="0,00">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Categoria</label>
                            <select class="form-select" name="category_id">
                                <option value="">Selecione</option>
                                <?php foreach ($categories ?? [] as $cat): ?>
                                <option value="<?= $cat['id'] ?>"><?= e($cat['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row g-3 mt-1">
                        <div class="col-md-6">
                            <label class="form-label">Data de Vencimento</label>
                            <input type="date" class="form-control" name="due_date">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Data de Pagamento</label>
                            <input type="date" class="form-control" name="paid_date">
                        </div>
                    </div>
                    <div class="mb-3 mt-3">
                        <label class="form-label">Observações</label>
                        <textarea class="form-control" name="notes" rows="3" placeholder="Informações adicionais..."></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-transparent">Detalhes</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status">
                            <option value="pending">Pendente</option>
                            <option value="paid">Pago</option>
                            <option value="overdue">Vencido</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Forma de Pagamento</label>
                        <select class="form-select" name="payment_method">
                            <option value="">Selecione</option>
                            <option value="pix">PIX</option>
                            <option value="boleto">Boleto</option>
                            <option value="card">Cartão</option>
                            <option value="transfer">Transferência</option>
                            <option value="cash">Dinheiro</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Cliente</label>
                        <select class="form-select" name="client_id">
                            <option value="">Nenhum</option>
                            <?php foreach ($clients ?? [] as $c): ?>
                            <option value="<?= $c['id'] ?>"><?= e($c['contact_name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Projeto</label>
                        <select class="form-select" name="project_id">
                            <option value="">Nenhum</option>
                            <?php foreach ($projects ?? [] as $p): ?>
                            <option value="<?= $p['id'] ?>"><?= e($p['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-<?= $type === 'income' ? 'success' : 'danger' ?> w-100 mt-3">
                <i class="bi bi-check-lg me-1"></i> Registrar <?= $type === 'income' ? 'Receita' : 'Despesa' ?>
            </button>
        </div>
    </div>
</form>
