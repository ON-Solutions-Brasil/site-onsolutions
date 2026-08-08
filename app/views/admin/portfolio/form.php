<div class="portfolio-form-page">
    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title"><?= isset($item) ? 'Editar Portfólio' : 'Novo Portfólio' ?></h1>
            <p class="page-subtitle"><?= isset($item) ? 'Alterar dados do projeto no portfólio' : 'Adicione um novo projeto ao portfólio' ?></p>
        </div>
        <a href="<?= url('admin/portfolio') ?>" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left"></i> Voltar</a>
    </div>

    <form method="POST" action="<?= isset($item) ? url('admin/portfolio/' . $item['id'] . '/update') : url('admin/portfolio') ?>">
        <?= csrfField() ?>
        <?php if (isset($item)): ?><?= methodField('PUT') ?><?php endif; ?>

        <!-- Dados Gerais -->
        <div class="team-card mb-4">
            <div class="team-card__header">
                <div class="team-card__header-icon">
                    <i class="bi bi-collection"></i>
                </div>
                <div>
                    <h3 class="team-card__title">Dados do Projeto</h3>
                    <p class="team-card__desc">Informações principais do item de portfólio</p>
                </div>
            </div>
            <div class="card-body" style="padding: 1.8rem;">
                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-label">Título (PT)</label>
                        <input type="text" class="form-control" name="title_pt" value="<?= e($item['title_pt'] ?? '') ?>" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Categoria</label>
                        <div class="custom-select-wrapper">
                            <div class="custom-select" id="categoryCustomSelect">
                                <div class="custom-select__trigger">
                                    <span class="custom-select__value">
                                        <?php
                                        $selectedCatName = '-- Selecione --';
                                        foreach ($categories as $cat) {
                                            if (($item['category_id'] ?? '') == $cat['id']) {
                                                $selectedCatName = $cat['name_pt'];
                                            }
                                        }
                                        echo e($selectedCatName);
                                        ?>
                                    </span>
                                    <i class="bi bi-chevron-down custom-select__arrow"></i>
                                </div>
                                <div class="custom-select__options">
                                    <div class="custom-select__option <?= empty($item['category_id']) ? 'is-selected' : '' ?>" data-value="">-- Selecione --</div>
                                    <?php foreach ($categories as $cat): ?>
                                    <div class="custom-select__option <?= (($item['category_id'] ?? '') == $cat['id']) ? 'is-selected' : '' ?>" data-value="<?= $cat['id'] ?>">
                                        <?= e($cat['name_pt']) ?>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <input type="hidden" name="category_id" value="<?= e($item['category_id'] ?? '') ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Título (EN)</label>
                        <input type="text" class="form-control" name="title_en" value="<?= e($item['title_en'] ?? '') ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Título (ES)</label>
                        <input type="text" class="form-control" name="title_es" value="<?= e($item['title_es'] ?? '') ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Cliente</label>
                        <input type="text" class="form-control" name="client_name" value="<?= e($item['client_name'] ?? '') ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Data de Conclusão</label>
                        <input type="date" class="form-control" name="completed_at" value="<?= e($item['completed_at'] ?? '') ?>">
                    </div>
                    <div class="col-md-3 d-flex align-items-end gap-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_featured" id="isFeatured" <?= ($item['is_featured'] ?? 0) ? 'checked' : '' ?>>
                            <label class="form-check-label" for="isFeatured">Destaque</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_active" id="isActive" <?= ($item['is_active'] ?? 1) ? 'checked' : '' ?>>
                            <label class="form-check-label" for="isActive">Ativo</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Descrição Curta (PT)</label>
                        <input type="text" class="form-control" name="short_description_pt" value="<?= e($item['short_description_pt'] ?? '') ?>">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Descrição Completa (PT)</label>
                        <textarea class="form-control" name="description_pt" rows="4"><?= e($item['description_pt'] ?? '') ?></textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mídia e Links -->
        <div class="team-card mb-4">
            <div class="team-card__header">
                <div class="team-card__header-icon" style="background: linear-gradient(135deg, #0891b2, #06b6d4);">
                    <i class="bi bi-link-45deg"></i>
                </div>
                <div>
                    <h3 class="team-card__title">Mídia e Links</h3>
                    <p class="team-card__desc">Imagens, vídeos e link do projeto</p>
                </div>
            </div>
            <div class="card-body" style="padding: 1.8rem;">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label">Imagem de Capa (URL)</label>
                        <input type="text" class="form-control" name="cover_image" value="<?= e($item['cover_image'] ?? '') ?>" placeholder="https://...">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">URL do Projeto</label>
                        <input type="url" class="form-control" name="project_url" value="<?= e($item['project_url'] ?? '') ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">URL do Vídeo</label>
                        <input type="url" class="form-control" name="video_url" value="<?= e($item['video_url'] ?? '') ?>">
                    </div>
                </div>
            </div>
        </div>

        <!-- Resultados -->
        <div class="team-card mb-4">
            <div class="team-card__header">
                <div class="team-card__header-icon" style="background: linear-gradient(135deg, #059669, #10b981);">
                    <i class="bi bi-graph-up-arrow"></i>
                </div>
                <div>
                    <h3 class="team-card__title">Resultados</h3>
                    <p class="team-card__desc">Resultados e métricas alcançadas</p>
                </div>
            </div>
            <div class="card-body" style="padding: 1.8rem;">
                <textarea class="form-control" name="results_pt" rows="3" placeholder="Descreva os resultados obtidos com este projeto..."><?= e($item['results_pt'] ?? '') ?></textarea>
            </div>
        </div>

        <!-- Botão Salvar -->
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i> <?= isset($item) ? 'Atualizar' : 'Criar Portfólio' ?></button>
            <a href="<?= url('admin/portfolio') ?>" class="btn btn-outline-secondary">Cancelar</a>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.custom-select').forEach(function(cs) {
        var trigger = cs.querySelector('.custom-select__trigger');
        var valueEl = cs.querySelector('.custom-select__value');
        var hiddenInput = cs.closest('.custom-select-wrapper').querySelector('input[type="hidden"]');

        trigger.addEventListener('click', function(e) {
            e.stopPropagation();
            document.querySelectorAll('.custom-select.is-open').forEach(function(s) {
                if (s !== cs) s.classList.remove('is-open');
            });
            cs.classList.toggle('is-open');
        });

        cs.querySelectorAll('.custom-select__option').forEach(function(opt) {
            opt.addEventListener('click', function(e) {
                e.stopPropagation();
                cs.querySelectorAll('.custom-select__option').forEach(function(o) { o.classList.remove('is-selected'); });
                opt.classList.add('is-selected');
                valueEl.textContent = opt.textContent.trim();
                if (hiddenInput) hiddenInput.value = opt.getAttribute('data-value');
                cs.classList.remove('is-open');
            });
        });
    });

    document.addEventListener('click', function() {
        document.querySelectorAll('.custom-select.is-open').forEach(function(s) { s.classList.remove('is-open'); });
    });
});
</script>
