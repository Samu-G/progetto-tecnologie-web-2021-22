<?php require_once("../risorse/config.php");

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
}

?>

<?php require_once("carrello.php"); ?>

<?php include(FRONT_END . "/header.php"); ?>

    <div class="container">

        <h2 class="display-4 mt-5">Grazie per l'acquisto</h2>
        <?php

        $prezzo = $_GET["amt"];
        $valuta = $_GET["cc"];
        $transazione = $_GET["tx"];
        $stato = $_GET["st"];

        $connection = connection::connect();

        $sql = "INSERT INTO `ordini` (`id_ordine`, `importo_ordine`, `num_ordine`, `status_ordine`, `cur_ordine`) VALUES ('44' , '$prezzo', '$transazione', '$stato', '$valuta')";

        $stmt = $connection->prepare($sql);

        $stmt->execute();
        ?>
        <h2 class="display-4 mt-5">Grazie per l'acquisto</h2>
        <?php
        sleep(4);
        header("Location: index.php");
        ?>

    </div>

<?php include(FRONT_END . "/footer.php"); ?>