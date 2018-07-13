<?php

if ($_SERVER['SERVER_NAME'] == "localhost" OR $_SERVER['SERVER_NAME'] == "sikia.synology.me"
    OR $_SERVER['SERVER_NAME'] == "192.168.1.59") {
    $host = "localhost";
    $dbname = "gite_raynales";
    $dbuser = "root";
    $dbmdp = "root";
    $dbport = "3306";

    // Afficher les erreurs à l'écran
    ini_set('display_errors', 1);
    // Enregistrer les erreurs dans un fichier de log
    ini_set('log_errors', 1);
    // Nom du fichier qui enregistre les logs (attention aux droits à l'écriture)
    ini_set('error_log', dirname(__file__) . '/log_error_php.txt');
    // Afficher les erreurs et les avertissements
    error_reporting(E_ALL & ~E_NOTICE);

    define("WEBMASTER_EMAIL", 'ccarvalho@sikia.com');

    ini_set('SMTP', 'smtp.gmail.com');
} else {
    $host = ".db.1and1.com";
    $dbname = "";
    $dbuser = "";
    $dbmdp = "";
    $dbport = "3306";

    define("WEBMASTER_EMAIL", '');
}

// Connexion Database
try {
    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
    $bdd = new PDO('mysql:host=' . $host . ';port=' . $dbport . ';dbname=' . $dbname, $dbuser, $dbmdp, $pdo_options);
    $bdd->query("SET NAMES UTF8");
} catch (Exception $e) {
    echo "Problème de connexion à la base de donnée ...<br>";
    die();
}

?>
