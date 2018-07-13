<?php
/**
 * Created by PhpStorm.
 * User: victorfauquembergue
 * Date: 10/07/2018
 * Time: 11:24
 */

require('./config/config.php');

if (isset($_POST)) {

    $date_begin = date("Y-m-d", strtotime(str_replace('/', '-', $_POST['date_begin'])));

    $date_end = date("Y-m-d", strtotime(str_replace('/', '-', $_POST['date_end'])));
    $date_end = date("Y-m-d", strtotime($date_end . ' +1 days'));

    $date = $date_begin;

    while ($date != $date_end) {
        $req = $bdd->prepare('SELECT * FROM calendrier WHERE date = :date');
        $req->execute(array('date' => $date));

        $donnees = $req->fetch();

        if ($donnees != null) {
            $req = $bdd->prepare('UPDATE calendrier SET price = :price WHERE date = :date');
            $req->execute(array(
                'date' => $date,
                'price' => $_POST['price']));
        } else {
            $req = $bdd->prepare("INSERT INTO calendrier(date, id_reservation, price)
            VALUES(:date, :id_reservation, :price)");

            $req->execute(array(
                'date' => $date,
                'id_reservation' => 0,
                'price' => $_POST['price']
            ));
        }
        $date = date("Y-m-d", strtotime($date . ' +1 days'));
    }

    echo "<script>document.location.href = './index.php?type=price_confirmation';</script>";
}

?>