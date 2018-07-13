<?php
/**
 * Created by PhpStorm.
 * User: victorfauquembergue
 * Date: 05/07/2018
 * Time: 10:34
 */


if ($_SERVER['SERVER_NAME'] == "localhost" OR $_SERVER['SERVER_NAME'] == "88.181.184.138") {
    // To
    define("WEBMASTER_EMAIL", 'ccarvalho@sikia.com');

    ini_set('SMTP', 'smtp.gmail.com');
} else {
    // To
    define("WEBMASTER_EMAIL", 'contact@aikis.fr');
}

require('./config/config.php');

error_reporting(E_ALL ^ E_NOTICE);

$post = (!empty($_POST)) ? true : false;

if ($post) {

    $name = stripslashes($_POST['prenom']." ".$_POST['nom']);
    $email = trim($_POST['email']);
    $tel = stripslashes($_POST['tel']);

    if ($_POST['choice'] == "accept") {
        $subject = "[Gîte Domaine Les Raynals] Votre réservation a été accepté";

        $req = $bdd->prepare('UPDATE reservations SET status = :status WHERE id = :id');
        $req->execute(array(
            'status' => 'accepte',
            'id' => $_POST['id']));

        $req = $bdd->prepare('SELECT * FROM reservations WHERE id = :id');
        $req->execute(array(
            'id' => $_POST['id']));

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
    } else if ($_POST['choice'] == "refuse") {
        $subject = "[Gîte Domaine Les Raynals] Votre réservation a été refusé";

        $req = $bdd->prepare('DELETE FROM reservations WHERE id = :id');
        $req->execute(array(
            'id' => $_POST['id']));
    }

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
}

echo "<script>document.location.href = './index.php';</script>";

?>