<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Rasp-Home</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"/>
        <link href="https://fonts.googleapis.com/css?family=Anton|Dancing+Script|Exo|Lobster|Macondo+Swash+Caps|Pacifico|Shadows+Into+Light&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="public/css/style.css"/>
    </head>

    <body>
    <section class="container-fluid pl-0 pr-0">

        <section class="col-xl-12 text-center">

            <form action="models/login.php" method="post" class="text-center pt-4 col-sm-4 mx-auto mt-5 d-flex flex-column justify-content-around align-items-center">
                <h1 class="h3 mb-3 font-weight-normal">French-Gaming-Family Admin</h1>
                <label for="in_login" class="sr-only">Login</label>
                <input type="text" id="in_login" class="form-control mb-3" placeholder="login" required="" autofocus="" name="login">
                <label for="in_pass" class="sr-only">Pass</label>
                <input type="password" id="in_pass" class="form-control mb-3" placeholder="Password" required="" name="pass">
                <button class="btn btn-lg btn-success btn-block" type="submit" name="submit">Login</button>
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
