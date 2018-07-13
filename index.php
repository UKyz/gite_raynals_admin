<?php
/**
 * Created by PhpStorm.
 * User: victorfauquembergue
 * Date: 05/07/2018
 * Time: 11:32
 */

session_start();

if (isset($_POST) and !empty($_POST)) {
    $req = $bdd->prepare('SELECT * FROM login WHERE user = :user AND password = :password');
    $req->execute(array(
        'user' => $_POST['user'],
        'password' => md5($_POST['password'])
    ));

    $donnes = $req->fetch();

    if ($donnes == null) {
        echo "<script>alert(\"Pseudo ou Mot De Passe inccorecte.\");document.location.href ='#'</script>";
    } else {
        $_SESSION['user'] = $donnes['user'];
        $_SESSION['type'] = "gite_domaine_les_reynals";
        $_SESSION['name'] = $donnes['name'];
    }
}

?>

<!DOCTYPE html>
<html>
<title>Backend Gîte Domaine Les Reynals</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="./css/w3.css">
<link rel="stylesheet" href="./css/theme-teal.css">
<link rel="stylesheet" href="./css/font-awesome.min.css">
<link rel="stylesheet" href="./node_modules/datepickk/dist/datepickk.css">
<body>

<!-- Header -->
<header class="w3-container w3-theme w3-padding" id="myHeader">
    <i class="w3-xlarge w3-button w3-theme"></i>
    <div class="w3-center">
        <h4>Page Personnelle</h4>
        <h1 class="w3-xxxlarge w3-animate-bottom">Gîte Domaine Les Raynals</h1>
        <div class="w3-padding-32">
            <!--<button class="w3-btn w3-xlarge w3-dark-grey w3-hover-light-grey"
                     onclick="document.getElementById('id01').style.display='block'"
                     style="font-weight:900;">LEARN W3.CSS</button>-->
            <button class="w3-btn w3-xlarge w3-dark-grey w3-hover-light-grey"
                    onclick="document.location.href='http://localhost/gite_projet/'">Voir le site</button>
        </div>
    </div>
</header>

<?php
if (isset($_SESSION) and $_SESSION['type'] == "gite_domaine_les_reynals") {
    echo "
    <div class='w3-bar w3-theme' >
        <a href = '#' class='w3-bar-item w3-button w3-padding-16' > Home</a >
        <a href = '#reservations' class='w3-bar-item w3-button w3-padding-16' id='btn_reservations'> Réservation</a >
        <a href = '#calendrier' class='w3-bar-item w3-button w3-padding-16' id='btn_calendrier'> Calendrier</a >
        <a href = '#demandes' class='w3-bar-item w3-button w3-padding-16' id='btn_demandes'> Demandes</a >
        <a href = '#prix' class='w3-bar-item w3-button w3-padding-16' id='btn_prix'> Prix</a >
        <a href = '#reservable' class='w3-bar-item w3-button w3-padding-16' id='btn_reservable'> Disponibilité</a >
        <a href = './deconnexion.php' class='w3-bar-item w3-button w3-padding-16' > Se Déconnecter</a >
    </div >";
}?>

<?php
if (!isset($_SESSION) or $_SESSION['type'] != "gite_domaine_les_reynals") {
    echo "<hr />
            <br >
            <hr />
               <div class=\"w3-row-padding\">
                <div>
                    <form class=\"w3-container w3-card-4\" action=\"index.php\" method=\"post\">
                        <h2>Connexion</h2>
                        <div class=\"w3-section\">
                            <input class=\"w3-input\" type=\"text\" name=\"user\" required>
                            <label>Pseudo</label>
                        </div>
                        <div class=\"w3-section\">
                            <input class=\"w3-input\" type=\"password\" name=\"password\" required>
                            <label>Mot De Passe</label>
                        </div>
                        <div class=\"w3-section\">
                            <input type=\"submit\" value=\"Se Connecter\" class=\"w3-button w3-theme\">
                        </div>
                    </form>
                </div>
            </div>";
}?>

<hr />

