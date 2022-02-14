<?php require_once("../risorse/config.php");

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
}

?>

<?php include(FRONT_END . "/header.php"); ?>

<div class="container my-5">
    <?php mostraCardProdotto(); ?>
</div>

<?php include(FRONT_END . "/footer.php"); ?>