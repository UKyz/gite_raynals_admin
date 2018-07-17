<?php /* Smarty version Smarty-3.1.12, created on 2018-07-17 11:25:05
         compiled from "/Users/victorfauquembergue/Sites/gite-backend-projet/tpl/pages/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19691238015b4c682f7c12e8-24112360%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e9aa1d994c8943d0411993ad9765c10b59255249' => 
    array (
      0 => '/Users/victorfauquembergue/Sites/gite-backend-projet/tpl/pages/index.tpl',
      1 => 1531819503,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19691238015b4c682f7c12e8-24112360',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5b4c682f82fc79_80705558',
  'variables' => 
  array (
    'demand_reservations_script' => 0,
    'accepted_reservations_script' => 0,
    'main_calendrier_script' => 0,
    'manage_reservations_script' => 0,
    'price_calendrier_script' => 0,
    'available_calendrier_script' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b4c682f82fc79_80705558')) {function content_5b4c682f82fc79_80705558($_smarty_tpl) {?><div class='w3-bar w3-theme' >
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
            <?php echo $_smarty_tpl->tpl_vars['demand_reservations_script']->value;?>

        </div>
    </div>

    <div class="w3-half">
        <div class="w3-center">
            <h2>Réservations validés</h2>
            <p w3-class="w3-large">Les réservation validées s'afficheront ici.</p>
        </div>
        <div class="w3-responsive w3-card-4">
            <?php echo $_smarty_tpl->tpl_vars['accepted_reservations_script']->value;?>

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
    <?php echo $_smarty_tpl->tpl_vars['main_calendrier_script']->value;?>

</script>

<hr />

<div class="w3-row-padding" id="demandes">
    <div class="w3-center">
        <h2>Gérer les réservations</h2>
        <p w3-class="w3-large">Les réservations en attente s'afficheront ici.</p>
    </div>
    <div class="w3-responsive w3-card-4">
        <?php echo $_smarty_tpl->tpl_vars['manage_reservations_script']->value;?>

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

        <?php echo $_smarty_tpl->tpl_vars['price_calendrier_script']->value;?>

    </script>

    <div class="w3-half price_form">
        <form class="w3-container w3-card-4" action="price.php" method="post">
            <h2>Changer les prix</h2>
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
                <input class="w3-input" type="number" name="price" required>
                <label>Prix par nuit (en €) *</label>
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
        <?php echo $_smarty_tpl->tpl_vars['available_calendrier_script']->value;?>

    </script>

    <div class="w3-half price_form">
        <form class="w3-container w3-card-4" action="disable.php" method="post">
            <h2>Changer les jours réservables</h2>
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
                <div class='w3-half'>
                    <input class="w3-input" type='radio' name="choice" value='disable' checked>
                    <label>Non Réservable</label>
                </div>
                <div class='w3-half'>
                    <input class="w3-input" type='radio' name="choice" value='able'>
                    <label>Réservable</label>
                </div>
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
</script><?php }} ?>