<?php
if (isset($_SESSION) and $_SESSION['type'] == "gite_domaine_les_reynals") {
    echo "<div class=\"w3-row-padding\" id=\"reservations\">
            <div class=\"w3-half\">
                <div class=\"w3-center\">
                    <h2>Demandes de réservation</h2>
                    <p w3-class=\"w3-large\">Les réservations en attente s'afficheront ici</p>
                </div>
                <div class=\"w3-responsive w3-card-4\">";

    $req = $bdd->prepare('SELECT * FROM reservations WHERE status = :status ORDER BY date_begin');
    $req->execute(array('status' => 'en attente'));
    $donnees = $req->fetch();

    if ($donnees == null) {
        echo "<p>Aucune demande de réservation est en attente.</p>";
    } else {
        echo "        <table class=\"w3-table w3-striped w3-bordered\">
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
                echo "<tr class=\"w3-white\">
                            <td>" . $donnees['name'] . "</td>
                            <td>Du " . $donnees['date_begin'] . " Au " . $donnees['date_end'] . "</td>
                            <td>" . $donnees['comment'] . "</td>
                            <td>" . $donnees['email'] . "<br />" . $donnees['phone'] . "</td>
                        </tr>";
            }
        }

        echo "            </tbody>
                    </table>";
    }

    echo "    </div>
            </div>
        
            <div class=\"w3-half\">
                <div class=\"w3-center\">
                    <h2>Réservations validés</h2>
                    <p w3-class=\"w3-large\">Les réservation validées s'afficheront ici.</p>
                </div>
                <div class=\"w3-responsive w3-card-4\">";

    $req = $bdd->prepare('SELECT * FROM reservations WHERE status = :status ORDER BY date_begin');
    $req->execute(array('status' => 'accepte'));
    $donnees = $req->fetch();

    if ($donnees == null) {
        echo "<p>Aucune réservation n'est validé.</p>";
    } else {

        echo "            <table class=\"w3-table w3-striped w3-bordered\">
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
                echo "<tr class=\"w3-white\">
                            <td>" . $donnees['name'] . "</td>
                            <td>Du " . $donnees['date_begin'] . " Au " . $donnees['date_end'] . "</td>
                            <td>" . $donnees['comment'] . "</td>
                            <td>" . $donnees['email'] . "<br />" . $donnees['phone'] . "</td>
                        </tr>";
            }
        }

        echo "            </tbody>
                    </table>";
    }
    echo "    </div>
            </div>
        </div>
        
        <hr />";
}?>

<?php if (isset($_SESSION) and $_SESSION['type'] == "gite_domaine_les_reynals") {
    echo "<div class=\"w3-center\" id=\"calendrier\">
            <h2>Calendrier</h2>
            <p w3-class=\"w3-large\">Les jours réservés, en attente et non réservable s'afficheront ici.</p>
        </div>
        <div class=\"w3-container\" id=\"demoPicker\" style=\"height:450px;width:100%;max-width: 450px; margin-left: auto;
            margin-right: auto;\"></div>
        <script src=\"./node_modules/datepickk/dist/datepickk.js\"></script>
        <script src=\"./node_modules/moment/moment.js\"></script>
        <script>
            let now = new Date(moment());
            let demoPicker = new Datepickk({
                container: document.querySelector('#demoPicker'),
                inline:true,
                range: true,
                tooltips: {
                    date: now,
                    text: `Aujourd'hui`
                }
            });
            demoPicker.minDate = new Date(moment().subtract(1, 'days'));
            demoPicker.lang = 'fr';
            demoPicker.locked = true;";

    require('./config/config.php');

    $req = $bdd->query('SELECT * FROM calendrier ORDER BY date');

    while ($donnees = $req->fetch()) {
        if ($donnees['id_reservation'] == -1) {
            echo "demoPicker.disabledDates = [
                    new Date('" . $donnees['date'] . "')
                ];";
        } else if ($donnees['id_reservation'] > 0) {
            echo "demoPicker.highlight = [{
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
            echo "demoPicker.highlight = [{
                    start: new Date('" . $date . "'),
                    end: new Date('" . $date . "'),
                    backgroundColor: '#ffea00',
                    color: '#000',
                    legend: 'En attente'
                }];";
            $date = date("Y-m-d", strtotime($date . ' +1 days'));
        }
    }

    echo "</script>
        <hr />";
}?>

