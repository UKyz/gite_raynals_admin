<?php
/**
 * Created by PhpStorm.
 * User: victorfauquembergue
 * Date: 17/07/2018
 * Time: 12:17
 */

if (isset($_POST)) {

    $date_begin = date("Y-m-d", strtotime(str_replace('/', '-', $_POST['date_begin'])));

    $date_end = date("Y-m-d", strtotime(str_replace('/', '-', $_POST['date_end'])));
    $date_end = date("Y-m-d", strtotime($date_end . ' +1 days'));

    Calendrier::manageDays($date_begin, $date_end, $_POST['choice'], $_POST['price']);

    header('Location: ./index.php?type=manage_confirmation');
}