<?php require_once("../risorse/config.php");

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
}

?>

<?php include(FRONT_END . "/header.php"); ?>

    <div class="container my-5">
        <h1 class="my-4"> <?php echo ottieniNomeCategoria(); ?> </h1>
        <div class="row">
            <?php paginaCategoria(); ?>
        </div>
    </div>

<?php include(FRONT_END . "/footer.php"); ?>