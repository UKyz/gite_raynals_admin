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

    $date = $date_begin;

    while ($date != $date_end) {
        $req = $bdd->prepare('SELECT * FROM calendrier WHERE date = :date');
        $req->execute(array('date' => $date));

        $donnees = $req->fetch();

        $id_reservation_before = 0;
        $id_reservation_after = -1;
        if ($_POST['choice'] == "able") {
            $id_reservation_before = -1;
            $id_reservation_after = 0;
        }

        if ($donnees != null) {
            $req = $bdd->prepare('SELECT * FROM calendrier WHERE date = :date AND 
              id_reservation = :id_reservation');
            $req->execute(array(
                'date' => $date,
                'id_reservation' => $id_reservation_before));

            if ($donnees = $req->fetch()) {
                $req = $bdd->prepare('UPDATE calendrier SET id_reservation = :id_reservation WHERE date = :date');
                $req->execute(array(
                    'date' => $date,
                    'id_reservation' => $id_reservation_after));
            }
        } else {
            $req = $bdd->prepare("INSERT INTO calendrier(date, id_reservation, price)
            VALUES(:date, :id_reservation, :price)");

            $req->execute(array(
                'date' => $date,
                'id_reservation' => $id_reservation_after,
                'price' => 0
            ));
        }
        $date = date("Y-m-d", strtotime($date . ' +1 days'));
    }

    echo "<script>document.location.href = './index.php?type=manage_confirmation';</script>";
}