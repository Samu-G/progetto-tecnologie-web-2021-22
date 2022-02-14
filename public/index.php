<?php require_once("../risorse/config.php");

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
}

?>

<?php include(FRONT_END . "/header.php"); ?>

<?php
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
}
?>

    <div class="container my-5">
        <div class="row">
            <?php include(FRONT_END . "/sidebar.php"); ?>
            <div class="col-lg-9">
                <div class="row">
                    <?php mostraProdotti(); ?>
                </div>
            </div>
        </div>
    </div>

<?php include(FRONT_END . "/footer.php"); ?>