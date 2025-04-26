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

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/animate.css">
</head>
<body class="<?php echo isset($body_class) ? $body_class : ''; ?>">

<header>
    <div class="header-area">
        <div id="sticky-header" class="main-header-area">
            <div class="container">
                <div class="header_bottom_border">
                    <div class="row align-items-center d-flex justify-content-between">
                        <div>
                            <div class="main-menu d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">
                                        <li><a href="index.php?page=accueil">Accueil</a></li>
                                        <li><a href="index.php?page=programme">Programme</a></li>
                                        <li><a href="index.php?page=divisions">Divisions</a></li>
                                        <li><a href="index.php?page=shotguns">Shotguns</a></li>
                                        <li><a href="index.php?page=productions">Productions</a></li>
                                        <li><a href="index.php?page=taxis">Taxis</a></li>
                                        <li><a href="index.php?page=defis">Défis</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none">
                                <a href="#" aria-haspopup="true" role="button" tabindex="0" class="slicknav_btn slicknav_collapsed" style="outline: none;">
                                    <span class="slicknav_icon">
                                        <span class="slicknav_icon-bar"></span>
                                        <span class="slicknav_icon-bar"></span>
                                        <span class="slicknav_icon-bar"></span>
                                    </span>
                                </a>
                                <div class="slicknav_menu">
                                    <nav>
                                        <ul>
                                            <li><a href="index.php?page=accueil">Accueil</a></li>
                                            <li><a href="index.php?page=programme">Programme</a></li>
                                            <li><a href="index.php?page=divisions">Divisions</a></li>
                                            <li><a href="index.php?page=shotguns">Shotguns</a></li>
                                            <li><a href="index.php?page=productions">Productions</a></li>
                                            <li><a href="index.php?page=taxis">Taxis</a></li>
                                            <li><a href="index.php?page=defis">Défis</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- JS -->
<script src="assets/js/gestion_menu.js"></script>
</body>
</html>
