<div class="container">
    <div class="row centered">
        <div class="col-md-8 col-md-offset-2">
            <h3 align="center"><?=$interpreteLetra->nombre_interprete; ?></h3>
            <h4 align="center"><?=$albumLetra->nombre_album; ?></h4><br>

            <h4 align="center"><strong><?=$cancionObtenida->nombre_cancion; ?></strong></h4><br>

            <div>

            <?= $letraObtenida->contenido_letra; ?>

            </div><br><br>

            <h3 align="center">Visitas: <span class="badge"><?=$visitasLetra; ?></span></h3>
        </div>
    </div>
</div>