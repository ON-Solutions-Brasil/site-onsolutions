<div class="clients-page">
    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title">Clientes</h1>
            <p class="page-subtitle">Gerenciar cadastro de clientes (CRM)</p>
        </div>
        <div class="d-flex align-items-center gap-3">
            <div class="team-stat">
                <span class="team-stat__value"><?= count($clients ?? []) ?></span>
                <span class="team-stat__label">clientes</span>
            </div>
            <a href="<?= url('admin/clients/create') ?>" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Novo Cliente</a>
        </div>
    </div>

    <?php if (empty($clients)): ?>
    <div class="team-empty">
        <div class="team-empty__icon">
            <i class="bi bi-people"></i>
        </div>
        <h4>Nenhum cliente cadastrado</h4>
        <p>Adicione o primeiro cliente para começar a gerenciar o CRM.</p>
    </div>
    <?php else: ?>
    <div class="team-card">
        <div class="team-card__header">
            <div class="team-card__header-icon">
                <i class="bi bi-people"></i>
            </div>
            <div>
                <h3 class="team-card__title">Clientes</h3>
                <p class="team-card__desc">Cadastro e funil de relacionamento</p>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0 team-table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Empresa</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Funil</th>
                        <th>Responsável</th>
                        <th width="120">Ações</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($clients as $client): ?>
                <tr>
                    <td>
                        <a href="<?= url('admin/clients/' . $client['id']) ?>" style="text-decoration: none;">
                            <div class="team-member">
                                <div class="team-member__avatar">
                                    <?= strtoupper(substr($client['contact_name'], 0, 1)) ?>
                                </div>
                                <span class="team-member__name"><?= e($client['contact_name']) ?></span>
                            </div>
                        </a>
                    </td>
                    <td><span class="team-date"><?= e($client['company_name'] ?? '-') ?></span></td>
                    <td><span class="team-member__email" style="font-size: 0.82rem;"><?= e($client['email'] ?? '') ?></span></td>
                    <td>
                        <?php if ($client['status'] === 'active'): ?>
                        <span class="team-status team-status--active"><span class="team-status__dot"></span> Ativo</span>
                        <?php elseif ($client['status'] === 'lead'): ?>
                        <span class="logs-badge logs-badge--info">Lead</span>
                        <?php else: ?>
                        <span class="logs-badge logs-badge--secondary"><?= e($client['status']) ?></span>
                        <?php endif; ?>
                    </td>
                    <td><span class="logs-badge logs-badge--primary"><?= e($client['funnel_stage']) ?></span></td>
                    <td><span class="team-date"><?= e($client['assigned_name'] ?? '-') ?></span></td>
                    <td>
                        <div class="team-actions">
                            <a href="<?= url('admin/clients/' . $client['id'] . '/edit') ?>" class="team-action-btn team-action-btn--edit" title="Editar">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form method="POST" action="<?= url('admin/clients/' . $client['id'] . '/delete') ?>" class="d-inline" onsubmit="return confirm('Excluir este cliente?')">
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
