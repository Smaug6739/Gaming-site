<?php

include "../classes/Demande.php";

if(isset($_POST["a"]) && !empty($_POST["a"])) {
    $action = htmlspecialchars($_POST["a"]);

    switch($action) {
        case "demande":
            insertDemande();
            break;
    }
}

function insertDemande() {
    $error = 0;
    $errorStr = "";
    $name = "";
    $mail = "";
    $message = "";

    if(isset($_POST["in_name"]) && !empty($_POST["in_name"])) {

        $name = htmlspecialchars($_POST["in_name"]);

    } else {
        $error++;
        $errorStr .= "Le champs nom/raison sociale n'a pas été renseigné.<br>";
    }

    if(isset($_POST["in_mail"]) && !empty($_POST["in_mail"])) {

        $mail = htmlspecialchars($_POST["in_mail"]);

    } else {
        $error++;
        $errorStr .= "Le champs mail n'a pas été renseigné.<br>";
    }

    if(isset($_POST["ta_message"]) && !empty($_POST["ta_message"])) {

        $message = htmlspecialchars($_POST["ta_message"]);

    } else {
        $error++;
        $errorStr .= "Le message ne peut être vide.";
    }

    if($error === 0) {

        /*$to      = 'marvin.poticadou@gmail.com';
        $headers = 'From: '.$mail.' - '.$name."\r\n".'Reply-To: '.$mail."\r\n".'Le : ' . date("d/m/Y - H:i:s");
        if(mail($to, $message, $headers)) {
            echo '{"error":false}';
        } else {
            echo '{"error":true,"errorStr":"Echec de l\'envoi du mail"}';
        }*/

        $Demande = new Demande();
        $Demande->setPseudo($name);
        $Demande->setMail($mail);
        $Demande->setDemande($message);
        $Demande->setStatut(0);

        if($Demande->insert()) {
            echo '{"error":false}';
        } else {
            echo '{"error":true,"errorStr":"Echec de l\'envoi de la demande"}';
        }

    } else {
        echo '{"error":true,"errorStr":"'.$errorStr.'"}';
    }
}

function sendMail() {
    $error = 0;
    $errorStr = "";
    $name = "";
    $mail = "";
    $message = "";

    if(isset($_POST["in_name"]) && !empty($_POST["in_name"])) {

        $name = htmlspecialchars($_POST["in_name"]);

    } else {
        $error++;
        $errorStr .= "Le champs nom/raison sociale n'a pas été renseigné.<br>";
    }

    if(isset($_POST["in_mail"]) && !empty($_POST["in_mail"])) {

        $mail = htmlspecialchars($_POST["in_mail"]);

    } else {
        $error++;
        $errorStr .= "Le champs mail n'a pas été renseigné.<br>";
    }

    if(isset($_POST["ta_message"]) && !empty($_POST["ta_message"])) {

        $message = htmlspecialchars($_POST["ta_message"]);

    } else {
        $error++;
        $errorStr .= "Le message ne peut être vide.";
    }

    if($error === 0) {

        $to      = 'marvin.poticadou@gmail.com';
        $headers = 'From: '.$mail.' - '.$name."\r\n".'Reply-To: '.$mail."\r\n".'Le : ' . date("d/m/Y - H:i:s");
        if(mail($to, $message, $headers)) {
            echo '{"error":false}';
        } else {
            echo '{"error":true,"errorStr":"Echec de l\'envoi du mail"}';
        }

    } else {
        echo '{"error":true,"errorStr":"'.$errorStr.'"}';
    }
}
