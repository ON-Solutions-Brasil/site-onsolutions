<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($page_title ?? 'Admin - ' . SITE_NAME) ?></title>
    <link rel="icon" type="image/png" href="<?= asset('img/favicon.png') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="<?= asset('css/admin.css') ?>?v=<?= time() ?>" rel="stylesheet">
</head>
<body class="admin-body">
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <?php require APP_PATH . '/views/partials/admin-sidebar.php'; ?>
        
        <!-- Main Content -->
        <div class="admin-main">
            <!-- Top Bar -->
            <?php require APP_PATH . '/views/partials/admin-topbar.php'; ?>
            
            <!-- Content -->
            <div class="admin-content">
                <?php $flash = flash(); ?>
                <?php if ($flash): ?>
                <div class="alert alert-<?= e($flash['type']) ?> alert-dismissible fade show" role="alert">
                    <?= e($flash['message']) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                </div>
                <?php endif; ?>
                
                <?= $content ?>
            </div>
        </div>
    </div>
    
    <!-- Modal de Confirmação On Solutions -->
    <div class="os-confirm-overlay" id="osConfirmOverlay">
        <div class="os-confirm-modal">
            <div class="os-confirm-icon">
                <i class="bi bi-exclamation-triangle"></i>
            </div>
            <h4 class="os-confirm-title">Confirmar Ação</h4>
            <p class="os-confirm-message" id="osConfirmMessage">Tem certeza que deseja continuar?</p>
            <div class="os-confirm-actions">
                <button class="os-confirm-btn os-confirm-btn--cancel" id="osConfirmCancel">Cancelar</button>
                <button class="os-confirm-btn os-confirm-btn--confirm" id="osConfirmOk">Confirmar</button>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= asset('js/admin.js') ?>?v=<?= time() ?>"></script>
</body>
</html>
