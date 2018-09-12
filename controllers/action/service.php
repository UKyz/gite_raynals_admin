<?php
/**
 * Created by PhpStorm.
 * User: victorfauquembergue
 * Date: 23/07/2018
 * Time: 09:57
 */

if (isset($_POST)) {

    Services::addService($_POST);

    header('Location: ./index.php?type=service_confirmation');
}