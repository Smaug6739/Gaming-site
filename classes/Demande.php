<?php
if (file_exists("../models/db.php")) {
    include "../models/db.php";
} else {
    include "models/db.php";
}


/**
 *
 */
class Demande {

    private $_id;
    private $_pseudo;
    private $_mail;
    private $_demande;
    private $_statut;
    private $_date;

    function __construct($id = false) {

        if($id) {
            global $db;

            $sql = "SELECT pseudo, mail, demande, statut, date_insert FROM demandes WHERE id = $id";
            $req = $db->prepare($sql);

            if($req->execute()) {

                $res = $req->fetch(PDO::FETCH_OBJ);

                $this->_id = $id;
                $this->_pseudo = $res->pseudo;
                $this->_mail = $res->mail;
                $this->_demande = $res->demande;
                $this->_statut = $res->statut;
                $this->_date = $res->date_insert;

            } else {
                error_log("SQL ERROR : $sql", 0);
            }
        }


    }

    public function getId() {
        return $this->_id;
    }

    public function setId($id) {
        $this->_id = $id;
    }

    public function getPseudo() {
        return $this->_pseudo;
    }

    public function setPseudo($pseudo) {
        $this->_pseudo = $pseudo;
    }

    public function getMail() {
        return $this->_mail;
    }

    public function setMail($mail) {
        $this->_mail = $mail;
    }

    public function getDemande() {
        return $this->_demande;
    }

    public function setDemande($demande) {
        $this->_demande = $demande;
    }

    public function getStatut() {
        return $this->_statut;
    }

    public function setStatut($statut) {
        $this->_statut = $statut;
    }

    public function getDate() {
        return date("d/m/Y H:i", $this->_date);
    }

    public function setDate($date) {
        $this->_date = $date;
    }

    public function insert() {
        global $db;

        $sql = "INSERT INTO demandes (pseudo, mail, demande, statut, date_insert) VALUES('$this->_pseudo', '$this->_mail', '$this->_demande', $this->_statut, UNIX_TIMESTAMP(NOW()))";
        $req = $db->prepare($sql);

        if($req->execute()) {

            return true;

        } else {
            error_log("SQL ERROR : $sql", 0);
        }
        return false;
    }
    
    public function achieve() {
        global $db;
        
        $id = $this->_id;
        $sql = "UPDATE demandes SET statut = 1 WHERE id = $id";
        $req = $db->prepare($sql);
        
        if($req->execute()) {
            return true;
        }
        error_log("SQL ERROR : $sql", 0);
        return false;
    }
    
    public function delete() {
        global $db;
        
        $id = $this->_id;
        $sql = "DELETE FROM demandes WHERE id = $id";
        $req = $db->prepare($sql);
        
        if($req->execute()) {
            return true;
        }
        error_log("SQL ERROR : $sql", 0);
        return false;
    }

    public static function getPending() {
        global $db;

        $sql = "SELECT id FROM demandes WHERE statut = 0 ORDER BY date_insert ASC";
        $req = $db->prepare($sql);

        if($req->execute()) {
            $res = $req->fetchAll(PDO::FETCH_OBJ);
            return $res;
        }
        return false;
    }
    
    public static function getAchieved() {
        global $db;

        $sql = "SELECT id FROM demandes WHERE statut = 1 ORDER BY date_insert DESC";
        $req = $db->prepare($sql);

        if($req->execute()) {
            $res = $req->fetchAll(PDO::FETCH_OBJ);
            return $res;
        }
        return false;
    }
}

