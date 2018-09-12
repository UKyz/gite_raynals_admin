<?php
/**
 * Created by PhpStorm.
 * User: victorfauquembergue
 * Date: 17/07/2018
 * Time: 14:54
 */

$tab = Reservations::askReservation($_POST['id']);

$name = stripslashes($tab['name']);
$email = trim($_POST['email']);
$tel = stripslashes($_POST['phone']);
$subject = "[Gîte Domaine Les Raynals] Votre réservation a été accepté";

Reservations::acceptReservation($_POST['id']);

Calendrier::acceptReservation($_POST['id']);

$message = "Le message provient de <br><br>";
$message .= "Identité : ".$name."<br>";
$message .= "Email : ".$email."<br>";
$message .= "Téléphone : ".$tel."<br><br>";
$message .= "Réservation demandé du ".$tab['date_begin']." ".$tab['date_end']."<br>";
if ($_POST['message'] == "") {
    $message .= "Message : Aucun message supplémentaire.<br><br>".stripslashes($_POST['message']);
}
else {
    $message .= "Message : <br><br>" . stripslashes($tab['comment']);
}

$error = '';

if (!$error) {
    $mail = mail("ccarvalho@sikia.fr", $subject, $message, "From: ".$tab['name']." <" . $email . ">\r\n"
        . "Reply-To: " . $email . "\r\n"
        . "Content-type:text/html; charset=utf-8" . "\r\n"
        . "X-Mailer: PHP/" . phpversion());
}

header('Location: ./index.php?type=accept_reservation');
//echo "<script>document.location.href = './index.php?type=accept_reservation';</script>";