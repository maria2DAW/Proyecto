<div class="container">
    <div class="row">
        <h4 align="center"><?=$letra;?></h4>

        <br>

        <span>Letras de canciones por esta letra: <?=$numCancionesPorLetra;?></span>

        <br><br><br>

        <div class="row">
            <ul class="list-group" style="text-align: left;">

                <?php

                foreach($listaCancionesPorLetra as $cancionPorLetra)
                { ?>

                    <li class="list-group-item" >
                        <span class="glyphicon glyphicon-music"></span>
                        <a href='<?=base_url(); ?>index.php/Controlador_principal/mostrar_letra/<?=$cancionPorLetra->id_cancion;?>'>
                        <?=$cancionPorLetra->nombre_cancion ?>
                        </a><br>
                        <small style="font-style: oblique;" ><?=$cancionPorLetra->nombre_album ?></small><br>
                        <small style="font-weight: bold;" ><?=$cancionPorLetra->nombre_interprete ?></small>
                    </li>

                <?php
                }
                ?>

            </ul>
        </div>
    </div>
</div>