<?php require_once("../../risorse/config.php"); ?>
<?php include(BACK_END . "/header.php"); ?>

<?php
if (!isset($_SESSION["username"])) {
    header("Location: ../../public");
}
?>

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Pannello di amministrazione
                </h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="material-icons">dashboard</i> Dashboard
                    </li>
                </ol>
            </div>
        </div>
        <?php
        if ($_SERVER["REQUEST_URI"] == "/ECOMM/public/admin/" || $_SERVER["REQUEST_URI"] == "/ECOMM/public/admin/index.php") {

            include(BACK_END . "/content_admin.php");
        }
        if (isset($_GET["ordini"])) {
            include(BACK_END . "/ordini.php");
        }

        if (isset($_GET["prodotti-admin"])) {
            include(BACK_END . "/prodotti-admin.php");
        }

        if (isset($_GET["aggiungi-pdt"])) {
            include(BACK_END . "/aggiungi-pdt.php");
        }

        if (isset($_GET["aggiorna-pdt"])) {
            include(BACK_END . "/aggiorna-pdt.php");
        }

        if (isset($_GET["categorie-admin"])) {
            include(BACK_END . "/categorie-admin.php");
        }
        ?>
    </div>
</div>

<?php include(BACK_END . "/footer.php"); ?>
