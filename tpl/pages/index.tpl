<div class="w3-bar w3-theme3">
    <button class="w3-bar-item w3-button testbtn w3-padding-16"
            onclick="openMenu(event,'Reservations1')">Réservations en attente</button>
    <button class="w3-bar-item w3-button testbtn w3-padding-16"
            onclick="openMenu(event,'Reservations2')">Réservations validées</button>
    <button class="w3-bar-item w3-button testbtn w3-padding-16"
            onclick="openMenu(event,'Reservations3')">Réservations refusées</button>
    <button class="w3-bar-item w3-button testbtn w3-padding-16"
            onclick="openMenu(event,'Calendrier')">Calendrier</button>
    <button class="w3-bar-item w3-button testbtn w3-padding-16"
            onclick="openMenu(event,'Services')">Services</button>
    <a class="w3-bar-item w3-button testbtn w3-padding-16"
            href="https://test-gite.aikis.fr">Voir le site</a>
    <a class="w3-bar-item w3-button testbtn w3-padding-16"
            href = './index.php?action=deconnexion'>Deconnexion</a>
</div>

<hr />
<br>


<div id="Reservations1" class="w3-container city w3-animate-opacity w3-row-padding">
    <div class="w3-center">
        <div class="w3-center">
            <h2>Réservations en attente</h2>
            <p w3-class="w3-large">Les réservations en attente s'afficheront ici.</p>
        </div>
        <div class="w3-responsive w3-card-4">
            {$manage_reservations_script}
        </div>
    </div>
</div>

<div id="Reservations2" class="w3-container city w3-animate-opacity w3-row-padding">
    <div class="w3-center">
        <div class="w3-center">
            <h2>Réservations validées</h2>
            <p w3-class="w3-large">Les réservation validées s'afficheront ici.</p>
        </div>
        <div class="w3-bar" style="margin-bottom: 20px;">
            {$menu_accepted_reservations_script}
        </div>
        <div class="w3-responsive w3-card-4 city2" id="all">
            {$all_accepted_reservations_script}
        </div>
        <div></div>
        {$years_accepted_reservations_script}
    </div>
</div>

<div id="Reservations3" class="w3-container city w3-animate-opacity w3-row-padding">
    <div class="w3-center">
        <div class="w3-center">
            <h2>Réservations refusées</h2>
            <p w3-class="w3-large">Les réservation refusées s'afficheront ici.</p>
        </div>
        <div class="w3-responsive w3-card-4">
            {$refused_reservations_script}
        </div>
    </div>
</div>

<div id="Calendrier" class="w3-container city w3-animate-opacity w3-row-padding">
    <div class="w3-center">
        <h2>Gérer le calendrier</h2>
        <p w3-class="w3-large">Gérer les prix et la réservabilité jour par jour.</p>
    </div>

    <div class="w3-half price_form" id="demoPicker2"></div>
    <script src="./node_modules/datepickk/dist/datepickk.js"></script>
    <script src="./node_modules/moment/moment.js"></script>
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

        {$price_calendrier_script}
    </script>

    <div class="w3-half price_form">
        <form class="w3-container w3-card-4" action="./index.php?action=manage" method="post">
            <h2>Modifier les prix et la réservabilité</h2>
            <div class="w3-section">
                <div class='w3-half'>
                    <input class="w3-check" type='radio' name="choice" value='able' checked>
                    <label>Réservable</label>
                </div>
                <div class='w3-half'>
                    <input class="w3-check" type='radio' name="choice" value='disable' id="btn_non_reservable">
                    <label>Non Réservable</label>
                    <a onclick="document.getElementById('info_popup').style.display='block'" title="Montrer les
                    services" style="color:#fe533d;" class="fa fa-info-circle"></a>
                </div>
            </div>
            <div class="w3-section">
                <input class="w3-input" type="number" name="price" id="input_price" required
                       placeholder="Prix par nuit (en €)">
            </div>
            <div class="w3-section">
                <input type="text" class="w3-input" name="date_begin" id="date_begin_1"
                       required="" placeholder="Date de début">
            </div>
            <div class="w3-section">
                <input type="text" class="w3-input" name="date_end" id="date_end_1"
                       required="" placeholder="Date de fin">
            </div>
            <div class="w3-section">
                <input type="submit" value="Enregistrer" class="w3-button w3-theme2">
            </div>
        </form>
    </div>

    <div id="info_popup" class="w3-modal">
        <div class="w3-modal-content w3-card-4">
            <header class="w3-container w3-couleur-front" style="padding: 20px;margin-bottom: 20px;">
            <span onclick="document.getElementById('info_popup').style.display='none'"
                  class="w3-button w3-display-topright">&times;</span>
                <h2>Réservabilité</h2>
            </header>
            <div class="w3-container">
                Tous les jours sont, à l'origine, réservables. <br />Vous avez la possibilité de changer un jour ou une
                période en mode "non réservable". <br />Le mode "non réservable" vous permet de bloquer certains jours,
                ainsi aucun client ne pourra faire une demande de réservation incluant une date dîte "non réservable".
                <br />Un jour "non réservable" sera perçu barrée dans le calendrier et aucun prix ne sera indiqué pour
                cette date là.<br />
                Vous pouvez facilement changer un jour "non réservable" en "réservable" en cochant la case "Réservable".
            </div>
            <br />
        </div>
    </div>
