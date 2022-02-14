<div class="row">
    <div class="col-md-12">
        <h1 class="display-5"> Gestisci le categorie</h1>
        <h4 class="bg-success"><?php mostraAvviso(); ?></h4>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Azione possibile</th>
            </tr>
            </thead>
            <tbody>

            <?php categorie_admin(); ?>
            </tbody>
        </table>
    </div>


</div>