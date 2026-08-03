<?php $lang = defined('CURRENT_LANG') ? CURRENT_LANG : 'pt'; ?>
<section class="page-hero">
    <div class="container">
        <h1><?= e($service["title_{$lang}"] ?? $service['title_pt']) ?></h1>
        <p><?= e($service["short_description_{$lang}"] ?? $service['short_description_pt']) ?></p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">
                <div class="content-body">
                    <?= $service["content_{$lang}"] ?? $service['content_pt'] ?? '' ?>
                </div>

                <?php if ($features = json_decode($service['features'] ?? '[]', true)): ?>
                <div class="mt-5">
                    <h3>Funcionalidades</h3>
                    <div class="row g-3 mt-2">
                        <?php foreach ($features as $feature): ?>
                        <div class="col-md-6">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-check-circle-fill text-success me-2 mt-1"></i>
                                <span><?= e($feature) ?></span>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ($techs = json_decode($service['technologies'] ?? '[]', true)): ?>
                <div class="mt-5">
                    <h3>Tecnologias Utilizadas</h3>
                    <div class="tech-tags mt-2">
                        <?php foreach ($techs as $tech): ?>
                        <span class="badge bg-light text-dark"><?= e($tech) ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm sticky-sidebar">
                    <div class="card-body p-4">
                        <h4>Solicitar Orçamento</h4>
                        <p class="text-muted">Precisa deste serviço? Entre em contato.</p>
                        <a href="<?= url('contato') ?>" class="btn btn-primary w-100 mb-2">Fale Conosco</a>
                        <?php if ($whatsapp = setting('whatsapp_number')): ?>
                        <a href="https://wa.me/<?= preg_replace('/\D/', '', $whatsapp) ?>" class="btn btn-success w-100" target="_blank">
                            <i class="bi bi-whatsapp"></i> WhatsApp
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
