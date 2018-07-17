<?php
/**
 * Created by PhpStorm.
 * User: victorfauquembergue
 * Date: 17/07/2018
 * Time: 11:01
 */

class Reservations
{
    public static function demandReservations() {
        $script_reservations = "";

        global $bdd;
        $req = $bdd->prepare('SELECT * FROM reservations WHERE status = :status ORDER BY date_begin');
        $req->execute(array('status' => 'en attente'));
        $donnees = $req->fetch();

        if ($donnees == null) {
            $script_reservations .= "<p>Aucune demande de réservation est en attente.</p>";
        } else {
            $script_reservations .= "        <table class=\"w3-table w3-striped w3-bordered\">
                        <thead>
                        <tr class=\"w3-theme\">
                            <th>Nom</th>
                            <th>Date</th>
                            <th>Message</th>
                            <th>Coordonées</th>
                        </tr>
                        </thead>
                        <tbody>";

            $req = $bdd->prepare('SELECT * FROM reservations WHERE status = :status ORDER BY date_begin');
            $req->execute(array('status' => 'en attente'));
            $donnees = $req->fetch();

            if ($donnees != null) {
                $req = $bdd->prepare('SELECT * FROM reservations WHERE status = :status ORDER BY date_begin');
                $req->execute(array('status' => 'en attente'));
                while ($donnees = $req->fetch()) {
                    $script_reservations .= "<tr class=\"w3-white\">
                            <td>" . $donnees['name'] . "</td>
                            <td>Du " . $donnees['date_begin'] . " Au " . $donnees['date_end'] . "</td>
                            <td>" . $donnees['comment'] . "</td>
                            <td>" . $donnees['email'] . "<br />" . $donnees['phone'] . "</td>
                        </tr>";
                }
            }

            $script_reservations .= "            </tbody>
                    </table>";
        }

        return $script_reservations;
    }

    public static function acceptedReservations() {
        $script_reservations = "";

        global $bdd;
        $req = $bdd->prepare('SELECT * FROM reservations WHERE status = :status ORDER BY date_begin');
        $req->execute(array('status' => 'accepte'));
        $donnees = $req->fetch();

        if ($donnees == null) {
            $script_reservations .= "<p>Aucune réservation n'est validé.</p>";
        } else {

            $script_reservations .= "            <table class=\"w3-table w3-striped w3-bordered\">
                        <thead>
                        <tr class=\"w3-theme\">
                            <th>Nom</th>
                            <th>Date</th>
                            <th>Message</th>
                            <th>Coordonées</th>
                        </tr>
                        </thead>
                        <tbody>";

            $req = $bdd->prepare('SELECT * FROM reservations WHERE status = :status ORDER BY date_begin');
            $req->execute(array('status' => 'accepte'));
            $donnees = $req->fetch();

            if ($donnees != null) {
                $req = $bdd->prepare('SELECT * FROM reservations WHERE status = :status ORDER BY date_begin');
                $req->execute(array('status' => 'accepte'));
                while ($donnees = $req->fetch()) {
                    $script_reservations .= "<tr class=\"w3-white\">
                            <td>" . $donnees['name'] . "</td>
                            <td>Du " . $donnees['date_begin'] . " Au " . $donnees['date_end'] . "</td>
                            <td>" . $donnees['comment'] . "</td>
                            <td>" . $donnees['email'] . "<br />" . $donnees['phone'] . "</td>
                        </tr>";
                }
            }

            $script_reservations .= "            </tbody>
                    </table>";
        }

        return $script_reservations;
    }

    public static function manageReservations() {
        $script_reservations = "";

        global $bdd;
        $req = $bdd->prepare('SELECT * FROM reservations WHERE status = :status ORDER BY date_begin');
        $req->execute(array('status' => 'en attente'));
        $donnees = $req->fetch();

        if ($donnees == null) {
            $script_reservations .= "<p>Aucune demande de réservation est en attente.</p>";
        } else {

            $script_reservations .= "        <table class=\"w3-table w3-striped w3-bordered\">
                        <thead>
                        <tr class=\"w3-theme\">
                            <th>Nom</th>
                            <th>Date</th>
                            <th>Message</th>
                            <th>Coordonées</th>
                            <th>Réponse</th>
                        </tr>
                        </thead>
                        <tbody>";

            $req = $bdd->prepare('SELECT * FROM reservations WHERE status = :status ORDER BY date_begin');
            $req->execute(array('status' => 'en attente'));
            $donnees = $req->fetch();

            if ($donnees != null) {
                $req = $bdd->prepare('SELECT * FROM reservations WHERE status = :status ORDER BY date_begin');
                $req->execute(array('status' => 'en attente'));
                while ($donnees = $req->fetch()) {
                    $script_reservations .= "<tr class=\"w3-white\">
                                <td>" . $donnees['name'] . "</td>
                                <td>Du " . $donnees['date_begin'] . " Au " . $donnees['date_end'] . "</td>
                                <td>" . $donnees['comment'] . "</td>
                                <td>" . $donnees['email'] . "<br />" . $donnees['phone'] . "</td>
                                <td>
                                    <div class=\"w3-half\">
                                        <form action=\"./index.php?action=refuse_reservation\" method=\"post\">
                                            <input type=\"hidden\" name=\"id\" value=\"" . $donnees['id'] . "\">
                                            <input type=\"hidden\" name=\"choice\" value=\"refuse\">
                                            <input type=\"submit\" value=\"Refuser\" class=\"w3-button w3-theme\">
                                        </form>
                                    </div>
                                    <div class=\"w3-half\">
                                        <form action=\"./index.php?action=accept_reservation\" method=\"post\">
                                            <input type=\"hidden\" name=\"id\" value=\"" . $donnees['id'] . "\">
                                            <input type=\"hidden\" name=\"choice\" value=\"accept\">
                                            <input type=\"submit\" value=\"Accepter\" class=\"w3-button w3-theme\">
                                        </form>
                                    </div>
                                </td>
                            </tr>";
                }
            }

            $script_reservations .= "    </tbody>
                </table>";

        }

        return $script_reservations;
    }
}