<?php require_once("../risorse/config.php");

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
}

?>
<?php include(FRONT_END . "/header.php"); ?>

<div class="container my-5">
    <h3 class="display-4">La tua wishlist</h3>
    <div class="display-3">
        <?php


        if (isset($_SESSION["username"])) {

            ?>

        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-10 col-lg-10 m-auto">

                    <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Prodotto</th>
                                <th>Prezzo</th>
                                <th>MODIFICA</th>
                            </tr>
                            </thead>
                            <tbody>


                            <tr>
                                <td>Blade Runner</td>
                                <td>25</td>
                                <td>
                                    <a class="btn btn-danger" href="wishlist.php?delete=43" role="button">Cancella</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                    </form>

                </div>
            </div>
        </div>

            <?php
            $connection = connection::connect();

            $sql = "SELECT * FROM wishlist WHERE username = " . $_SESSION["username"];

            $result = $connection->query($sql)->fetchAll();

            foreach ($result as $row) {

                $sql2 = "SELECT * FROM prodotti WHERE id_prodotto = " . $row["product_id"];

                $row2 = $connection->query($sql2)->fetchAll();
                ?>
                <tr>
                    <td><?= $row2['nome_prodotto'] ?></td>
                    <td><?= $row2['prezzo'] ?></td>
                </tr>
                <?php
            }

            if (isset($_GET["add"])) {


                $tmp = [
                    'wl_id' => null,
                    'username' => $_SESSION["username"],
                    'product_id' => $_GET["add"],
                ];

                $sql = "INSERT INTO wishlist(wl_id, username, product_id)
                VALUES (:wl_id,
                        :username,
                        :product_id)";

                $stmt = $connection->prepare($sql);

                $stmt->execute($tmp);

            }

            if (isset($_GET["delete"])) {
                $connection = connection::connect();

                $sql = "DELETE FROM wishlist WHERE id_prodotto = " . $_GET["delete"] . " AND username = " . $_SESSION["username"];

                $delete = $connection->query($sql);

                unset($_GET["delete"]);
            }


        } else {
            ?>
            <p>
                Non hai ancora effettuato alcun login!
            </p><?php
        }


        ?>
    </div>
</div>

<?php //include(FRONT_END . "/footer.php"); ?>

