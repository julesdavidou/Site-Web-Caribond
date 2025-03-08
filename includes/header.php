<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title : "Cari’Bond"; ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" href="\img\logo-final.ico" type="image/x-icon">
</head>
<body class="<?php echo isset($body_class) ? $body_class : ''; ?>">

<header>
    <nav>
        <ul>
            <li><a href="index.php?page=accueil">Accueil</a></li>
            <li><a href="index.php?page=programme">Programme</a></li>
            <li><a href="index.php?page=divisions">Divisions</a></li>
            <li><a href="index.php?page=shotguns">Shotguns</a></li>
            <li><a href="index.php?page=productions">Productions</a></li>
            <li><a href="index.php?page=taxis">Taxis</a></li>
        </ul>
    </nav>
</header>
