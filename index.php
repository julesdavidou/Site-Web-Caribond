<?php

require_once 'config.php';
require_once 'db.php';

$page = isset($_GET['page']) ? $_GET['page'] : 'accueil';

$allowed_pages = ['accueil', 'divisions', 'productions', 'programme', 'shotguns', 'taxis', 'jeu'];

if (!in_array($page, $allowed_pages)) {
    $page = 'accueil';
}

include 'includes/header.php';
include "pages/$page.php";
include 'includes/footer.php';
include 'includes/loader.php';