<?php if (isset($_SESSION) and $_SESSION['type'] == "gite_domaine_les_reynals") {
    echo "<div class=\"w3-row-padding\" id=\"demandes\">
            <div class=\"w3-center\">
                <h2>Gérer les réservations</h2>
                <p w3-class=\"w3-large\">Les réservations en attente s'afficheront ici.</p>
            </div>
            <div class=\"w3-responsive w3-card-4\">";

    $req = $bdd->prepare('SELECT * FROM reservations WHERE status = :status ORDER BY date_begin');
    $req->execute(array('status' => 'en attente'));
    $donnees = $req->fetch();

    if ($donnees == null) {
        echo "<p>Aucune demande de réservation est en attente.</p>";
    } else {

        echo "        <table class=\"w3-table w3-striped w3-bordered\">
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
                echo "<tr class=\"w3-white\">
                                <td>" . $donnees['name'] . "</td>
                                <td>Du " . $donnees['date_begin'] . " Au " . $donnees['date_end'] . "</td>
                                <td>" . $donnees['comment'] . "</td>
                                <td>" . $donnees['email'] . "<br />" . $donnees['phone'] . "</td>
                                <td>
                                    <div class=\"w3-half\">
                                        <form action=\"./reservation.php\" method=\"post\">
                                            <input type=\"hidden\" name=\"id\" value=\"" . $donnees['id'] . "\">
                                            <input type=\"hidden\" name=\"choice\" value=\"refuse\">
                                            <input type=\"submit\" value=\"Refuser\" class=\"w3-button w3-theme\">
                                        </form>
                                    </div>
                                    <div class=\"w3-half\">
                                        <form action=\"./reservation.php\" method=\"post\">
                                            <input type=\"hidden\" name=\"id\" value=\"" . $donnees['id'] . "\">
                                            <input type=\"hidden\" name=\"choice\" value=\"accept\">
                                            <input type=\"submit\" value=\"Accepter\" class=\"w3-button w3-theme\">
                                        </form>
                                    </div>
                                </td>
                            </tr>";
            }
        }

        echo "    </tbody>
                </table>";

    }
    echo"    </div>
        </div>
        <hr />";
}?>

<?php if (isset($_SESSION) and $_SESSION['type'] == "gite_domaine_les_reynals") {
    echo "<div class=\"w3-row-padding\" id=\"prix\">
            <div class=\"w3-center\">
                <h2>Gérer les prix</h2>
                <p w3-class=\"w3-large\">Gérer les prix des réservations jour par jour.</p>
            </div>
        
            <div class=\"w3-half price_form\" id=\"demoPicker2\"></div>
            <script src=\"./node_modules/datepickk/dist/datepickk.js\"></script>
            <script src=\"./node_modules/moment/moment.js\"></script>
            <script>
                let demoPicker2 = new Datepickk({
                    container: document.querySelector('#demoPicker2'),
                    inline: true,
                    range: true
                });
                demoPicker2.minDate = new Date(moment().subtract(1, 'days'));
                demoPicker2.lang = 'fr';
                demoPicker2.locked = true;
        
                demoPicker2.onSelect = (checked) => {
                    if (demoPicker2.selectedDates.length > 0) {
                        const date_debut = moment(demoPicker2.selectedDates[0]).format('DD/MM/YYYY');
                        const date_fin =
                            moment(demoPicker2.selectedDates[demoPicker2.selectedDates.length - 1]).format('DD/MM/YYYY');
                        document.getElementById('date_begin').value = date_debut;
                        document.getElementById('date_end').value = date_fin;
                    }
                };
            </script>
            
            <div class=\"w3-half price_form\">
                <form class=\"w3-container w3-card-4\" action=\"price.php\" method=\"post\">
                    <h2>Changer les prix</h2>
                    <div class=\"w3-section\">
                        <input type=\"text\" class=\"w3-input\" name=\"date_begin\" id=\"date_begin_1\"
                               required=\"\">
                        <label>Date de début *</label>
                    </div>
                    <div class=\"w3-section\">
                        <input type=\"text\" class=\"w3-input\" name=\"date_end\" id=\"date_end_1\"
                               required=\"\">
                        <label>Date de fin *</label>
                    </div>
                    <div class=\"w3-section\">
                        <input class=\"w3-input\" type=\"number\" name=\"price\" required>
                        <label>Prix par nuit (en €) *</label>
                    </div>
                    <div class=\"w3-section\">
                        <input type=\"submit\" value=\"Accepter\" class=\"w3-button w3-theme\">
                    </div>
                </form>
            </div>
        </div>
        <hr>";

    require('./config/config.php');

    $req = $bdd->query('SELECT * FROM calendrier ORDER BY date');

    echo "<script>";

    while ($donnees = $req->fetch()) {
        if ($donnees['id_reservation'] == 0) {
            echo "demoPicker2.tooltips = [{
                    date : new Date('" . $donnees['date'] . "'),
                    text : '" . $donnees['price'] . "€'
                }];";
        } else if ($donnees['id_reservation'] == -1) {
            echo "demoPicker2.disabledDates = [
                    new Date('" . $donnees['date'] . "')
                ];";
        }
    }

    echo "</script>";
}?>

