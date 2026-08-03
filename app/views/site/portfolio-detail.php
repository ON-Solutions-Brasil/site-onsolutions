<?php $lang = defined('CURRENT_LANG') ? CURRENT_LANG : 'pt'; ?>
<section class="page-hero">
    <div class="container">
        <h1><?= e($item["title_{$lang}"] ?? $item['title_pt']) ?></h1>
        <?php if ($item['client_name']): ?>
        <p>Cliente: <?= e($item['client_name']) ?></p>
        <?php endif; ?>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">
                <?php if ($item['cover_image']): ?>
                <img src="<?= e($item['cover_image']) ?>" alt="" class="img-fluid rounded mb-4" style="width:100%;">
                <?php endif; ?>

                <div class="content-body">
                    <?= $item["description_{$lang}"] ?? $item['description_pt'] ?? '' ?>
                </div>

                <?php if ($item['results_pt']): ?>
                <div class="mt-4 p-4 bg-light rounded">
                    <h4>Resultados</h4>
                    <p><?= nl2br(e($item["results_{$lang}"] ?? $item['results_pt'])) ?></p>
                </div>
                <?php endif; ?>

                <!-- Galeria -->
                <?php if (!empty($images)): ?>
                <div class="mt-4">
                    <h4>Galeria</h4>
                    <div class="row g-2 mt-2">
                        <?php foreach ($images as $img): ?>
                        <div class="col-md-4">
                            <img src="<?= e($img['image_path']) ?>" alt="<?= e($img['caption'] ?? '') ?>" class="img-fluid rounded" loading="lazy">
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm sticky-sidebar">
                    <div class="card-body p-4">
                        <h5>Detalhes</h5>
                        <?php if ($techs = json_decode($item['technologies'] ?? '[]', true)): ?>
                        <div class="mb-3"><strong>Tecnologias:</strong><br>
                            <?php foreach ($techs as $tech): ?>
                            <span class="badge bg-light text-dark mt-1"><?= e($tech) ?></span>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                        <?php if ($item['completed_at']): ?>
                        <p><strong>Conclusão:</strong> <?= formatDate($item['completed_at']) ?></p>
                        <?php endif; ?>
                        <?php if ($item['project_url']): ?>
                        <a href="<?= e($item['project_url']) ?>" target="_blank" class="btn btn-outline-primary w-100 mt-2">Visitar Projeto</a>
                        <?php endif; ?>

                        <?php if (!empty($tags)): ?>
                        <div class="mt-3">
                            <strong>Tags:</strong><br>
                            <?php foreach ($tags as $tag): ?>
                            <span class="badge bg-light text-dark mt-1"><?= e($tag['name']) ?></span>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
