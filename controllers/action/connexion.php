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

    $donnes = $req->fetch();

    if ($donnes == null) {
        echo "<script>alert(\"Pseudo ou Mot De Passe inccorecte.\");document.location.href ='#'</script>";
    } else {
        $_SESSION['user'] = $donnes['user'];
        $_SESSION['type'] = "gite_domaine_les_reynals";
        $_SESSION['name'] = $donnes['name'];
    }

    header("Location: ./?page=index");
}