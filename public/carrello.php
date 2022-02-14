<?php

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
}

require_once("../risorse/config.php");


if (isset($_GET["add"])) {

    $connessione = connection::connect();

    $sql = "SELECT * FROM prodotti WHERE id_prodotto = " . $_GET["add"];

    $controllaQuantita = $connessione->query($sql)->fetchAll();

    foreach ($controllaQuantita as $row) {
        if ($row["quantita_pdt"] != ($_SESSION["prodotto_" . $_GET["add"]] ?? 0)){
            $_SESSION["prodotto_" . $_GET["add"]] += 1;
            header("Location: checkout.php");
        } else {
            header("Location: checkout.php");
        }

    }
}

if (isset($_GET["remove"])) {
    $_SESSION["prodotto_" . $_GET["remove"]] -= 1;
    unset($_SESSION["totale"]);
    unset($_SESSION["quantita_art"]);
    header("Location: checkout.php");
}

if (isset($_GET["delete"])) {
    $_SESSION["prodotto_" . $_GET["delete"]] = 0;
    unset($_SESSION["totale"]);
    unset($_SESSION["quantita_art"]);
    header("Location: checkout.php");
}


function carrello()
{
    $totaleOrdine = 0;
    $totArticoli = 0;

    foreach ($_SESSION as $name => $value) {
        if ($value > 0) {
            if (substr($name, 0, 9) == 'prodotto_') {

                $lungStringa = strlen($name) - 9;

                $id = substr($name, 9, $lungStringa);

                $connessione = connection::connect();

                $sql = "SELECT * FROM prodotti WHERE id_prodotto = " . $id;

                $result = $connessione->query($sql)->fetchAll();

                foreach ($result as $row) {

                    $importo = $row["prezzo"] * $value;

                    $totArticoli += $value;

                    ?>

                    <tr>
                        <td><?= $row['nome_prodotto'] ?></td>
                        <td><?= $row['prezzo'] ?></td>
                        <td><?= $value ?></td>
                        <td><?= $importo ?></td>
                        <td><a class="btn btn-success" href="carrello.php?add=<?= $row['id_prodotto'] ?>" role="button">Aggiungi</a>
                        </td>
                        <td><a class="btn btn-warning" href="carrello.php?remove=<?= $row['id_prodotto'] ?>"
                               role="button">Rimuovi</a>
                        </td>
                        <td><a class="btn btn-danger" href="carrello.php?delete=<?= $row['id_prodotto'] ?>"
                               role="button">Cancella</a>
                        </td>
                    </tr>

                    <?php

                    $_SESSION['totale'] = $totaleOrdine += $importo;
                }
                $_SESSION['quantita_art'] = $totArticoli;
            }
        }
    }
}


function transazioni()
{


    if ($_SESSION["totale"] > 0) {
//
//                $connection = connection::connect();
//
//                $tmp = [
//                    'importo_ordine' => $_SESSION["totale"],
//                    'num_ordine' => $_SESSION["quantita_art"],
//                    'status_ordine' => "Completato",
//                    'cur_ordine' => "Euro",
//                ];
//
//
//                $sql = "INSERT INTO ordini (importo_ordine , num_ordine , status_ordine , cur_ordine)
//                VALUES (:importo_ordine,
//                    :num_ordine,
//                    :status_ordine,
//                    :cur_ordine)";
//
//                $stmt = $connection->prepare($sql);
//
//                $stmt->execute($tmp);

        session_destroy();
        sleep(5);
        header("Location: completato.php");
    }


}


if (isset($_GET['completa_acquisto'])) {
    unset($_GET['completa_acquisto']);
}


