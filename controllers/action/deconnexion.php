<?php
/**
 * Created by PhpStorm.
 * User: victorfauquembergue
 * Date: 05/07/2018
 * Time: 12:38
 */

session_start();

$name = $_SESSION['name'];

session_destroy();

header('Location: ./index.php');
