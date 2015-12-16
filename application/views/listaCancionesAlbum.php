<div class="well well-lg" >

    <p>Número de canciones publicadas: <?=$numCancionesAlb; ?></p>

    <ul>

    <?php

    foreach($listaCancionesAlb as $cancionesAlb)
    { ?>

        <li>
            <strong><a href='<?=base_url(); ?>index.php/Controlador_principal/mostrar_letra/<?=$cancionesAlb->id_cancion;?>' ><?=$cancionesAlb->nombre_cancion; ?></a></strong><br>
            <?= $cancionesAlb->nombre_album; ?>
        </li>

    <?php
    }
    ?>

    </ul>

</div>