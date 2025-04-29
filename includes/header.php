<!doctype html>
<html lang="fr-FR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon/favicon-16x16.png">
    <meta name='robots' content='index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' />
    <style>
        img:is([sizes="auto" i], [sizes^="auto," i]) { contain-intrinsic-size: 3000px 1500px }
    </style>

    <title><?php echo isset($pageTitle) ? $pageTitle : "Cari'Bond"; ?></title>
    
    <!-- meta -->
    <link rel="canonical" href="https://caribond.fr/<?php echo $link; ?>/" />
    <meta property="og:locale" content="fr_FR" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="<?php echo isset($pageTitle) ? $pageTitle : "Cari'Bond"; ?>" />
    <meta property="og:url" content="https://caribond.fr/<?php echo $link; ?>/" />
    <meta property="og:site_name" content="Cari'Bond" />
    <meta property="article:publisher" content="https://www.instagram.com/caribond_/" />

    <!-- css -->
    <base href="/" />
    <link rel='stylesheet' href='/assets/css/block-library.css' media='all' />
    <link rel="stylesheet" href="/assets/css/global-styles.css" media="all">
    <link rel='stylesheet' href='/assets/css/style_init.css' media='all' />
    <link rel='stylesheet' href='/assets/css/style.css' media='all' />
    <link rel='stylesheet' href='/assets/css/chat.css' media='all' />
    
    <!-- js -->
    <script src="/assets/js/jquery.min.js" id="jquery-core-js"></script>
</head>

<body class="page">
    <div id="page" class="site">
        <?php include __DIR__ . '/navigation.php'; ?>