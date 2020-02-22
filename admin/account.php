<?php
session_start();

if(!isset($_SESSION["admin"])) {
    header("Location: http://french-gaming-family.yj.fr/login.php");
}

?>

<!DOCTYPE html>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>FGF - Admin</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"/>
        <link href="https://fonts.googleapis.com/css?family=Anton|Dancing+Script|Exo|Lobster|Macondo+Swash+Caps|Pacifico|Shadows+Into+Light&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/>
        <link rel="stylesheet" href="../public/css/admin.css"/>
    </head>

    <body>
        
        <header>
            <form action="../models/logout.php" method="post" class="text-center d-flex flex-column justify-content-around align-items-center">
                <a href="index.php" class="btn btn-lg btn-success btn-block">Accueil</a>
                <button class="btn btn-lg btn-danger btn-block" type="submit" name="submit">Déconnexion</button>
            </form>
        </header>
    <section class="container-fluid pl-0 pr-0">

        <section class="col-xl-12 text-center">
            
        </section><!-- /.container -->
    </section>

     <section class="container-fluid pl-0 pr-0">

        <section class="col-xl-12 text-center">

            <form class="text-center pt-4 col-sm-4 mx-auto mt-5 d-flex flex-column justify-content-around align-items-center">
                <h1 class="h3 mb-3 font-weight-normal">French-Gaming-Family Admin Compte</h1>
                
                <label for="in_login" class="sr-only">Login</label>
                <input type="text" id="in_login" class="form-control mb-3" placeholder="New login" required="" autofocus="" name="login">
                
                <label for="in_pass" class="sr-only">Pass</label>
                <input type="password" id="in_pass" class="form-control mb-3" placeholder="New password" required="" name="pass">
                <span class="d-none" id="pass-hint" style="color:red;">
                    <p>Le mot de passe doit contenir au minimum :</p>
                    <ul>
                        <li>8 charactères (Obligatoire)</li>
                        <li>1 lettre majuscule (Facultatif)</li>
                        <li>1 lettre minuscule (Facultatif)</li>
                        <li>1 chiffre (Facultatif)</li>
                        <li>1 charactère spécial (Facultatif)</li>
                    </ul>
                </span>

                <label for="in_confirm" class="sr-only">Pass</label>
                <input type="password" id="in_confirm" class="form-control mb-3" placeholder="Confirm password" required="" name="pass">
                <span class="d-none" id="confirm-hint" style="color:red;">Les mots de passe ne sont pas identique</span>

                <button data-id="<?=$_SESSION["admin"]?>" id="btn_modif" class="btn btn-lg btn-success btn-block" type="button">Confirm</button>
                <button data-id="<?=$_SESSION["admin"]?>" id="btn_add" class="btn btn-lg btn-warning btn-block" type="button">Add</button>
                <div id="notif" class="mt-4"></div>
            </form>

        </section><!-- /.container -->
    </section>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../public/js/account.js"></script>
    </body>
</html>
