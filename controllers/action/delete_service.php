<?php
/**
 * Created by PhpStorm.
 * User: victorfauquembergue
 * Date: 23/07/2018
 * Time: 10:26
 */

Services::deleteService($_POST['id']);

header('Location: ./index.php?type=service_confirmation');