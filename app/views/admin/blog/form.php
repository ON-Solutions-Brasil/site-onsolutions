<?php $isEdit = isset($post); ?>
<div class="page-header">
    <h1 class="page-title"><?= $isEdit ? 'Editar Post' : 'Novo Post' ?></h1>
</div>

<form method="POST" action="<?= $isEdit ? url('admin/blog/' . $post['id']) : url('admin/blog') ?>">
    <?= csrfField() ?>
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="mb-3"><label class="form-label">Título (PT) *</label><input type="text" class="form-control" name="title_pt" value="<?= e($post['title_pt'] ?? '') ?>" required></div>
                    <div class="row g-3">
                        <div class="col-md-6"><label class="form-label">Título (EN)</label><input type="text" class="form-control" name="title_en" value="<?= e($post['title_en'] ?? '') ?>"></div>
                        <div class="col-md-6"><label class="form-label">Título (ES)</label><input type="text" class="form-control" name="title_es" value="<?= e($post['title_es'] ?? '') ?>"></div>
                    </div>
                    <div class="mb-3 mt-3"><label class="form-label">Resumo (PT)</label><textarea class="form-control" name="excerpt_pt" rows="2"><?= e($post['excerpt_pt'] ?? '') ?></textarea></div>
                    <div class="mb-3"><label class="form-label">Conteúdo (PT) *</label><textarea class="form-control" name="content_pt" rows="15"><?= e($post['content_pt'] ?? '') ?></textarea></div>
                    <div class="mb-3"><label class="form-label">Conteúdo (EN)</label><textarea class="form-control" name="content_en" rows="8"><?= e($post['content_en'] ?? '') ?></textarea></div>
                    <div class="mb-3"><label class="form-label">Conteúdo (ES)</label><textarea class="form-control" name="content_es" rows="8"><?= e($post['content_es'] ?? '') ?></textarea></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm mb-3">
                <div class="card-body">
                    <h6>Publicação</h6>
                    <div class="mb-3"><label class="form-label">Status</label>
                        <select class="form-select" name="status">
                            <option value="draft" <?= ($post['status'] ?? '') === 'draft' ? 'selected' : '' ?>>Rascunho</option>
                            <option value="published" <?= ($post['status'] ?? '') === 'published' ? 'selected' : '' ?>>Publicado</option>
                            <option value="scheduled" <?= ($post['status'] ?? '') === 'scheduled' ? 'selected' : '' ?>>Agendado</option>
                        </select>
                    </div>
                    <div class="mb-3"><label class="form-label">Categoria</label>
                        <select class="form-select" name="category_id">
                            <option value="">Sem categoria</option>
                            <?php foreach ($categories as $cat): ?>
                            <option value="<?= $cat['id'] ?>" <?= ($post['category_id'] ?? '') == $cat['id'] ? 'selected' : '' ?>><?= e($cat['name_pt']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3"><label class="form-label">Tags (separadas por vírgula)</label><input type="text" class="form-control" name="tags" value="<?= e(implode(', ', array_column($post_tags ?? [], 'name'))) ?>"></div>
                    <div class="mb-3"><label class="form-label">Imagem Destacada (URL)</label><input type="text" class="form-control" name="featured_image" value="<?= e($post['featured_image'] ?? '') ?>"></div>
                    <div class="form-check mb-3"><input type="checkbox" class="form-check-input" name="is_featured" id="is_featured" <?= ($post['is_featured'] ?? 0) ? 'checked' : '' ?>><label class="form-check-label" for="is_featured">Destacar</label></div>
                    <div class="mb-3"><label class="form-label">Agendar para</label><input type="datetime-local" class="form-control" name="scheduled_at" value="<?= e($post['scheduled_at'] ?? '') ?>"></div>
                </div>
            </div>
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h6>SEO</h6>
                    <div class="mb-3"><label class="form-label">Meta Title</label><input type="text" class="form-control" name="meta_title_pt" value="<?= e($post['meta_title_pt'] ?? '') ?>"></div>
                    <div class="mb-3"><label class="form-label">Meta Description</label><textarea class="form-control" name="meta_description_pt" rows="2"><?= e($post['meta_description_pt'] ?? '') ?></textarea></div>
                    <div class="mb-3"><label class="form-label">Keywords</label><input type="text" class="form-control" name="meta_keywords" value="<?= e($post['meta_keywords'] ?? '') ?>"></div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100 mt-3 btn-lg"><i class="bi bi-check-lg"></i> <?= $isEdit ? 'Atualizar' : 'Publicar' ?></button>
        </div>
    </div>
</form>
