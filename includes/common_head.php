<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title : "Cari’Bond"; ?></title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="img/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/svg+xml" href="img/favicon.svg">
    <link rel="shortcut icon" href="img/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">
    <meta name="apple-mobile-web-app-title" content="Cari’Bond">
    <link rel="manifest" href="img/site.webmanifest">
    <!-- CSS commun -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/animate.css">
</head>
<body class="<?php echo isset($body_class) ? $body_class : ''; ?>">