</div>

<div id="Services" class="w3-container city w3-animate-opacity w3-row-padding">
    <div class="w3-center">
        <h2>Gérer les services</h2>
        <p w3-class="w3-large">Gérer les services facturables.</p>
    </div>

    <div class="w3-half">
        <div class="w3-center">
            <h2>Vos services</h2>
            <p w3-class="w3-large">Les services facturables s'afficheront ici.</p>
        </div>
        <div class="w3-responsive w3-card-4">
            {$services_script}
        </div>
    </div>

    <div class="w3-half price_form">
        <form class="w3-container w3-card-4" action="index.php?action=service" method="post">
            <h2>Changer les frais de services</h2>
            <div class="w3-half w3-section">
                <input type="checkbox" class="w3-check" name="can_select" id="can_select"
                       value="no" checked>
                <label>Service obligatoire</label>
                <a onclick="document.getElementById('info_popup_2').style.display='block'" title="Montrer les
                    services" style="color:#fe533d;" class="fa fa-info-circle"></a>
            </div>
            <div class="w3-section">
                <textarea type="text" class="w3-input" name="details" id="details"
                          required="" placeholder="Détails"></textarea>
            </div>
            <div class="w3-section">
                <input type="number" class="w3-input" name="price" id="price"
                       required="" placeholder="Prix">
            </div>
            <div class="w3-section">
                <input type="submit" value="Enregistrer" class="w3-button w3-theme2">
            </div>
        </form>
    </div>

    <div id="info_popup_2" class="w3-modal">
        <div class="w3-modal-content w3-card-4">
            <header class="w3-container w3-couleur-front" style="padding: 20px;margin-bottom: 20px;">
            <span onclick="document.getElementById('info_popup_2').style.display='none'"
                  class="w3-button w3-display-topright">&times;</span>
                <h2>Service obligatoire</h2>
            </header>
            <div class="w3-container">
                Il y a deux types de services : les services obligatoires et les services à la carte. Le service
                obligatoire sera compté dans le prix affiché lors du remplissage du formulaire de réservation.
                <br/>
                L'autre type de service sera visible en cliquant sur "plus d'info" en bas du formulaire de réservation.
            </div>
            <br />
        </div>
    </div>
</div>

<br>
<hr />

<!-- Script for Sidebar, Tabs, Accordions, Progress bars and slideshows -->
<script src="./web/js/jquery-1.12.4.js"></script>
<script src="./web/js/jquery-ui.js"></script>
<link rel="stylesheet" href="./web/css/jquery-ui.css">
<!-- change price -->
<script>
    $(function () {
        $("#btn_non_reservable").click(() => {
            $('input[id="input_price"]').val(0);
        });
    });
</script>
<!-- //change price -->
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
<!-- // Menu -->
<script>
    function openMenu(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("city");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("testbtn");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    const mybtn = document.getElementsByClassName("testbtn")[0];
    mybtn.click();
</script>
<!-- // Menu réservations validées -->
<script>
    function openMenu2(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("city2");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("testbtn2");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    const mybtn2 = document.getElementsByClassName("testbtn2")[0];
    mybtn2.click();
</script>


