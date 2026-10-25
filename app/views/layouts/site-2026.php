<!DOCTYPE html>
<html lang="<?= e(defined('CURRENT_LANG') ? CURRENT_LANG : 'pt') ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="#0B1220">

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

    <!-- Google Fonts: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons (reutilizado do projeto) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- Tema 2026 (escopado em body.theme-2026) -->
    <link href="<?= asset('css/theme-2026.css') ?>?v=<?= time() ?>" rel="stylesheet">

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
<body class="theme-2026 <?= e($body_class ?? '') ?>">
    <a class="skip" href="#conteudo"><?= __('home2026.skip_to_content') ?></a>

    <?php require APP_PATH . '/views/partials/header-2026.php'; ?>

    <main id="conteudo" class="view" data-service="">
        <?= $content ?>
    </main>

    <?php require APP_PATH . '/views/partials/footer-2026.php'; ?>

    <!-- Cookie Banner (reutilizado do projeto) -->
    <?php require APP_PATH . '/views/partials/cookie-banner.php'; ?>

    <!-- JS do tema 2026 -->
    <script src="<?= asset('js/home-2026.js') ?>?v=<?= time() ?>"></script>
</body>
</html>
