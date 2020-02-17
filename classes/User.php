<?php

include "../models/db.php";

/**
 *
 */
class User {

    private $_login;
    private $_pass;
    private $_logged = false;

    function __construct($login, $pass) {
        global $db;

        $sql = "SELECT login FROM users WHERE login = '$login'";
        $req = $db->prepare($sql);

        if($req->execute()) {

            $res = $req->fetch(PDO::FETCH_OBJ);

            $this->_login = $res->login;
            $this->_pass = $pass;

        } else {
            error_log("SQL ERROR : $sql", 0);
        }
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
            error_log($res->pass, 0);
            if(password_verify($this->_pass, $res->pass)) {
                return true;
            }
            return false;
        } else {
            error_log("SQL ERROR : $sql", 0);
        }

    }
}
