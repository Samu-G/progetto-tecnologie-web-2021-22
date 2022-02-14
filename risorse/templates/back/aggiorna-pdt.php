<?php
if (isset($_GET["id"])) {

    $connection = connection::connect();

    $sql = "SELECT * FROM prodotti WHERE id_prodotto = " . $_GET["id"];

    $products = $connection->query($sql);

    foreach ($products as $product) {
        $nomePdt = $product["nome_prodotto"];
        $catPdt = $product["cat_prodotto"];
        $dettagli = $product["info_dettagliate"];
        $infoBreve = $product["descr_prodotto"];
        $prezzo = $product["prezzo"];
        $quantitaPdt = $product["quantita_pdt"];
        $immaginePdt = $product["immagine"];
        $immaginePdt = mostraImg($product["immagine"]);
    }
    aggiornaProdotto();
}
?>

<div class="container">
    <div>
        <h3 class="page-header">Modifica un prodotto</h3>
    </div>

    <form action="" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label for="nome">Nome </label>
                    <input type="text" name="nome_pdt" class="form-control" value="<?= $nomePdt; ?>">
                </div>
                <div class="form-group">
                    <label for="dettagli">Dettagli</label>
                    <textarea name="dettagli" cols="30" rows="8" class="form-control"
                              id="editor1"><?= $dettagli; ?></textarea>
                    <script> CKEDITOR.replace("editor1"); </script>
                </div>

                <div class="form-group">
                    <label for="info">Info</label>
                    <textarea name="desc_breve" cols="30" rows="3" class="form-control" type="text"
                              id="editor2"><?= $infoBreve; ?></textarea>
                    <script> CKEDITOR.replace("editor2"); </script>
                </div>
            </div>

            <div class="col-md-4">

                <div class="form-group">
                    <label for="prezzo">Prezzo</label>
                    <input type="number" name="prezzo" class="form-control" step=".01" min="0" value="<?= $prezzo; ?>">
                </div>
                <div class="form-group">
                    <label for="categoria">Categoria</label>
                    <select name="categoria_pdt" class="form-control">
                        <option value="<?= $catPdt; ?>"><?php echo titoloCat($catPdt); ?></option>
                        <?php mostra_cat_prodotto(); ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="quantita">Quantità</label>
                    <input type="number" name="quantita_pdt" class="form-control" min="0" value="<?= $quantitaPdt; ?>">
                </div>

                <div class="form-group">
                    <label for="immagine">Immagine</label>
                    <input type="file" name="immagine">
                    <img width="100" src="../../risorse/<?= $immaginePdt; ?> " alt="">
                </div>

                <div class="form-group">
                    <input type="submit" name="aggiorna" class="btn btn-success btn-lg" value="Aggiorna">
                </div>

            </div>
        </div>
    </form>

</div>