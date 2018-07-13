<?php
/**
 * Created by PhpStorm.
 * User: victorfauquembergue
 * Date: 05/07/2018
 * Time: 11:32
 */

try {
    $bdd = new PDO('mysql:host=localhost;dbname=domaine_les_reynals;charset=utf8', 'root',
        'admin', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$req = $bdd->prepare('SELECT * FROM login WHERE id = :id');
$req->execute(array(
    'id' => 1,
));

$donnes = $req->fetch();

echo $donnes['name'];

?>