<?php

include "../classes/Demande.php";

if(isset($_POST["a"]) && !empty($_POST["a"])) {
    
    $action = htmlspecialchars($_POST["a"]);
    
    switch ($action) {
        case "achieve":
            achieve();
            break;
        case "delete":
            delete();
            break;
    }
}

function achieve() {
    if(isset($_POST["id"]) && !empty($_POST["id"])) {
        $id = htmlspecialchars($_POST["id"]);
        $Demande = new Demande($id);
        if(!$res = $Demande->achieve()) {
            echo '{"error":false}';
        } else {
            echo '{"error":true,"'.$res.'"}';
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
