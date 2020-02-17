<?php
session_start();

if(!isset($_SESSION["admin"])) {
    header("Location: http://french-gaming-family.yj.fr/login.php");
}

include "classes/Demande.php";

?>

<!DOCTYPE html>
<html>
    <head>
        <title>FGF - Admin</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"/>
        <link href="https://fonts.googleapis.com/css?family=Anton|Dancing+Script|Exo|Lobster|Macondo+Swash+Caps|Pacifico|Shadows+Into+Light&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="public/css/style.css"/>
    </head>

    <body>
    <section class="container-fluid pl-0 pr-0">

        <section class="col-xl-12 text-center">

            <h1 class="mb-5">Administration French-Gaming-Family</h1>

            <h3 class="mt-5">Dernières demandes</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Pseudo</th>
                        <th scope="col">Mail</th>
                        <th scope="col">Message</th>
                        <th scope="col">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                        $aff = "";

                        if($list = Demande::getAll()) {
                            foreach ($list as $value) {

                                $Demande = new Demande($value->id);

                                $aff .= "<tr>";
                                $aff .= "   <td>";
                                $aff .= $Demande->getPseudo();
                                $aff .= "   </td>";
                                $aff .= "   <td>";
                                $aff .= $Demande->getMail();
                                $aff .= "   </td>";
                                $aff .= "   <td>";
                                $aff .= $Demande->getDemande();
                                $aff .= "   </td>";
                                $aff .= "   <td>";
                                $aff .= $Demande->getDate();
                                $aff .= "   </td>";
                                $aff .= "</tr>";
                            }

                            echo $aff;
                        }
                    ?>
                </tbody>
            </table>

            <form action="models/logout.php" method="post" class="text-center pt-4 col-sm-4 mx-auto mt-5 d-flex flex-column justify-content-around align-items-center">
                <button class="btn btn-lg btn-danger btn-block" type="submit" name="submit">Déconnexion</button>
            </form>

        </section><!-- /.container -->
    </section>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="public/js/script.js"></script>
    </body>
</html>
