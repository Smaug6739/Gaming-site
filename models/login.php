<?php
session_start();
require_once("../classes/User.php");



if (isset($_POST["submit"])) {
    //error_log("submit ok", 0);

    if (isset($_POST["login"]) && isset($_POST["pass"])) {
        $login = htmlspecialchars($_POST["login"]);
        $pass = htmlspecialchars($_POST["pass"]);

        $User = new User($login, $pass);

        if($User->verifyPass()) {
            error_log("pass verif OK", 0);
            $User->setLogged(true);
            $_SESSION["admin"] = $User;

        } else {
            error_log("pass verif KO", 0);
            unset($_SESSION);
        }

        header("Location: http://french-gaming-family.yj.fr/admin/");
    }
}
