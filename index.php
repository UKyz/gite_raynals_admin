<?php

// Initialisation de l'environnement
include('./config/config_init.php');

// Fonctions
//include('./controllers/fonctions.php');

//include('./controllers/action/maj_bdd_manuelle.php');
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
    if (isset($_GET['type']) && $_GET['type'] == "price_confirmation") {
        $smarty->display(_TPL_ . 'modal/price_confirmation.tpl');
    } else if (isset($_GET['type']) && $_GET['type'] == "manage_confirmation") {
        $smarty->display(_TPL_ . 'modal/manage_confirmation.tpl');
    }
} else {
    //$smarty->assign('current_page', "index");
    $smarty->display(_TPL_ . 'pages/page_connexion.tpl');
}

if(isset($_SESSION['u_id']) && !empty($_SESSION['u_id'])){
    $smarty->assign('session_u_id', $_SESSION['u_id']);
}else{
    $smarty->assign('session_u_id', null);
}

$smarty->display(_TPL_ . 'footer.tpl');