<?php if (isset($_SESSION) and $_SESSION['type'] == "gite_domaine_les_reynals") {
    echo "<div class=\"w3-row-padding\" id=\"reservable\">
            <div class=\"w3-center\">
                <h2>Gérer les jours réservables</h2>
                <p w3-class=\"w3-large\">Gérer la réservabilité jour par jour de votre gîte.</p>
            </div>
        
            <div class=\"w3-half price_form\" id=\"demoPicker3\"></div>
            <script src=\"./node_modules/datepickk/dist/datepickk.js\"></script>
            <script src=\"./node_modules/moment/moment.js\"></script>
            <script>
                let now3 = new Date(moment());
                let demoPicker3 = new Datepickk({
                    container: document.querySelector('#demoPicker3'),
                    inline: true,
                    range: true
                });
                demoPicker3.minDate = new Date(moment().subtract(1, 'days'));
                demoPicker3.lang = 'fr';
                demoPicker3.locked = true;
        
                demoPicker3.onSelect = (checked) => {
                    if (demoPicker3.selectedDates.length > 0) {
                        const date_debut = moment(demoPicker3.selectedDates[0]).format('DD/MM/YYYY');
                        const date_fin =
                            moment(demoPicker3.selectedDates[demoPicker3.selectedDates.length - 1]).format('DD/MM/YYYY');
                        document.getElementById('date_begin').value = date_debut;
                        document.getElementById('date_end').value = date_fin;
                    }
                };
            </script>
            
            <div class=\"w3-half price_form\">
                <form class=\"w3-container w3-card-4\" action=\"disable.php\" method=\"post\">
                    <h2>Changer les jours réservables</h2>
                    <div class=\"w3-section\">
                        <input type=\"text\" class=\"w3-input\" name=\"date_begin\" id=\"date_begin_2\"
                               required=\"\">
                        <label>Date de début *</label>
                    </div>
                    <div class=\"w3-section\">
                        <input type=\"text\" class=\"w3-input\" name=\"date_end\" id=\"date_end_2\"
                               required=\"\">
                        <label>Date de fin *</label>
                    </div>
                    <div class=\"w3-section\">
                        <div class='w3-half'>
                            <input class=\"w3-input\" type='radio' name=\"choice\" value='disable' checked>
                            <label>Non Réservable</label>
                        </div>
                        <div class='w3-half'>
                            <input class=\"w3-input\" type='radio' name=\"choice\" value='able'>
                            <label>Réservable</label>
                        </div>
                    </div>
                    <div class=\"w3-section\">
                        <input type=\"submit\" value=\"Accepter\" class=\"w3-button w3-theme\">
                    </div>
                </form>
            </div>
        </div>";

    require('./config/config.php');

    $req = $bdd->query('SELECT * FROM calendrier ORDER BY date');

    echo "<script>";

    while ($donnees = $req->fetch()) {
        if ($donnees['id_reservation'] == -1) {
            echo "demoPicker3.disabledDates = [
                    new Date('" . $donnees['date'] . "')
                ];";
        } else if ($donnees['id_reservation'] > 0) {
            echo "demoPicker3.highlight = [{
                    start: new Date('" . $donnees['date'] . "'),
                    end: new Date('" . $donnees['date'] . "'),
                    backgroundColor: '#05676E',
                    color: '#fff',
                    legend: 'Réservé'
                }];";
        }
    }

    echo "</script>";
}?>

<br>
<hr />

<!-- modal-->

<div id="myModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <span class="close">&times;</span>
            <h2>Vos prix ont bien été modifié</h2>
        </div>
        <div class="modal-body">
            <p>Uniquement vos prix ont été modifié.</p>
            <p>S'il y avez une réservation entre ces dates, le prix de la réservation n'a pas été modifié.</p>
        </div>
    </div>
</div>

<?php
if (isset($_GET) and $_GET['type'] == "price_confirmation") {
    echo "<script>document.getElementById('myModal').style.display = 'block';</script>";
}
?>

<script>
    const modal = document.getElementById('myModal');
    const span = document.getElementsByClassName("close")[0];

    span.onclick = () => {
        modal.style.display = "none";
    };

    window.onclick = (event) => {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    }
</script>
<!-- //modal -->

<!-- Footer -->
<footer class="w3-container w3-theme-dark w3-padding-16">
    <h3>Gîte Domaine Les Reynals</h3>
    <p>Crée par Sikia. Tous droits réservés.</p>
    <div style="position:relative;bottom:55px;" class="w3-tooltip w3-right">
        <span class="w3-text w3-theme-light w3-padding">Go To Top</span> 
        <a class="w3-text-white" href="#myHeader"><span class="w3-xlarge">
    <i class="fa fa-chevron-circle-up"></i></span></a>
    </div>
