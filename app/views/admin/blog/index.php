<div class="page-header d-flex justify-content-between align-items-center">
    <div><h1 class="page-title">Blog</h1><p class="page-subtitle">Gerenciar posts do blog</p></div>
    <div class="d-flex gap-2">
        <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#aiModal"><i class="bi bi-robot"></i> Gerar com IA</button>
        <a href="<?= url('admin/blog/create') ?>" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Novo Post</a>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead><tr><th>Título</th><th>Categoria</th><th>Autor</th><th>Status</th><th>IA</th><th>Data</th><th width="100">Ações</th></tr></thead>
            <tbody>
            <?php if (empty($posts)): ?>
            <tr><td colspan="7" class="text-center py-4 text-muted">Nenhum post encontrado.</td></tr>
            <?php else: ?>
            <?php foreach ($posts as $post): ?>
            <tr>
                <td><strong><?= e($post['title_pt']) ?></strong><br><small class="text-muted">/blog/<?= e($post['slug']) ?></small></td>
                <td><?= e($post['category_name'] ?? '-') ?></td>
                <td><?= e($post['author_name'] ?? '-') ?></td>
                <td><span class="badge bg-<?= $post['status'] === 'published' ? 'success' : ($post['status'] === 'draft' ? 'warning' : 'info') ?>"><?= e($post['status']) ?></span></td>
                <td><?= $post['generated_by_ai'] ? '<i class="bi bi-robot text-primary"></i>' : '' ?></td>
                <td><small><?= $post['published_at'] ? formatDate($post['published_at']) : formatDate($post['created_at']) ?></small></td>
                <td>
                    <a href="<?= url('admin/blog/' . $post['id'] . '/edit') ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                    <form method="POST" action="<?= url('admin/blog/' . $post['id'] . '/delete') ?>" class="d-inline" onsubmit="return confirm('Excluir este post?')">
                        <?= csrfField() ?>
                        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
            <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal IA -->
<div class="modal fade" id="aiModal" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
    <div class="modal-header"><h5 class="modal-title"><i class="bi bi-robot"></i> Gerar Post com IA</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
    <div class="modal-body">
        <div class="mb-3"><label class="form-label">Tema do Artigo</label><input type="text" class="form-control" id="aiTopic" placeholder="Ex: Benefícios de sistemas ERP personalizados"></div>
        <div id="aiResult" class="d-none"><div class="alert alert-success" id="aiMessage"></div></div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary" id="generateBtn"><i class="bi bi-magic"></i> Gerar</button>
    </div>
</div></div></div>

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
