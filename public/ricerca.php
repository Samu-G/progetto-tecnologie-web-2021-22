<?php require_once("../risorse/config.php");

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
}

?>

<?php include(FRONT_END . "/header.php"); ?>

<!-- Page Content -->
<div class="container my-5">
    <div class="row">

        <div class="col-lg-9">
            <?php ricerca(); ?>
        </div>

    </div>
