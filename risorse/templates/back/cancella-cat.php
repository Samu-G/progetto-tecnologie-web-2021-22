<?php  require_once("../../config.php"); ?>

<?php 

if (isset($_GET["id"])) {

    $connection = connection::connect();

    $sql = "DELETE FROM categorie WHERE id_cat = " . $_GET["id"];

    $delete = $connection->query($sql);

    creaAvviso("Hai cancellato una categoria");

    header("Location: ../../../public/admin/index.php?categorie-admin");
} else {
    header("Location: ../../../public/admin/index.php?categorie-admin");

}



