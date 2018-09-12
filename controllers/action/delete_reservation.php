<?php
/**
 * Created by PhpStorm.
 * User: victorfauquembergue
 * Date: 24/08/2018
 * Time: 16:41
 */

Reservations::deleteReservation($_POST['id']);

header('Location: ./index.php?type=delete_reservation');