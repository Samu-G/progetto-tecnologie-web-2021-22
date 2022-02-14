<?php require_once("../risorse/config.php");

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
}

?>
<?php require_once("carrello.php"); ?>
<?php include(FRONT_END . "/header.php"); ?>

<div class="container">
    <h1 class="text-center my-5">Il tuo ordine</h1>
    <h5 class="bg-warning text-center text-white"><?php mostraAvviso(); ?></h5>
    <div class="row">
        <div class="col-sm-12 col-md-10 col-lg-10 m-auto">

            <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Prodotto</th>
                        <th>Prezzo</th>
                        <th>Quantità</th>
                        <th>Importo</th>
                        <th>MODIFICA</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php carrello(); ?>

                    </tbody>
                </table>

            </form>

        </div>
    </div>

    <div class="row mt-5">
        <div class="col-5 ">
            <h2>Riepilogo ordine</h2>

            <table class="table table-bordered">
                <tr class="cart-subtotal">
                    <th>Articoli:</th>
                    <td>
                        <span class="amount"><?php echo $_SESSION['quantita_art'] ?? $_SESSION['quantita_art'] = '0'; ?></span>
                    </td>
                </tr>
                <tr class="shipping">
                    <th>Spedizione</th>
                    <td>Gratuita</td>
                </tr>
                <tr class="order-total">
                    <th>Totale ordine</th>
                    <td><strong><span
                                    class="amount">€<?php echo $_SESSION['totale'] ?? $_SESSION['totale'] = '0'; ?></span></strong>
                    </td>
                </tr>
                </tbody>

            </table>
        </div>
    </div>


    <div class="container">

        <h1 class="text-center my-5"><a class="btn btn-success" href="carrello.php?completa_acquisto=true"
                                        role="button">Completa l'ordine</a></h1>

    </div>
</div>

<?php include(FRONT_END . "/footer.php"); ?>
