<div class="blog-page">
    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title">Blog</h1>
            <p class="page-subtitle">Gerenciar posts do blog</p>
        </div>
        <div class="d-flex align-items-center gap-3">
            <div class="team-stat">
                <span class="team-stat__value"><?= count($posts ?? []) ?></span>
                <span class="team-stat__label">posts</span>
            </div>
            <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#aiModal"><i class="bi bi-robot"></i> Gerar com IA</button>
            <a href="<?= url('admin/blog/create') ?>" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Novo Post</a>
        </div>
    </div>

    <?php if (empty($posts)): ?>
    <div class="team-empty">
        <div class="team-empty__icon">
            <i class="bi bi-journal-richtext"></i>
        </div>
        <h4>Nenhum post encontrado</h4>
        <p>Crie o primeiro artigo do blog ou gere automaticamente com IA.</p>
    </div>
    <?php else: ?>
    <div class="team-card">
        <div class="team-card__header">
            <div class="team-card__header-icon">
                <i class="bi bi-journal-richtext"></i>
            </div>
            <div>
                <h3 class="team-card__title">Artigos do Blog</h3>
                <p class="team-card__desc">Posts publicados, rascunhos e agendados</p>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0 team-table">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Categoria</th>
                        <th>Autor</th>
                        <th>Status</th>
                        <th>IA</th>
                        <th>Data</th>
                        <th width="120">Ações</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($posts as $post): ?>
                <tr>
                    <td>
                        <div class="team-member">
                            <div class="team-member__avatar">
                                <?= strtoupper(substr($post['title_pt'], 0, 1)) ?>
                            </div>
                            <div class="team-member__info">
                                <span class="team-member__name"><?= e($post['title_pt']) ?></span>
                                <span class="team-member__email">/blog/<?= e($post['slug']) ?></span>
                            </div>
                        </div>
                    </td>
                    <td><span class="logs-badge logs-badge--info"><?= e($post['category_name'] ?? '-') ?></span></td>
                    <td><span class="team-date"><?= e($post['author_name'] ?? '-') ?></span></td>
                    <td>
                        <?php if ($post['status'] === 'published'): ?>
                        <span class="team-status team-status--active"><span class="team-status__dot"></span> Publicado</span>
                        <?php elseif ($post['status'] === 'draft'): ?>
                        <span class="logs-badge logs-badge--warning">Rascunho</span>
                        <?php else: ?>
                        <span class="logs-badge logs-badge--secondary"><?= e($post['status']) ?></span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($post['generated_by_ai']): ?>
                        <span class="logs-badge logs-badge--primary"><i class="bi bi-robot"></i> IA</span>
                        <?php else: ?>
                        <span class="team-date">—</span>
                        <?php endif; ?>
                    </td>
                    <td><span class="team-date"><?= $post['published_at'] ? formatDate($post['published_at']) : formatDate($post['created_at']) ?></span></td>
                    <td>
                        <div class="team-actions">
                            <a href="<?= url('admin/blog/' . $post['id'] . '/edit') ?>" class="team-action-btn team-action-btn--edit" title="Editar">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form method="POST" action="<?= url('admin/blog/' . $post['id'] . '/delete') ?>" class="d-inline" onsubmit="return confirm('Excluir este post?')">
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

<!-- Modal IA -->
<div class="modal fade" id="aiModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-robot me-2"></i>Gerar Post com IA</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Tema do Artigo</label>
                    <input type="text" class="form-control" id="aiTopic" placeholder="Ex: Benefícios de sistemas ERP personalizados">
                </div>
                <div id="aiResult" class="d-none">
                    <div class="alert alert-success" id="aiMessage"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="generateBtn"><i class="bi bi-magic"></i> Gerar</button>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('generateBtn')?.addEventListener('click', function() {
    const topic = document.getElementById('aiTopic').value;
    if (!topic) { alert('Informe o tema.'); return; }
    this.disabled = true; this.innerHTML = '<i class="bi bi-hourglass"></i> Gerando...';
    const formData = new FormData();
    formData.append('topic', topic);
    formData.append('_token', '<?= e($_SESSION['csrf_token'] ?? '') ?>');
    fetch('<?= url("admin/blog/generate-ai") ?>', { method: 'POST', body: formData })
        .then(r => r.json()).then(data => {
            document.getElementById('aiResult').classList.remove('d-none');
            document.getElementById('aiMessage').textContent = data.message;
            if (data.success && data.post_id) { setTimeout(() => location.href = '<?= url("admin/blog/") ?>' + data.post_id + '/edit', 1500); }
            this.disabled = false; this.innerHTML = '<i class="bi bi-magic"></i> Gerar';
        }).catch(() => { this.disabled = false; this.innerHTML = '<i class="bi bi-magic"></i> Gerar'; });
});
</script>
