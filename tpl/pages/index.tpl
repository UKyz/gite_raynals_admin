<div class='w3-bar w3-theme' >
    <a href = '#' class='w3-bar-item w3-button w3-padding-16' > Home</a >
    <a href = '#reservations' class='w3-bar-item w3-button w3-padding-16' id='btn_reservations'> Réservation</a >
    <a href = '#calendrier' class='w3-bar-item w3-button w3-padding-16' id='btn_calendrier'> Calendrier</a >
    <a href = '#demandes' class='w3-bar-item w3-button w3-padding-16' id='btn_demandes'> Demandes</a >
    <a href = '#prix' class='w3-bar-item w3-button w3-padding-16' id='btn_prix'> Prix</a >
    <a href = '#reservable' class='w3-bar-item w3-button w3-padding-16' id='btn_reservable'> Disponibilité</a >
    <a href = './index.php?action=deconnexion' class='w3-bar-item w3-button w3-padding-16' > Se Déconnecter</a >
</div >

<hr />
<br>

<div class="w3-row-padding" id="reservations">
    <div class="w3-half">
        <div class="w3-center">
            <h2>Demandes de réservation</h2>
            <p w3-class="w3-large">Les réservations en attente s'afficheront ici</p>
        </div>
        <div class="w3-responsive w3-card-4">
            {$demand_reservations_script}
        </div>
    </div>

    <div class="w3-half">
        <div class="w3-center">
            <h2>Réservations validés</h2>
            <p w3-class="w3-large">Les réservation validées s'afficheront ici.</p>
        </div>
        <div class="w3-responsive w3-card-4">
            {$accepted_reservations_script}
        </div>
    </div>
</div>

<hr />

<div class="w3-center" id="calendrier">
    <h2>Calendrier</h2>
    <p w3-class="w3-large">Les jours réservés, en attente et non réservable s'afficheront ici.</p>
</div>
<div class="w3-container" id="demoPicker" style="height:450px;width:100%;max-width: 450px; margin-left: auto;
            margin-right: auto;"></div>
<script src="./node_modules/datepickk/dist/datepickk.js"></script>
<script src="./node_modules/moment/moment.js"></script>
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
    demoPicker.locked = true;
    {$main_calendrier_script}
</script>

<hr />

<div class="w3-row-padding" id="demandes">
    <div class="w3-center">
        <h2>Gérer les réservations</h2>
        <p w3-class="w3-large">Les réservations en attente s'afficheront ici.</p>
    </div>
    <div class="w3-responsive w3-card-4">
        {$manage_reservations_script}
    </div>
</div>
<hr />

<div class="w3-row-padding" id="prix">
    <div class="w3-center">
        <h2>Gérer les prix</h2>
        <p w3-class="w3-large">Gérer les prix des réservations jour par jour.</p>
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
        <form class="w3-container w3-card-4" action="./index.php?action=price" method="post">
            <h2>Changer les prix</h2>
            <div class="w3-section">
                <input class="w3-input" type="number" name="price" required>
                <label>Prix par nuit (en €) *</label>
            </div>
            <div class="w3-section">
                <input type="text" class="w3-input" name="date_begin" id="date_begin_1"
                       required="">
                <label>Date de début *</label>
            </div>
            <div class="w3-section">
                <input type="text" class="w3-input" name="date_end" id="date_end_1"
                       required="">
                <label>Date de fin *</label>
            </div>
            <div class="w3-section">
                <input type="submit" value="Accepter" class="w3-button w3-theme">
            </div>
        </form>
    </div>
</div>
<hr>

<div class="w3-row-padding" id="reservable">
    <div class="w3-center">
        <h2>Gérer les jours réservables</h2>
        <p w3-class="w3-large">Gérer la réservabilité jour par jour de votre gîte.</p>
    </div>

    <div class="w3-half price_form" id="demoPicker3"></div>
    <script>
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
        {$available_calendrier_script}
    </script>

    <div class="w3-half price_form">
        <form class="w3-container w3-card-4" action="index.php?action=manage" method="post">
            <h2>Changer les jours réservables</h2>
            <div class="w3-section">
                <div class='w3-half'>
                    <input class="w3-check" type='radio' name="choice" value='disable' checked>
                    <label>Non Réservable</label>
                </div>
                <div class='w3-half'>
                    <input class="w3-check" type='radio' name="choice" value='able'>
                    <label>Réservable</label>
                </div>
            </div>
            <div class="w3-section">
                <input type="text" class="w3-input" name="date_begin" id="date_begin_2"
                       required="">
                <label>Date de début *</label>
            </div>
            <div class="w3-section">
                <input type="text" class="w3-input" name="date_end" id="date_end_2"
                       required="">
                <label>Date de fin *</label>
            </div>
            <div class="w3-section">
                <input type="submit" value="Accepter" class="w3-button w3-theme">
            </div>
        </form>
    </div>
</div>

<br>
<hr />

<!-- Script for Sidebar, Tabs, Accordions, Progress bars and slideshows -->
<script src="./web/js/jquery-1.12.4.js"></script>
<script src="./web/js/jquery-ui.js"></script>
<link rel="stylesheet" href="./web/css/jquery-ui.css">
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