<?php
/**
 * Created by PhpStorm.
 * User: victorfauquembergue
 * Date: 17/07/2018
 * Time: 11:01
 */

class Reservations
{

    public static function askReservation($id) {

        global $bdd;
        $req = $bdd->prepare('SELECT * FROM reservations WHERE id = :id');
        $req->execute(array('id' => $id));

        return $req->fetch();

    }

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

    public static function menuAcceptedReservations() {
        $script_reservations = "<div class=\"w3-bar-item\"
                    style='padding: 10px; margin-right: 10px;'><span class='fa fa-filter'> Filtres : </span></div>
                        <button class=\"w3-bar-item w3-button testbtn2 w3-padding-16 w3-theme3\"
                    onclick=\"openMenu2(event,'all')\"> Tout</button>";

        global $bdd;
        $req = $bdd->query('SELECT * FROM reservations ORDER BY date_begin DESC');

        $annee = 0;

        while ($donnees = $req->fetch()) {

            if ($annee != explode("-", $donnees['date_begin'])[0]) {
                $annee = explode("-", $donnees['date_begin'])[0];

                $script_reservations .= "<button class=\"w3-bar-item w3-button testbtn2 w3-padding-16 w3-theme3\"
                    onclick=\"openMenu2(event,'" . $annee . "')\">" . $annee . "</button>";
            }

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
                            <th>Prix</th>
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
                            <td>Du " . date_format(date_create($donnees['date_begin']),'d/m/Y') .
                                " Au " . date_format(date_create($donnees['date_end']),'d/m/Y') . "</td>
                            <td>";
                    if ($donnees['comment'] == "Aucun message supplémentaire.") {
                        $script_reservations .= $donnees['comment'];
                    } else {
                        $script_reservations .= "<a onclick=\"document . getElementById('message_popup" . $donnees['id'] . "').style . display = 'block'\"
                                    title=\"Montrer les services\" style=\"color:#fe533d; cursor:pointer;\">Afficher le message</a>";
                    }

                $script_reservations .= "</td>
                            <td>" . $donnees['email'] . "<br />" . $donnees['phone'] . "</td>
                            <td>" . Reservations::calculPriceResa($donnees['date_begin'], $donnees['date_end']) .
                                " €</td>
                        </tr>
                        <script>
                                window.onclick = event => {
                                    if (event.target === document.getElementById('message_popup" . $donnees['id'] . "')) {
                                        document.getElementById('message_popup" . $donnees['id'] . "').style.display = \"none\";
                                    }
                                };
                            </script>
                            <div id=\"message_popup" . $donnees['id'] . "\" class=\"w3-modal\" >
                                <div class=\"w3-modal-content w3-card-4\" >
                                    <header class=\"w3-container w3-couleur-front\" style = \"padding: 20px;margin-bottom: 20px;\" >
                                        <span onclick = \"document.getElementById('message_popup" . $donnees['id'] . "').style.display='none'\"
                                          class=\"w3-button w3-display-topright\" >&times;</span >
                                        <h2 > Message</h2 >
                                    </header >
                                    <div class=\"w3-container\" > " . $donnees['comment']
                                . "</div>
                                    <br />
                                </div>
                            </div>";
                }
            }

