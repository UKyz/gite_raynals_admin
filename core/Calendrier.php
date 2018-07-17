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
}