<?php
session_start();

include "../classes/Demande.php";
include "../classes/User.php";

if(isset($_POST["a"]) && !empty($_POST["a"])) {
    
    $action = htmlspecialchars($_POST["a"]);
    
    switch ($action) {
        case "achieve":
            achieve();
            break;
        case "delete":
            delete();
            break;
        case "getPending":
            getPending();
            break;
        case "getAchieved":
            getAchieved();
            break;
        case "updateAccount":
            updateAccount();
            break;
        case "createAccount":
            createAccount();
            break;
    }
}

function achieve() {
    if(isset($_POST["id"]) && !empty($_POST["id"])) {
        $id = htmlspecialchars($_POST["id"]);
        $Demande = new Demande($id);
        if($Demande->achieve()) {
            echo '{"error":false}';
        } else {
            echo '{"error":true,"errorStr":"Impossible de traiter la demande."}';
        }
    }
}

function delete() {
    if(isset($_POST["id"]) && !empty($_POST["id"])) {
        $id = htmlspecialchars($_POST["id"]);
        $Demande = new Demande($id);
        if($Demande->delete()) {
            echo '{"error":false}';
        } else {
            echo '{"error":true,"errorStr":"Impossible de supprimer la demande."}';
        }
    }
}

function getPending() {
    
    if($list = Demande::getPending()) {
        
        $aff = '{"data":[';
        $cpt = 0;
        
        foreach ($list as $value) {

            $Demande = new Demande($value->id);
            
            $aff .= '{';
            $aff .= '"pseudo":"'.$Demande->getPseudo().'",';
            $aff .= '"mail":"'.$Demande->getMail().'",';
            $aff .= '"message":"'.$Demande->getDemande().'",';
            $aff .= '"date":"'.$Demande->getDate().'",';
            $aff .= '"id":"'.$Demande->getId().'"';
            $aff .= '}';

            if($cpt != count($list) -1) {
                $aff .= ',';
            }

            $cpt++;
        }
        
        $aff .= ']}';

        echo $aff;
        
    } else {
        echo '{"data":[]}';
    }
}

function getAchieved() {
    
    if($list = Demande::getAchieved()) {
        
        $aff = '{"data":[';
        $cpt = 0;
        
        foreach ($list as $value) {

            $Demande = new Demande($value->id);
            
            $aff .= '{';
            $aff .= '"pseudo":"'.$Demande->getPseudo().'",';
            $aff .= '"mail":"'.$Demande->getMail().'",';
            $aff .= '"message":"'.$Demande->getDemande().'",';
            $aff .= '"date":"'.$Demande->getDate().'",';
            $aff .= '"id":"'.$Demande->getId().'"';
            $aff .= '}';

            if($cpt != count($list) -1) {
                $aff .= ',';
            }

            $cpt++;
        }
        
        $aff .= ']}';

        echo $aff;
        
    } else {
        echo '{"data":[]}';
    }
}

function createAccount() {
    $pseudo = htmlspecialchars($_POST["pseudo"]);
    $pass = htmlspecialchars($_POST["pass"]);
    
    if(User::create($pseudo, password_hash($pass, PASSWORD_DEFAULT))) {
        echo '{"error":false}';
    } else {
        echo '{"error":true,"errorStr":"Impossible de créer un nouvel admin."}';
    }
}

function updateAccount() {
    $pseudo = htmlspecialchars($_POST["pseudo"]);
    $pass = htmlspecialchars($_POST["pass"]);
    
    if(User::update($_SESSION["admin"], $pseudo, password_hash($pass, PASSWORD_DEFAULT))) {
        echo '{"error":false}';
    } else {
        echo '{"error":true,"errorStr":"Impossible de modifier l\'admin."}';
    }
}
