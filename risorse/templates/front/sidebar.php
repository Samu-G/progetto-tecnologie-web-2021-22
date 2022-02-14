<div class="col-lg-3">
    <form method="post" action="ricerca.php">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="ricerca" name="ricerca">
            <span class="input-group-btn">
  <button class="btn btn-primary" type="submit" name="invia_ricerca"><i class="material-icons">search</i></button>
</span>
        </div>
    </form>
    <h1 class="my-5">Categorie</h1>

    <div class="list-group">
        <?php mostraCategorie(); ?>
    </div>

</div>
