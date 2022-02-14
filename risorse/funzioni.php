<?php

//classe volta ad effettuare la connessione al Database da parte delle funzioni
class Connection
{
    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $charset;


    public static function connect()
    {

        $servername = "localhost";
        $username = "user";
        $password = "user";
        $dbname = "negozio";
        $charset = "utf8mb4";


        try {
            $dsn = "mysql:host=" . $servername . ";dbname=" . $dbname . ";charset=" . $charset;
            $pdo = new PDO($dsn, $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

    }

}

//Mostra i prodotti per un limite di 6 all'interno della pagina Categorie
function mostraProdotti()
{
    $connection = connection::connect();

    $sql = "SELECT * FROM prodotti LIMIT 6";

    $products = $connection->query($sql);

    foreach ($products as $product) {
//      echo $product["nome_prodotto"];
//        echo $product["immagine"];
        ?>
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">

                <a href="#">
                    <?php
                    $srcImage = "src=../risorse/immagini/" . $product["immagine"] . " alt= " . $product["nome_prodotto"];
                    ?>
                    <img class="card-img-top" <?= $srcImage ?> >
                </a>

                <div class="card-body">
                    <h4 class="card-title">
                        <?php $href = "prodotto.php?id=" . $product["id_prodotto"]; ?>
                        <a href=<?= $href ?>> <?= $product["nome_prodotto"] ?> </a>
                    </h4>
                    <h5> € <?= $product["prezzo"] ?> </h5>
                    <p class="card-text"> <?= $product["descr_prodotto"] ?> </p>
                </div>

                <div class="card-footer">
                    <a href="carrello.php?add=<?= $product['id_prodotto']; ?>">
                        <button type="button" class="btn bg-primary btn-small btn-block">Acquista</button>
                    </a>
                </div>

            </div>
        </div>
        <?php
    }
}

//Mostra le categorie nel menu' laterale
function mostraCategorie()
{

    $connection = connection::connect();

    $sql = "SELECT * FROM categorie";

    $categories = $connection->query($sql);

    foreach ($categories as $row) {
        $href = "categorie.php?id=" . $row["id_cat"];
        ?>
        <a href=<?= $href ?> class="list-group-item"> <?= $row["nome_cat"] ?></a>
        <?php
    }
}

//Mostra la card del prodotto, nella pagina prodotto.php
function mostraCardProdotto()
{
    $connection = connection::connect();

    $id = $_GET["id"];

    $sql = "SELECT * FROM prodotti WHERE id_prodotto = " . $id;

    $query = $connection->query($sql);

    $result = $query->fetch();

    ?>
    <div class="col-lg-9">

        <div class="card mt-4">

            <?php $srcImage = "src=../risorse/immagini/" . $result["immagine"] . " alt= " . $result["nome_prodotto"]; ?>

            <img class="card-img-top img-fluid" <?= $srcImage ?> />

            <div class="card-body">

                <h3 class="card-title text-center mb-5">
                    <p> <?= $result['nome_prodotto']; ?> </p>
                </h3>

                <h4 class="mb-5">
                    <p class="text-center"> € <?= $result['prezzo']; ?> </p>
                </h4>

                <h5>Info</h5>

                <p class="card-text"><?= $result['descr_prodotto']; ?></p>

                <div class="card-footer">
                    <a href="carrello.php?add=<?= $result['id_prodotto']; ?>">
                        <button type="button" class="btn bg-primary btn-small btn-block">Acquista</button>
                    </a>
                    <br>
                    <a href="wishlist.php?add=<?= $result['id_prodotto']; ?>">
                        <button type="button" class="btn bg-secondary btn-small btn-block">Metti nella Wishlist</button>
                    </a>
                </div>


            </div>

        </div>

        <!-- /.card -->

        <div class="card card-outline-secondary my-4">
            <div class="card-header">
                Descrizione dettagliata
            </div>
            <div class="card-body">
                <p><?= $result['info_dettagliate']; ?></p>

            </div>
        </div>
        <!-- /.card -->

    </div>
    <!-- /.col-lg-9 -->
    <?php
}

// Ottiene il nome della categoria partendo dall'id passato tramite la variabile globale $_GET
function ottieniNomeCategoria()
{
    $connection = connection::connect();

    $id = $_GET["id"];

    $sql = "SELECT * FROM categorie WHERE id_cat = " . $id;

    $query = $connection->query($sql);

    $result = $query->fetch();

    return $result["nome_cat"];

}

// Visualizza i prodotti appartenenti a quella categoria, all'interno della pagina categorie.php
function paginaCategoria()
{
    $connection = connection::connect();

    $id = $_GET["id"];

    $sql = "SELECT * FROM prodotti WHERE cat_prodotto = " . $_GET["id"];

    $query = $connection->query($sql);

    foreach ($query as $row) {
        ?>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card altezza">
                <?php $srcImage = "src=../risorse/immagini/" . $row["immagine"] . " alt= " . $row["nome_prodotto"]; ?>
                <img class="card-img-top" <?php echo $srcImage ?> >
                <div class="card-body">
                    <h4 class="card-title"> <?php echo $row['nome_prodotto']; ?> </h4>
                    <p class="card-text"> <?php echo $row['descr_prodotto']; ?> </p>
                </div>
                <div class="card-footer">
                    <a href="carrello.php?add=<?= $row['id_prodotto']; ?>">
                        <button type="button" class="btn bg-primary btn-small btn-block">Acquista</button>
                    </a>
                </div>
            </div>
        </div>

        <?php
    }
}

//Visualizza il catalogo di tutti i prodotti (pagina catalogo.php) con delle piccole card
function catalogoProdotti()
{
    $connection = connection::connect();

    $sql = "SELECT * FROM prodotti";

    $query = $connection->query($sql);

    foreach ($query as $row) {
        ?>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card altezza">
                <?php $srcImage = "src=../risorse/immagini/" . $row["immagine"] . " alt= " . $row["nome_prodotto"]; ?>
                <img class="card-img-top" <?php echo $srcImage ?> >
                <div class="card-body">
                    <h4 class="card-title"><?php echo $row['nome_prodotto'] ?></h4>
                    <h5>€ <?php echo $row['prezzo'] ?> </h5>
                    <p class="card-text"> <?php echo $row['descr_prodotto'] ?> </p>
                </div>
                <div class="card-footer text-center">

                    <?php
                    $hrefCarrello = "checkout.php?add=" . $row["id_prodotto"];
                    $hrefProdotto = "prodotto.php?id=" . $row["id_prodotto"];
                    $hrefWishlist = "wishlist.php?add=" . $row["id_prodotto"];
                    ?>
                    <a href=<?= $hrefCarrello ?> class="btn btn-success btn-small"> Acquista </a>
                    <a href=<?= $hrefProdotto ?> class="btn btn-info btn-small"> Dettagli </a>
                    <a href=<?= $hrefWishlist ?> class="btn btn-info btn-small"> Wishlist </a>
                </div>
            </div>
        </div>
        <?php
    }
}

//crea una funzione per mostrare tutti i prodotti in una tabella
function prodottiAdmin()
{

    $connection = connection::connect();

    $sql = "SELECT * FROM prodotti";

    $products = $connection->query($sql);

    foreach ($products as $product) {
        $cercaCategoria = titoloCat($product['cat_prodotto']);

        ?>

        <tr>
            <td><?= $product["id_prodotto"] ?> </td>
            <td><?= $product["nome_prodotto"] ?> </td>
            <td><img src="../../risorse/immagini/<?= $product["immagine"] ?>" alt="" style="width:25%"></td>
            <td><?= $cercaCategoria ?> </td>
            <td>€<?= $product["prezzo"] ?> </td>
            <td><?= $product["quantita_pdt"] ?> </td>
            <td><a class="btn btn-primary" href="index.php?aggiorna-pdt&id=<?= $product["id_prodotto"] ?>"
                   role="button">Modifica</a>
            <td><a class="btn btn-danger"
                   href="../../risorse/templates/back/cancella-pdt.php?id=<?= $product["id_prodotto"] ?>" role="button">Cancella</a>
            </td>
        </tr>

        <?php
    }
}

//crea una funzione per la gestione dei messaggi
function creaAvviso($msg)
{
    if (!empty($msg)) {
        $_SESSION["messaggio"] = $msg;
    } else {
        $_SESSION["messaggio"] = " ";
    }
}

//crea una funzione per  mostrare un messaggio all'interno di una pagina
function mostraAvviso()
{
    if (isset($_SESSION["messaggio"])) {
        echo $_SESSION["messaggio"];
        unset ($_SESSION["messaggio"]);
    }
}

//Effettua il login settando appropriatamente le variabili d'ambiente della sessione in corso
function login()
{
    if (isset($_POST["login"])) {

        $_SESSION["login"] = "yes";
        $username = $_POST["username"];
        $password = $_POST["password"];
        $role = $_POST["role"];

        $connection = connection::connect();

        $sql = "SELECT * FROM utenti WHERE 
                           username = '$username' AND password = '$password' AND role = '$role'";

        $query = $connection->query($sql);

        if ($query->rowCount() > 0) {
            session_start();
            $_SESSION["username"] = $username;
            if ($role == "Admin") {
                $_SESSION["role"] = "Admin";
                header("Location: admin");
            } else {
                $_SESSION["role"] = "Utente";
                header("Location: wishlist.php");
            }
        } else {
            creaAvviso("Credenziali errate");
            header("Location: login.php");
        }
    }
}

//crea una funzione per modificare prodotti esistenti richiamandoli in un form
function aggiornaProdotto()
{
    $connection = connection::connect();

    if (isset($_POST["aggiorna"])) {

        $tmp = [
            'nomePdt' => $_POST["nome_pdt"],
            'catPdt' => $_POST["categoria_pdt"],
            'dettagli' => $_POST["dettagli"],
            'infoBreve' => $_POST["desc_breve"],
            'prezzo' => $_POST["prezzo"],
            'quantitaPdt' => $_POST["quantita_pdt"],
            'immaginePdt' => $_FILES["immagine"]["name"],
            'immagineTemp' => $_FILES["immagine"]["tmp_name"],
        ];

        if (empty($tmp["immaginePdt"])) {


            $sql = "SELECT immagine FROM prodotti WHERE 
                           id_prodotto = " . $_GET["id"];

            $query = $connection->query($sql);

            $tmp["immaginePdt"] = $query["immagine"];
        }

        move_uploaded_file($tmp["immagineTemp"], $tmp["immaginePdt"]);

        $sql = "UPDATE prodotti
                SET nome_prodotto = :nomePdt,
                    descr_prodotto = :infoBreve,
                    prezzo = :prezzo,
                    cat_prodotto = :catPdt,
                    immagine = :immaginePdt,
                    info_dettagliate = :dettagli,
                    quantita_pdt = :quantitaPdt
        WHERE publisher_id = :publisher_id";


        $stmt = $connection->prepare($sql);
        $stmt->execute($tmp);

        creaAvviso("hai modificato correttamente un prodotto");
        header("Location:index.php?prodotti-admin");

    }
}

//crea una funzione per  mostrare  il titolo della categoria del prodotto selezionato
function titoloCat($catPdt)
{

    $connection = connection::connect();

    $sql = "SELECT * FROM categorie WHERE id_cat = " . $catPdt;

    $category = $connection->query($sql);

    foreach ($category as $row) {
        return $row['nome_cat'];
    }
}

//crea una funzione per aggiungere nuovi prodotti tramite un form
function aggiungiPdt()
{
    $connection = connection::connect();

    if (isset($_POST["aggiungi"])) {

        $tmp = [
            'nomePdt' => $_POST["nome_pdt"],
            'catPdt' => $_POST["categoria_pdt"],
            'dettagli' => $_POST["dettagli"],
            'infoBreve' => $_POST["desc_breve"],
            'prezzo' => $_POST["prezzo"],
            'quantitaPdt' => $_POST["quantita_pdt"],
        ];

        move_uploaded_file($tmp["immagineTemp"], $tmp["immaginePdt"]);

        $sql = "INSERT INTO prodotti(nome_prodotto , cat_prodotto , info_dettagliate , descr_prodotto , prezzo , quantita_pdt , immagine)
                VALUES (:nomePdt,
                    :infoBreve,
                    :prezzo,
                    :catPdt,
                    :immaginePdt,
                    :dettagli,
                    :quantitaPdt)";

        $stmt = $connection->prepare($sql);
        $stmt->execute($tmp);

        creaAvviso("hai aggiunto correttamente un prodotto");
        header("Location:index.php?prodotti-admin");

    }
}

//crea una funzione per mostrare e selezionare la categoria del prodotto
function mostra_cat_prodotto()
{
    $connection = connection::connect();

    $sql = "SELECT * FROM categorie";

    $categories = $connection->query($sql);

    foreach ($categories as $category) {
        ?>
        <option value="<?= $category["id_cat"] ?>"><?= $category["nome_cat"] ?> </option>
        <?php
    }
}

//crea una funzione per mostrare le categorie nel lato amministrativo
function categorie_admin()
{
    $connection = connection::connect();

    $sql = "SELECT * FROM categorie";

    $categories = $connection->query($sql);

    echo "ciao";
    foreach ($categories as $category) {
        $catId = $category ["id_cat"];
        $catTitolo = $category["nome_cat"];

        ?>
        <tr>

            <td> <?= $catId ?> </td>
            <td> <?= $catTitolo ?> <br>

            <td><a class="btn btn-danger"
                   href="../../risorse/templates/back/cancella-cat.php?id=<?= $category["id_cat"] ?>" role="button">Cancella</a>
            </td>
        </tr>
        <?php
    }
}

//crea una funzione per mostrare e cancellare gli ordini nel lato amministrativo
function ordini()
{
    $connection = connection::connect();

    $sql = "SELECT * FROM ordini";

    $listaOrdini = $connection->query($sql);

    foreach ($listaOrdini as $row) {

        $ordineId = $row["id_ordine"];
        $importoOrdine = $row["importo_ordine"];
        $numeroOrdine = $row["num_ordine"];
        $statusOrdine = $row["status_ordine"];
        $userOrdine = $row["user_id"];
        ?>
        <tr>
            <td><?= $ordineId ?></td>
            <td><?= $importoOrdine ?></td>
            <td><?= $numeroOrdine ?></td>
            <td><?= $statusOrdine ?></td>
            <td><?= $userOrdine ?></td
        </tr>
        <?php
    }
}

//crea una funzione per mostrare e cancellare i rapporti nel lato amministrativo
function rapporti()
{

    $connection = connection::connect();

    $sql = "SELECT * FROM rapporti";

    $rapportiMostra = $connection->query($sql);

    foreach ($rapportiMostra as $row) {

        $rapportoId = $row['id_rapporto'];
        $idProdotto = $row['id_prodotto'];
        $idOrdine = $row['id_ordine'];
        $nomeProdotto = $row['nome_prodotto'];
        $prezzoOrdine = $row['prezzo'];
        $quantita = $row['quantita_pdt'];

        ?>
        <tr>
            <td><?= $rapportoId ?> </td>
            <td><?= $idProdotto ?>  </td>
            <td><?= $idOrdine ?> </td>
            <td><?= $nomeProdotto ?> </td>
            <td><?= $prezzoOrdine ?> </td>
            <td><?= $quantita ?> </td>
            <td><a class="btn btn-danger"
                   href="../../risorse/templates/back/cancella-rapporti.php?id=<?= $row['id_rapporto'] ?>"
                   role="button">Cancella</a></td>
        </tr>

        <?php
    }

}

//crea una funzione per gestire il percorso della cartella delle immagini
function mostraImg($imgProdotto)
{
    return "C:\MAMP\htdocs\ECOMM\risorse\immagini" . $imgProdotto;
}

//crea una funzione per un modulo di  ricerca (pagina ricerca.php)
function ricerca()
{
    if (isset($_POST["invia_ricerca"])) {

        $connection = connection::connect();

        $ricercaUtente = "'%" . $_POST["ricerca"] . "%'";

        $sql = "SELECT * FROM prodotti WHERE nome_prodotto LIKE " . $ricercaUtente;

        $risultatoRicerca = $connection->query($sql);

        foreach ($risultatoRicerca as $row) {
            ?>
            <div class="card mt-4">
                <img class="card-img-top img-fluid" src="../risorse/immagini/<?= $row['immagine'] ?>" alt="">
                <div class="card-body">
                    <h3 class="card-title text-center mb-5"><?= $row['nome_prodotto'] ?></h3>
                    <h4 class="mb-5">€<?= $row['prezzo'] ?></h4>
                    <h5>Info</h5>
                    <p class="card-text"><?= $row['descr_prodotto'] ?></p>
                    <button type="button" class="btn bg-primary btn-small btn-block">Acquista</button>
                </div>
            </div>
            <div class="card card-outline-secondary my-4">
                <div class="card-header">
                    Descrizione dettagliata
                </div>
                <div class="card-body">
                    <p><?= $row['info_dettagliate'] ?></p>
                </div>
            </div>
            <?php
        }
    }
}