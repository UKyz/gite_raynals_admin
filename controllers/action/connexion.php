<?php
/**
 * Created by PhpStorm.
 * User: victorfauquembergue
 * Date: 16/07/2018
 * Time: 12:05
 */

if (isset($_POST) and !empty($_POST)) {
    $req = $bdd->prepare('SELECT * FROM login WHERE user = :user AND password = :password');
    $req->execute(array(
        'user' => $_POST['user'],
        'password' => md5($_POST['password'])
    ));

    $donnees = $req->fetch();

    if (!isset($donnees['user'])) {
        header("Location: ./index.php?type=login_fail");
    } else {
        $_SESSION['user'] = $donnees['user'];
        $_SESSION['type'] = "gite_domaine_les_reynals";
        $_SESSION['name'] = $donnees['name'];
        header("Location: ./?page=index");
    }
}