</footer>

<!-- Script for Sidebar, Tabs, Accordions, Progress bars and slideshows -->
<script src="./js/jquery-1.12.4.js"></script>
<script src="./js/jquery-ui.js"></script>
<link rel="stylesheet" href="./css/jquery-ui.css">
<!-- link menu scroll -->
<script>
    $(function () {
        $("#btn_reservations").click(() => {
            $("#reservations").show();
            $('html, body').animate({
                scrollTop: $('#reservations').offset().top
            }, 'slow');
        });

        $("#btn_calendrier").click(() => {
            $("#calendrier").show();
            $('html, body').animate({
                scrollTop: $('#calendrier').offset().top
            }, 'slow');
        });

        $("#btn_demandes").click(() => {
            $("#demandes").show();
            $('html, body').animate({
                scrollTop: $('#demandes').offset().top
            }, 'slow');
        });

        $("#btn_prix").click(() => {
            $("#prix").show();
            $('html, body').animate({
                scrollTop: $('#prix').offset().top
            }, 'slow');
        });

        $("#btn_reservable").click(() => {
            $("#reservable").show();
            $('html, body').animate({
                scrollTop: $('#reservable').offset().top
            }, 'slow');
        });
    });
</script>
<!-- //link menu scroll -->
<script>
    const lang = {
        closeText: 'Fermer',
        prevText: 'Précédent',
        nextText: 'Suivant',
        currentText: 'Aujourd\'hui',
        monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin',
            'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
        monthNamesShort: ['Janv.', 'Févr.', 'Mars', 'Avril', 'Mai', 'Juin',
            'Juil.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Déc.'],
        dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
        dayNamesShort: ['Dim.', 'Lun.', 'Mar.', 'Mer.', 'Jeu.', 'Ven.', 'Sam.'],
        dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
        weekHeader: 'Sem.',
        dateFormat: 'dd/mm/yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
    $(function () {
        $('input[id="date_begin_1"]').datepicker();
        $('input[id="date_begin_1"]').datepicker("option", "dateFormat", "dd/mm/yy");
        $('input[id="date_begin_1"]').datepicker("option", $.datepicker.regional["fr"] = lang);

        $('input[id="date_end_1"]').datepicker();
        $('input[id="date_end_1"]').datepicker("option", "dateFormat", "dd/mm/yy");
        $('input[id="date_end_1"]').datepicker("option", $.datepicker.regional["fr"] = lang);

        $('input[id="date_begin_2"]').datepicker();
        $('input[id="date_begin_2"]').datepicker("option", "dateFormat", "dd/mm/yy");
        $('input[id="date_begin_2"]').datepicker("option", $.datepicker.regional["fr"] = lang);

        $('input[id="date_end_2"]').datepicker();
        $('input[id="date_end_2"]').datepicker("option", "dateFormat", "dd/mm/yy");
        $('input[id="date_end_2"]').datepicker("option", $.datepicker.regional["fr"] = lang);
    });
</script>
<script>
    // Side navigation
    function w3_open() {
        let x = document.getElementById("mySidebar");
        x.style.width = "100%";
        x.style.fontSize = "40px";
        x.style.paddingTop = "10%";
        x.style.display = "block";
    }
    function w3_close() {
        document.getElementById("mySidebar").style.display = "none";
    }

    // Tabs
    function openCity(evt, cityName) {
        let i;
        let x = document.getElementsByClassName("city");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        let activebtn = document.getElementsByClassName("testbtn");
        for (i = 0; i < x.length; i++) {
            activebtn[i].className = activebtn[i].className.replace(" w3-dark-grey", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " w3-dark-grey";
    }

    // Accordions
    function myAccFunc(id) {
        let x = document.getElementById(id);
        if (x.className.indexOf("w3-show") === -1) {
            x.className += " w3-show";
        } else {
            x.className = x.className.replace(" w3-show", "");
        }
    }

    // Slideshows
    let slideIndex = 1;

    function plusDivs(n) {
        slideIndex = slideIndex + n;
        showDivs(slideIndex);
    }

    // Progress Bars
    function move() {
        let elem = document.getElementById("myBar");
        let width = 5;
        let id = setInterval(frame, 10);
        function frame() {
            if (width === 100) {
                clearInterval(id);
            } else {
                width++;
                elem.style.width = width + '%';
                elem.innerHTML = (width * 1)  + '%';
            }
        }
    }
</script>

</body>
</html>