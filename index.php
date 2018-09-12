<?php

// Initialisation de l'environnement
include('./config/config_init.php');

//Variable pour gérer laffichage du portail si Mise en Prod
$mep = false;

// Gestion de Routing
if (isset($_GET['action']) &&
    file_exists(_CTRL_ . 'action/' . str_replace('.', '', $_GET['action']) . '.php')) {
    include(_CTRL_ . 'action/' . $_GET['action'] . '.php');
} else if (isset($_GET['page']) &&
    file_exists(_CTRL_ . str_replace('.', '', $_GET['page']) . '.php') &&
    isset($_SESSION) && $_SESSION['type'] == "gite_domaine_les_reynals") {
    include(_CTRL_ . $_GET['page'] . '.php');
} else if (isset($_SESSION) && $_SESSION['type'] == "gite_domaine_les_reynals") {
    include(_CTRL_ . 'index.php');
}

// Affichage des templates
$smarty->display(_TPL_ . 'header.tpl');

if (isset($_GET['page']) &&
    file_exists(_TPL_ . 'pages/' . str_replace('.', '', $_GET['page']) . '.tpl') &&
    isset($_SESSION) && $_SESSION['type'] == "gite_domaine_les_reynals") {
    $smarty->display(_TPL_ . 'pages/' . $_GET['page'] . '.tpl');
} else if (isset($_SESSION) && $_SESSION['type'] == "gite_domaine_les_reynals") {
    $smarty->display(_TPL_ . 'pages/' . 'index.tpl');
} else {
    $smarty->display(_TPL_ . 'pages/page_connexion.tpl');
}

// Affichage modal
if (isset($_GET['type']) &&
    file_exists(_TPL_ . 'modal/' . str_replace('.', '', $_GET['type']) . '.tpl')) {
    $smarty->display(_TPL_ . 'modal/' . $_GET['type'] . '.tpl');
}

//$smarty->display(_TPL_ . 'footer.tpl');
