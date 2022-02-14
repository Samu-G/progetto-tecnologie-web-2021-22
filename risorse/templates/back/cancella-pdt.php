<?php require_once("../../config.php"); ?>

<?php
if (isset($_GET['id'])) {

    $connection = connection::connect();

    $sql = "DELETE FROM prodotti WHERE id_prodotto = " . $_GET["id"];

    $delete = $connection->query($sql);

    creaAvviso("Hai cancellato un rapporto");

    header("Location: ../../../public/admin/index.php?prodotti-admin");
} else {
    header("Location: ../../../public/admin/index.php?prodotti-admin");

}