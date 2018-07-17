<?php
/**
 * Created by PhpStorm.
 * User: victorfauquembergue
 * Date: 17/07/2018
 * Time: 15:22
 */

$name = stripslashes($_POST['prenom']." ".$_POST['nom']);
$email = trim($_POST['email']);
$tel = stripslashes($_POST['tel']);
$subject = "[Gîte Domaine Les Raynals] Votre réservation a été refusé";

$req = $bdd->prepare('DELETE FROM reservations WHERE id = :id');
$req->execute(array(
    'id' => $_POST['id']));

$message = "Le message provient de <br><br>";
$message .= "Identité : ".$name."<br>";
$message .= "Email : ".$email."<br>";
$message .= "Téléphone : ".$tel."<br><br>";
$message .= "Réservation demandé du ".$_POST['date_begin']." ".$_POST['date_end']."<br>";
if ($_POST['message'] == "") {
    $message .= "Message : Aucun message supplémentaire.<br><br>".stripslashes($_POST['message']);
}
else {
    $message .= "Message : <br><br>" . stripslashes($_POST['message']);
}

$error = '';

if (!$error) {
    $mail = mail(WEBMASTER_EMAIL, $subject, $message, "From: ".$_POST['prenom']." ".$_POST['nom']." <" . $email . ">\r\n"
        . "Reply-To: " . $email . "\r\n"
        . "Content-type:text/html; charset=utf-8" . "\r\n"
        . "X-Mailer: PHP/" . phpversion());
}

$req = $bdd->prepare('UPDATE reservations SET status = :status WHERE id = :id');
$req->execute(array(
    'status' => 'accepte',
    'id' => $_POST['id']));

echo "<script>document.location.href = './index.php?type=refuse_reservation';</script>";