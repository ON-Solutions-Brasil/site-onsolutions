<?php $item = $page_item ?? null; ?>

<div class="pages-form-page">
    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title"><?= $item ? 'Editar Página' : 'Nova Página' ?></h1>
            <p class="page-subtitle"><?= $item ? 'Atualize os dados da página' : 'Crie uma nova página para o site' ?></p>
        </div>
        <a href="<?= url('admin/pages') ?>" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left"></i> Voltar</a>
    </div>

    <form method="POST" action="<?= $item ? url('admin/pages/' . $item['id']) : url('admin/pages') ?>">
        <?= csrfField() ?>

        <div class="row g-4">
            <!-- Conteúdo Principal -->
            <div class="col-lg-8">
                <div class="team-card mb-4">
                    <div class="team-card__header">
                        <div class="team-card__header-icon">
                            <i class="bi bi-file-earmark-text"></i>
                        </div>
                        <div>
                            <h3 class="team-card__title">Conteúdo da Página</h3>
                            <p class="team-card__desc">Título, slug e conteúdo em múltiplos idiomas</p>
                        </div>
                    </div>
                    <div class="card-body" style="padding: 1.8rem;">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">Título (PT) *</label>
                                <input type="text" class="form-control" name="title_pt" value="<?= e($item['title_pt'] ?? '') ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Título (EN)</label>
                                <input type="text" class="form-control" name="title_en" value="<?= e($item['title_en'] ?? '') ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Título (ES)</label>
                                <input type="text" class="form-control" name="title_es" value="<?= e($item['title_es'] ?? '') ?>">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Slug</label>
                                <input type="text" class="form-control" name="slug" value="<?= e($item['slug'] ?? '') ?>" placeholder="gerado-automaticamente">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Conteúdo (PT)</label>
                                <textarea class="form-control" name="content_pt" rows="12"><?= e($item['content_pt'] ?? '') ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Configurações -->
            <div class="col-lg-4">
                <div class="team-card mb-4">
                    <div class="team-card__header">
                        <div class="team-card__header-icon" style="background: linear-gradient(135deg, #475569, #64748b);">
                            <i class="bi bi-gear"></i>
                        </div>
                        <div>
                            <h3 class="team-card__title">Configurações</h3>
                            <p class="team-card__desc">Status, template e menu</p>
                        </div>
                    </div>
                    <div class="card-body" style="padding: 1.8rem;">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">Status</label>
                                <select class="form-select" name="status">
                                    <option value="draft" <?= ($item['status'] ?? '') === 'draft' ? 'selected' : '' ?>>Rascunho</option>
                                    <option value="published" <?= ($item['status'] ?? '') === 'published' ? 'selected' : '' ?>>Publicada</option>
                                    <option value="archived" <?= ($item['status'] ?? '') === 'archived' ? 'selected' : '' ?>>Arquivada</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Template</label>
                                <select class="form-select" name="template">
                                    <option value="default" <?= ($item['template'] ?? '') === 'default' ? 'selected' : '' ?>>Padrão</option>
                                    <option value="full-width" <?= ($item['template'] ?? '') === 'full-width' ? 'selected' : '' ?>>Largura Total</option>
                                    <option value="landing" <?= ($item['template'] ?? '') === 'landing' ? 'selected' : '' ?>>Landing Page</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Página Pai</label>
                                <select class="form-select" name="parent_id">
                                    <option value="">Nenhuma</option>
                                    <?php foreach ($pages_list ?? [] as $p): ?>
                                    <option value="<?= $p['id'] ?>" <?= ($item['parent_id'] ?? '') == $p['id'] ? 'selected' : '' ?>><?= e($p['title_pt']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Ordem no Menu</label>
                                <input type="number" class="form-control" name="menu_order" value="<?= e($item['menu_order'] ?? 0) ?>">
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="show_in_menu" id="showInMenu" <?= ($item['show_in_menu'] ?? 0) ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="showInMenu">Exibir no menu</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="team-card mb-4">
                    <div class="team-card__header">
                        <div class="team-card__header-icon" style="background: linear-gradient(135deg, #059669, #10b981);">
                            <i class="bi bi-search"></i>
                        </div>
                        <div>
                            <h3 class="team-card__title">SEO</h3>
                            <p class="team-card__desc">Otimização para buscadores</p>
                        </div>
                    </div>
                    <div class="card-body" style="padding: 1.8rem;">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">Meta Title</label>
                                <input type="text" class="form-control" name="meta_title_pt" value="<?= e($item['meta_title_pt'] ?? '') ?>">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Meta Description</label>
                                <textarea class="form-control" name="meta_description_pt" rows="3"><?= e($item['meta_description_pt'] ?? '') ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-check-lg"></i> <?= $item ? 'Atualizar Página' : 'Criar Página' ?>
                </button>
            </div>
        </div>
    </form>
</div>
