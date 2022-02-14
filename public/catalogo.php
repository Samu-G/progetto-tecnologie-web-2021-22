<?php require_once("../risorse/config.php");

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
}

?>

<?php include(FRONT_END . "/header.php"); ?>

<div class="container my-5">
    <h3 class="display-4">Catalogo</h3>
    <div class="row">
        <?php catalogoProdotti(); ?>
    </div>
</div>

<?php include(FRONT_END . "/footer.php"); ?>

    