            $script_reservations .= "            </tbody>
                    </table>";
        }

        return $script_reservations;
    }

    public static function acceptedReservationsByYear() {
        $script_reservations = "";

        global $bdd;
        $req = $bdd->query('SELECT * FROM reservations ORDER BY date_begin DESC');

        $annee = 0;
        $tab_annee = array();

        while ($donnees = $req->fetch()) {

            if ($annee != explode("-", $donnees['date_begin'])[0]) {
                $annee = explode("-", $donnees['date_begin'])[0];

                $tab_annee[sizeof($tab_annee)] = $annee;

            }
        }

        foreach ($tab_annee as $value) {

            $req = $bdd->prepare('SELECT * FROM reservations WHERE status = :status AND 
              date_begin >= :date_begin AND date_begin <= :date_begin2 ORDER BY date_begin');
            $req->execute(array(
                'status' => 'accepte',
                'date_begin' => $value . "-01-01",
                'date_begin2' => $value . "-12-31"));
            $donnees = $req->fetch();

            $script_reservations .= "<div class='w3-responsive w3-card-4 city2' id='" . $value . "'>";

            if ($donnees == null) {
                $script_reservations .= "<p>Aucune réservation n'est validé.</p>";
            } else {

                $script_reservations .= "<table class=\"w3-table w3-striped w3-bordered\">
                        <thead>
                        <tr class=\"w3-theme\">
                            <th>Nom</th>
                            <th>Date</th>
                            <th>Message</th>
                            <th>Coordonées</th>
                            <th>Prix</th>
                        </tr>
                        </thead>
                        <tbody>";

                $req = $bdd->prepare('SELECT * FROM reservations WHERE status = :status AND 
              date_begin >= :date_begin AND date_begin <= :date_begin2 ORDER BY date_begin');
                $req->execute(array(
                    'status' => 'accepte',
                    'date_begin' => $value . "-01-01",
                    'date_begin2' => $value . "-12-31"));
                $donnees = $req->fetch();

                if ($donnees != null) {
                    $req = $bdd->prepare('SELECT * FROM reservations WHERE status = :status AND 
              date_begin >= :date_begin AND date_begin <= :date_begin2 ORDER BY date_begin');
                    $req->execute(array(
                        'status' => 'accepte',
                        'date_begin' => $value . "-01-01",
                        'date_begin2' => $value . "-12-31"));
                    while ($donnees = $req->fetch()) {
                        $script_reservations .= "<tr class=\"w3-white\">
                            <td>" . $donnees['name'] . "</td>
                            <td>Du " . date_format(date_create($donnees['date_begin']), 'd/m/Y') .
                            " Au " . date_format(date_create($donnees['date_end']), 'd/m/Y') . "</td>
                            <td>";
                        if ($donnees['comment'] == "Aucun message supplémentaire.") {
                            $script_reservations .= $donnees['comment'];
                        } else {
                            $script_reservations .= "<a onclick=\"document . getElementById('message_popup" . $donnees['id'] . "').style . display = 'block'\"
                                    title=\"Montrer les services\" style=\"color:#fe533d; cursor:pointer;\">Afficher le message</a>";
                        }

                        $script_reservations .= "</td>
                            <td>" . $donnees['email'] . "<br />" . $donnees['phone'] . "</td>
                            <td>" . Reservations::calculPriceResa($donnees['date_begin'], $donnees['date_end']) .
                            " €</td>
                        </tr>
                        <script>
                                window.onclick = event => {
                                    if (event.target === document.getElementById('message_popup" . $donnees['id'] . "')) {
                                        document.getElementById('message_popup" . $donnees['id'] . "').style.display = \"none\";
                                    }
                                };
                            </script>
                            <div id=\"message_popup" . $donnees['id'] . "\" class=\"w3-modal\" >
                                <div class=\"w3-modal-content w3-card-4\" >
                                    <header class=\"w3-container w3-couleur-front\" style = \"padding: 20px;margin-bottom: 20px;\" >
                                        <span onclick = \"document.getElementById('message_popup" . $donnees['id'] . "').style.display='none'\"
                                          class=\"w3-button w3-display-topright\" >&times;</span >
                                        <h2 > Message</h2 >
                                    </header >
                                    <div class=\"w3-container\" > " . $donnees['comment']
                            . "</div>
                                    <br />
                                </div>
                            </div>";
                    }
                }

                $script_reservations .= "            </tbody>
                    </table>
                    </div>";
            }
        }

        return $script_reservations;
    }

    public static function refusedReservations() {
        $script_reservations = "";

        global $bdd;
        $req = $bdd->prepare('SELECT * FROM reservations WHERE status = :status ORDER BY date_begin');
        $req->execute(array('status' => 'refuse'));
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
                            <th>Prix</th>
                            <th>Réponse</th>
                        </tr>
                        </thead>
                        <tbody>";

            $req = $bdd->prepare('SELECT * FROM reservations WHERE status = :status ORDER BY date_begin');
            $req->execute(array('status' => 'refuse'));
            $donnees = $req->fetch();

            if ($donnees != null) {
                $req = $bdd->prepare('SELECT * FROM reservations WHERE status = :status ORDER BY date_begin');
                $req->execute(array('status' => 'refuse'));
                while ($donnees = $req->fetch()) {
                    $script_reservations .= "<tr class=\"w3-white\">
                                <td>" . $donnees['name'] . "</td>
                                <td>Du " . date_format(date_create($donnees['date_begin']),'d/m/Y') .
                        " Au " . date_format(date_create($donnees['date_end']),'d/m/Y') . "</td>
                                <td>";
                    if ($donnees['comment'] == "Aucun message supplémentaire.") {
                        $script_reservations .= $donnees['comment'];
                    } else {
                        $script_reservations .= "<a onclick=\"document.getElementById('message_popup" . $donnees['id'] . "').style.display='block'\"
                                    title=\"Montrer les services\" style=\"color:#fe533d; cursor:pointer;\">Afficher le message</a>";
                    }

                    $script_reservations .= "</td>
                                <td>" . $donnees['email'] . "<br />" . $donnees['phone'] . "</td>
                                <td>" . Reservations::calculPriceResa($donnees['date_begin'], $donnees['date_end']) .
                        " €</td>
                                <td>
                                    <div class=\"w3-half\">
                                        <form action=\"./index.php?action=accept_reservation\" method=\"post\">
                                            <input type=\"hidden\" name=\"id\" value=\"" . $donnees['id'] . "\">
                                            <input type=\"hidden\" name=\"choice\" value=\"accept\">
                                            <input type=\"submit\" value=\"Accepter\" class=\"w3-button w3-theme2\">
                                        </form>
                                    </div>
                                    <div class=\"w3-half\">
                                        <form action=\"./index.php?action=delete_reservation\" method=\"post\">
                                            <input type=\"hidden\" name=\"id\" value=\"" . $donnees['id'] . "\">
                                            <input type=\"hidden\" name=\"choice\" value=\"refuse\">
                                            <input type=\"submit\" value=\"Supprimer\" class=\"w3-button w3-theme2\">
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <script>
                                window.onclick = event => {
                                    if (event.target === document.getElementById('message_popup" . $donnees['id'] . "')) {
                                        document.getElementById('message_popup" . $donnees['id'] . "').style.display = \"none\";
                                    }
                                };
                            </script>
                            <div id=\"message_popup" . $donnees['id'] . "\" class=\"w3-modal\">
                                <div class=\"w3-modal-content w3-card-4\">
                                    <header class=\"w3-container w3-couleur-front\" style=\"padding: 20px;margin-bottom: 20px;\">
                                        <span onclick=\"document.getElementById('message_popup" . $donnees['id'] . "').style.display='none'\"
                                          class=\"w3-button w3-display-topright\">&times;</span>
                                        <h2>Message</h2>
                                    </header>
                                    <div class=\"w3-container\">" . $donnees['comment']
                        . "</div>
                                    <br />
                                </div>
                            </div>";
                }
            }

            $script_reservations .= "    </tbody>
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
                            <th>Prix</th>
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
                                <td>Du " . date_format(date_create($donnees['date_begin']),'d/m/Y') .
                                " Au " . date_format(date_create($donnees['date_end']),'d/m/Y') . "</td>
                                <td>";
                    if ($donnees['comment'] == "Aucun message supplémentaire.") {
                        $script_reservations .= $donnees['comment'];
                    } else {
                        $script_reservations .= "<a onclick=\"document.getElementById('message_popup" . $donnees['id'] . "').style.display='block'\"
                                    title=\"Montrer les services\" style=\"color:#fe533d; cursor:pointer;\">Afficher le 
                                    message</a>";
                    }

                    $script_reservations .= "</td>
                                <td>" . $donnees['email'] . "<br />" . $donnees['phone'] . "</td>
                                <td>" . Reservations::calculPriceResa($donnees['date_begin'], $donnees['date_end']) .
                                    " €</td>
                                <td>
                                    <div class=\"w3-half\">
                                        <form action=\"./index.php?action=accept_reservation\" method=\"post\">
                                            <input type=\"hidden\" name=\"id\" value=\"" . $donnees['id'] . "\">
                                            <input type=\"hidden\" name=\"choice\" value=\"accept\">
                                            <input type=\"submit\" value=\"Accepter\" class=\"w3-button w3-theme2\">
                                        </form>
                                    </div>
                                    <div class=\"w3-half\">
                                        <form action=\"./index.php?action=refuse_reservation\" method=\"post\">
                                            <input type=\"hidden\" name=\"id\" value=\"" . $donnees['id'] . "\">
                                            <input type=\"hidden\" name=\"choice\" value=\"refuse\">
                                            <input type=\"submit\" value=\"Refuser\" class=\"w3-button w3-theme2\">
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <script>
                                window.onclick = event => {
                                    if (event.target === document.getElementById('message_popup" . $donnees['id'] . "')) {
                                        document.getElementById('message_popup" . $donnees['id'] . "').style.display = \"none\";
                                    }
                                };
                            </script>
                            <div id=\"message_popup" . $donnees['id'] . "\" class=\"w3-modal\">
                                <div class=\"w3-modal-content w3-card-4\">
                                    <header class=\"w3-container w3-couleur-front\" style=\"padding: 20px;margin-bottom: 20px;\">
                                        <span onclick=\"document.getElementById('message_popup" . $donnees['id'] . "').style.display='none'\"
                                          class=\"w3-button w3-display-topright\">&times;</span>
                                        <h2>Message</h2>
                                    </header>
                                    <div class=\"w3-container\">" . $donnees['comment']
                                . "</div>
                                    <br />
                                </div>
                            </div>";
                }
            }

            $script_reservations .= "    </tbody>
                </table>";

        }

        return $script_reservations;
    }

    public static function acceptReservation($id) {
        global $bdd;
        $req = $bdd->prepare('UPDATE reservations SET status = :status WHERE id = :id');
        $req->execute(array(
            'status' => 'accepte',
            'id' => $id));
    }

    public static function refuseReservation($id) {
        global $bdd;
        $req = $bdd->prepare('UPDATE reservations SET status = :status WHERE id = :id');
        $req->execute(array(
            'status' => 'refuse',
            'id' => $id));
    }

    public static function deleteReservation($id) {
        global $bdd;
        $req = $bdd->prepare('DELETE FROM reservations WHERE id = :id');
        $req->execute(array(
            'id' => $id));
    }

    public static function deleteOldReservation() {
        $date = date('Y-m-d');
        global $bdd;
        $req = $bdd->prepare('DELETE FROM reservations WHERE date_end <= :date_end');
        $req->execute(array(
            'date_end' => $date));

        $req = $bdd->prepare('DELETE FROM reservations WHERE date_begin < :date_begin AND status = :status');
        $req->execute(array(
            'date_begin' => $date,
            'status' => "en attente"));
    }

    public static function calculPriceResa($date_begin, $date_end) {

        $price = 0;
        $date = $date_begin;
        $nb_days = 0;

        while ($date != $date_end) {
            global $bdd;
            $req = $bdd->prepare('SELECT * FROM calendrier WHERE date = :date');
            $req->execute(array('date' => $date));

            $donnees = $req->fetch();

            $price += $donnees['price'];
            $date = date("Y-m-d", strtotime($date . ' +1 days'));
            $nb_days ++;
        }

        $req = $bdd->prepare('SELECT * FROM services WHERE can_select = :can_select');
        $req->execute(array('can_select' => 'no'));

        while ($donnees = $req->fetch()) {
            $price += $donnees['price'];
        }

        return $price;

    }
}