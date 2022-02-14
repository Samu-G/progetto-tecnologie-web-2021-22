<!DOCTYPE html>
<html lang="it">

<head>
    <link rel="icon" type="image/x-icon" href="https://img.icons8.com/plasticine/100/000000/lazada.png">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Torino CD</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Prompt|Ubuntu:400,700" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body>
<nav class="navbar navbar-expand-md  bg-primary fixed-top" id="navigazione">
    <div class="container">
        <a class="navbar-brand" href="index.php">Torino CD</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <i class="material-icons">menu</i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="catalogo.php">Catalogo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="checkout.php">Carrello</a>

                    <?php
                    if (isset($_SESSION["role"])) {
                    if ($_SESSION["role"] == "Admin") {
                    ?>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin">Admin</a>
                </li>

                <?php
                } else if ($_SESSION["role"] == "Utente") {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="wishlist.php">Wishlist</a>
                    </li>
                    <?php
                }
                ?>

                <?php
                if (isset($_SESSION["login"])) {
                    if ($_SESSION["login"] == "yes") {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Esci</a>
                        </li>
                        <?php
                    } else {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                        <?php
                    }
                } else {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <?php
                }
                }
                ?>

            </ul>
        </div>
    </div>
</nav>
</html>