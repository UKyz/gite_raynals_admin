<?php

// Initialisation de la session
session_start();
header("Cache-Control: no-cache");

//Défini le répertoire racine
define('_ROOT_', "gite_raynals_back");

// Chargement Smarty et Defines
require('defines.inc.php');

require(_PATH_ . 'web/tools/smarty/Smarty.class.php');
date_default_timezone_set('Europe/Paris');

// Chargement du coeur
$files = scandir(_CORE_);

foreach ($files as $filename)
{
    if (is_file(_CORE_.$filename))
        require_once(_CORE_.$filename);
}

// Connexion Database
try {
    if ($_SERVER['SERVER_NAME'] == "localhost" OR $_SERVER['SERVER_NAME'] == "sikia.synology.me"
        OR $_SERVER['SERVER_NAME'] == "192.168.1.59") {
        $host = "localhost";
        $dbname = "domaine_les_reynals";
        $dbuser = "root";
        $dbmdp = "admin";
        $dbport = "3306";
    } else {
//        $host = "db474181553.db.1and1.com";
//        $dbname = "db474181553";
//        $dbuser = "dbo474181553";
//        $dbmdp = "Yua6rbGQ";
//        $dbport = "3306";
    }
    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
    $bdd = new PDO("mysql:host=".$host.";port=".$dbport.";dbname=".$dbname, $dbuser, $dbmdp, $pdo_options);
    $bdd->query("SET NAMES UTF8");
} catch (Exception $e) {
    echo "Problème de connexion à la base de donnée ...<br>".$e;
    die();
}

// Initialisation Smarty
$smarty = new Smarty();
?>