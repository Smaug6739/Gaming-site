<?php

include "../models/db.php";


/**
 *
 */
class User {

    private $_id;
    private $_login;
    private $_pass;
    private $_logged = false;

    function __construct($login, $pass) {
        global $db;

        $sql = "SELECT id, login, pass FROM users WHERE login = '$login'";
        $req = $db->prepare($sql);

        if($req->execute()) {

            $res = $req->fetch(PDO::FETCH_OBJ);
            $this->_id = $res->id;
            $this->_login = $res->login;
            $this->_pass = $pass;

        } else {
            error_log("SQL ERROR : $sql", 0);
        }
    }
    
    public function getId() {
        return $this->_id;
    }

    public function setId($id) {
        $this->_id = $id;
    }

    public function getLogin() {
        return $this->_login;
    }

    public function setLogin($login) {
        $this->_login = $login;
    }

    public function getPass() {
        return $this->_pass;
    }

    public function setPass($pass) {
        $this->_login = $pass;
    }

    public function getLogged() {
        return $this->_logged;
    }

    public function setLogged($logged) {
        $this->_logged = $logged;
    }

    public function verifyPass() {
        global $db;

        $login = $this->_login;

        $sql = "SELECT pass FROM users WHERE login = '$login'";
        $req = $db->prepare($sql);

        if($req->execute()) {
            $res = $req->fetch(PDO::FETCH_OBJ);
            if(password_verify($this->_pass, $res->pass)) {
                return true;
            }
            return false;
        } else {
            error_log("SQL ERROR : $sql", 0);
        }

    }
    
    public static function create($pseudo, $hash) {
        global $db;
        
        $sql = "INSERT INTO users (login, pass) VALUES('$pseudo', '$hash')";
        $req = $db->prepare($sql);
        
        error_log("SQL DEBUG : $sql", 0);
        
        if($req->execute()) {
            return true;
        }
        error_log("SQL ERROR : $sql", 0);
        return false;
    }
    
    public static function update($id, $pseudo, $hash) {
        global $db;
        
        $sql = "UPDATE users SET login = '$pseudo', pass = '$hash' WHERE id = $id";
        $req = $db->prepare($sql);
        
        if($req->execute()) {
            return true;
        }
        error_log("SQL ERROR : $sql", 0);
        return false;
    }
}
