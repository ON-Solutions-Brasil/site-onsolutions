<?php $item = $page_item ?? null; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="page-title"><?= $item ? 'Editar Página' : 'Nova Página' ?></h1>
        <p class="page-subtitle"><?= $item ? 'Atualize os dados da página' : 'Crie uma nova página para o site' ?></p>
    </div>
    <a href="<?= url('admin/pages') ?>" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Voltar
    </a>
</div>

<form method="POST" action="<?= $item ? url('admin/pages/' . $item['id']) : url('admin/pages') ?>">
    <?= csrfField() ?>
    
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Título (PT) *</label>
                        <input type="text" class="form-control" name="title_pt" value="<?= e($item['title_pt'] ?? '') ?>" required>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Título (EN)</label>
                            <input type="text" class="form-control" name="title_en" value="<?= e($item['title_en'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Título (ES)</label>
                            <input type="text" class="form-control" name="title_es" value="<?= e($item['title_es'] ?? '') ?>">
                        </div>
                    </div>
                    <div class="mb-3 mt-3">
                        <label class="form-label">Slug</label>
                        <input type="text" class="form-control" name="slug" value="<?= e($item['slug'] ?? '') ?>" placeholder="gerado-automaticamente">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Conteúdo (PT)</label>
                        <textarea class="form-control" name="content_pt" rows="12"><?= e($item['content_pt'] ?? '') ?></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-transparent">Configurações</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status">
                            <option value="draft" <?= ($item['status'] ?? '') === 'draft' ? 'selected' : '' ?>>Rascunho</option>
                            <option value="published" <?= ($item['status'] ?? '') === 'published' ? 'selected' : '' ?>>Publicada</option>
                            <option value="archived" <?= ($item['status'] ?? '') === 'archived' ? 'selected' : '' ?>>Arquivada</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Template</label>
                        <select class="form-select" name="template">
                            <option value="default" <?= ($item['template'] ?? '') === 'default' ? 'selected' : '' ?>>Padrão</option>
                            <option value="full-width" <?= ($item['template'] ?? '') === 'full-width' ? 'selected' : '' ?>>Largura Total</option>
                            <option value="landing" <?= ($item['template'] ?? '') === 'landing' ? 'selected' : '' ?>>Landing Page</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Página Pai</label>
                        <select class="form-select" name="parent_id">
                            <option value="">Nenhuma</option>
                            <?php foreach ($pages_list ?? [] as $p): ?>
                            <option value="<?= $p['id'] ?>" <?= ($item['parent_id'] ?? '') == $p['id'] ? 'selected' : '' ?>><?= e($p['title_pt']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ordem no Menu</label>
                        <input type="number" class="form-control" name="menu_order" value="<?= e($item['menu_order'] ?? 0) ?>">
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="show_in_menu" id="showInMenu" <?= ($item['show_in_menu'] ?? 0) ? 'checked' : '' ?>>
                        <label class="form-check-label" for="showInMenu">Exibir no menu</label>
                    </div>
                    <hr>
                    <div class="mb-3">
                        <label class="form-label">Meta Title</label>
                        <input type="text" class="form-control" name="meta_title_pt" value="<?= e($item['meta_title_pt'] ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Meta Description</label>
                        <textarea class="form-control" name="meta_description_pt" rows="3"><?= e($item['meta_description_pt'] ?? '') ?></textarea>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100 mt-3">
                <i class="bi bi-check-lg me-1"></i> <?= $item ? 'Atualizar Página' : 'Criar Página' ?>
            </button>
        </div>
    </div>
</form>
