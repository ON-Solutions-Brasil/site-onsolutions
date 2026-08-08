<!DOCTYPE html>
<html lang="<?= e(defined('CURRENT_LANG') ? CURRENT_LANG : 'pt') ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title><?= e($page_title ?? SITE_NAME) ?></title>
    <meta name="description" content="<?= e($meta_description ?? '') ?>">
    <meta name="keywords" content="<?= e($meta_keywords ?? setting('site_keywords', '')) ?>">
    
    <!-- Open Graph -->
    <meta property="og:title" content="<?= e($page_title ?? SITE_NAME) ?>">
    <meta property="og:description" content="<?= e($meta_description ?? '') ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= e(BASE_URL . $_SERVER['REQUEST_URI']) ?>">
    <?php if (!empty($og_image)): ?>
    <meta property="og:image" content="<?= e($og_image) ?>">
    <?php endif; ?>
    <meta property="og:site_name" content="<?= e(SITE_NAME) ?>">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= e($page_title ?? SITE_NAME) ?>">
    <meta name="twitter:description" content="<?= e($meta_description ?? '') ?>">
    
    <!-- Canonical -->
    <link rel="canonical" href="<?= e(BASE_URL . $_SERVER['REQUEST_URI']) ?>">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?= asset('img/favicon.png') ?>">
    <link rel="apple-touch-icon" href="<?= asset('img/favicon.png') ?>">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?= asset('css/style.css') ?>?v=<?= time() ?>" rel="stylesheet">
    
    <?php if ($ga = setting('google_analytics_id')): ?>
    <!-- Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?= e($ga) ?>"></script>
    <script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','<?= e($ga) ?>');</script>
    <?php endif; ?>

    <?php if ($gtm = setting('google_tag_manager_id')): ?>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','<?= e($gtm) ?>');</script>
    <?php endif; ?>
</head>
<body class="<?= e($body_class ?? '') ?>">
    <?php require APP_PATH . '/views/partials/header.php'; ?>
    
    <main>
        <?= $content ?>
    </main>
    
    <?php require APP_PATH . '/views/partials/footer.php'; ?>
    
    <!-- WhatsApp Button -->
    <?php if (setting('whatsapp_enabled') === '1' && $whatsappNum = setting('whatsapp_number')): ?>
    <a href="https://wa.me/<?= e(preg_replace('/\D/', '', $whatsappNum)) ?>?text=<?= urlencode(setting('whatsapp_message', '')) ?>" 
       class="whatsapp-float" target="_blank" rel="noopener" aria-label="WhatsApp">
        <i class="bi bi-whatsapp"></i>
    </a>
    <?php endif; ?>
    
    <!-- Chatbot -->
    <?php if (setting('chatbot_enabled') === '1'): ?>
    <?php require APP_PATH . '/views/partials/chatbot.php'; ?>
    <?php endif; ?>
    
    <!-- Cookie Banner -->
    <?php require APP_PATH . '/views/partials/cookie-banner.php'; ?>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="<?= asset('js/app.js') ?>"></script>
    
    <?php if (setting('chatbot_enabled') === '1'): ?>
    <script src="<?= asset('js/chatbot.js') ?>"></script>
    <?php endif; ?>
</body>
</html>
