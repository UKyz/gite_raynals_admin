<?php
/**
 * Created by PhpStorm.
 * User: victorfauquembergue
 * Date: 20/07/2018
 * Time: 09:31
 */

class Connexion
{

    public static function login($tab) {
        global $bdd;
        $req = $bdd->prepare('SELECT * FROM login WHERE user = :user AND password = :password');
        $req->execute(array(
            'user' => $tab['user'],
            'password' => md5($tab['password'])
        ));

        return $req->fetch();
    }

}