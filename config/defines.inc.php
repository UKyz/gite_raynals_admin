<?php

// Si on a pas ces infos, rien ne peut fonctionner : die
if (!isset($_SERVER['DOCUMENT_ROOT'])) {
    die();
}

//SERVEUR DE TESTS
if ($_SERVER['SERVER_NAME'] == "localhost" OR $_SERVER['SERVER_NAME'] == "sikia.synology.me"
    OR $_SERVER['SERVER_NAME'] == "192.168.1.59") {
    // Define de la racine du site
    define('_PATH_', $_SERVER['DOCUMENT_ROOT'] . '/'._ROOT_.'/');

    //Défini le serveur d'envoie de mail
    ini_set('SMTP', 'smtp.free.fr');
}//PROD
else {
    // Define de la racine du site
    define('_PATH_', $_SERVER['DOCUMENT_ROOT'] . '/');
}

// Define du dossier Coeur
define('_CORE_', _PATH_ . 'core/');

// Define du dossier des Controleurs
define('_CTRL_', _PATH_ . 'controllers/');

// Define du dossier des Configs
define('_CONFIG_', _PATH_ . 'config/');

// Define du dossier des TPL
define('_TPL_', _PATH_ . 'tpl/');

// Define du dossier des logs
define('_LOGS_', _PATH_ . 'logs/');
