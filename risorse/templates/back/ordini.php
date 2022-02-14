<div class="row">
    <h3 class="mt-5">Tutti gli ordini</h3>
    <h4 class="bg-success"><?php mostraAvviso(); ?></h4>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Id</th>
            <th>Importo</th>
            <th>Numero Ordine</th>
            <th>Status</th>
            <th>Utente</th>
            
        </tr>
        </thead>
        <tbody>
        <?php ordini(); ?>
        </tbody>
    </table>
</div>