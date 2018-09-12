<?php
/**
 * Created by PhpStorm.
 * User: victorfauquembergue
 * Date: 17/07/2018
 * Time: 10:17
 */

class Calendrier
{
    public static function mainCalendar() {
        $script_calendar = "";

        global $bdd;
        $req = $bdd->query('SELECT * FROM calendrier ORDER BY date');

        while ($donnees = $req->fetch()) {
            if ($donnees['id_reservation'] == -1) {
                $script_calendar .= "demoPicker.disabledDates = [
                    new Date('" . $donnees['date'] . "')
                ];";
            } else if ($donnees['id_reservation'] > 0) {
                $script_calendar .= "demoPicker.highlight = [{
                    start: new Date('" . $donnees['date'] . "'),
                    end: new Date('" . $donnees['date'] . "'),
                    backgroundColor: '#05676E',
                    color: '#fff',
                    legend: 'Réservé'
                }];";
            }
        }

        $req = $bdd->prepare('SELECT * FROM reservations WHERE status = :status ORDER BY date_begin');
        $req->execute(array('status' => 'en attente'));

        while ($donnees = $req->fetch()) {

            $date_begin = date("Y-m-d", strtotime(str_replace('/', '-', $donnees['date_begin'])));

            $date_end = date("Y-m-d", strtotime(str_replace('/', '-', $donnees['date_end'])));

            $date = $date_begin;

            while ($date != $date_end) {
                $script_calendar .= "demoPicker.highlight = [{
                    start: new Date('" . $date . "'),
                    end: new Date('" . $date . "'),
                    backgroundColor: '#ffea00',
                    color: '#000',
                    legend: 'En attente'
                }];";
                $date = date("Y-m-d", strtotime($date . ' +1 days'));
            }
        }

        return $script_calendar;
    }

    public static function priceCalendar() {

        $script_calendrier = "";

        global $bdd;
        $req = $bdd->query('SELECT * FROM calendrier ORDER BY date');

        while ($donnees = $req->fetch()) {
            if ($donnees['id_reservation'] == 0) {
                $script_calendrier .= "demoPicker2.tooltips = [{
                    date : new Date('" . $donnees['date'] . "'),
                    text : '" . $donnees['price'] . "€'
                }];";
            } else if ($donnees['id_reservation'] == -1) {
                $script_calendrier .= "demoPicker2.disabledDates = [
                    new Date('" . $donnees['date'] . "')
                ];";
            } else if ($donnees['id_reservation'] > 0) {
                $script_calendrier .= "demoPicker2.highlight = [{
                    start: new Date('" . $donnees['date'] . "'),
                    end: new Date('" . $donnees['date'] . "'),
                    backgroundColor: '#05676E',
                    color: '#fff',
                    legend: 'Réservé'
                }];";
            }
        }

        return $script_calendrier;
    }

    public static function availableCalendar() {
        $script_calendrier = "";

        global $bdd;
        $req = $bdd->query('SELECT * FROM calendrier ORDER BY date');

        while ($donnees = $req->fetch()) {
            if ($donnees['id_reservation'] == -1) {
                $script_calendrier .= "demoPicker3.disabledDates = [
                    new Date('" . $donnees['date'] . "')
                ];";
            } else if ($donnees['id_reservation'] > 0) {
                $script_calendrier .= "demoPicker3.highlight = [{
                    start: new Date('" . $donnees['date'] . "'),
                    end: new Date('" . $donnees['date'] . "'),
                    backgroundColor: '#05676E',
                    color: '#fff',
                    legend: 'Réservé'
                }];";
            }
        }

        return $script_calendrier;
    }

    public static function acceptReservation($id) {
        global $bdd;
        $req = $bdd->prepare('SELECT * FROM reservations WHERE id = :id');
        $req->execute(array(
            'id' => $id));

        $donnees = $req->fetch();

        $date_begin = date("Y-m-d", strtotime(str_replace('/', '-', $donnees['date_begin'])));

        $date_end = date("Y-m-d", strtotime(str_replace('/', '-', $donnees['date_end'])));

        $date = $date_begin;

        while ($date != $date_end) {
            $req = $bdd->prepare('SELECT * FROM calendrier WHERE date = :date');
            $req->execute(array('date' => $date));

            $donnees = $req->fetch();

            if ($donnees != null) {
                $req = $bdd->prepare('UPDATE calendrier SET id_reservation = :id_reservation WHERE date = :date');
                $req->execute(array(
                    'date' => $date,
                    'id_reservation' => $_POST['id']));
            } else {
                $req = $bdd->prepare("INSERT INTO calendrier(date, id_reservation, price)
            VALUES(:date, :id_reservation, :price)");

                $req->execute(array(
                    'date' => $date,
                    'id_reservation' => $_POST['id'],
                    'price' => 0
                ));
            }
            $date = date("Y-m-d", strtotime($date . ' +1 days'));
        }
    }

    public static function manageDays($date_begin, $date_end, $choice, $price) {
        $date = $date_begin;

        while ($date != $date_end) {
            global $bdd;
            $req = $bdd->prepare('SELECT * FROM calendrier WHERE date = :date');
            $req->execute(array('date' => $date));

            $donnees = $req->fetch();

            $id_reservation_after = -1;
            if ($choice == "able") {
                $id_reservation_after = 0;
            }

            if ($donnees != null) {
                $req = $bdd->prepare('SELECT * FROM calendrier WHERE date = :date');
                $req->execute(array(
                    'date' => $date));

                if ($donnees = $req->fetch()) {
                    $req = $bdd->prepare('UPDATE calendrier SET 
                        id_reservation = :id_reservation, price = :price WHERE date = :date');
                    $req->execute(array(
                        'date' => $date,
                        'id_reservation' => $id_reservation_after,
                        'price' => $price));
                }
            } else {
                $req = $bdd->prepare("INSERT INTO calendrier(date, id_reservation, price)
            VALUES(:date, :id_reservation, :price)");

                $req->execute(array(
                    'date' => $date,
                    'id_reservation' => $id_reservation_after,
                    'price' => $price
                ));
            }
            $date = date("Y-m-d", strtotime($date . ' +1 days'));
        }
    }

    public static function dayPassed() {
        global $bdd;
        $req = $bdd->prepare('DELETE FROM calendrier WHERE date < :date');
        $req->execute(array(
            'date' => date('Y-m-j')
        ));
    }

}