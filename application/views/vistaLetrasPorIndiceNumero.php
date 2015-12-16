<div class="container">
    <div class="row">
        <h4 align="center">0-9</h4>

        <br>

        <span>Letras de canciones que empiezan por números: <?=$numCancionesPorNumero;?></span>

        <br><br><br>

        <div class="row">
            <ul class="list-group" style="text-align: left;">

                <?php

                foreach($listaLetrasPorNumero as $cancionPorNumero)
                { ?>

                    <li class="list-group-item" >
                        <span class="glyphicon glyphicon-music"></span>
                        <a href='<?=base_url(); ?>index.php/Controlador_principal/mostrar_letra/<?=$cancionPorNumero->id_cancion;?>'>
                        <?=$cancionPorNumero->nombre_cancion ?>
                        </a><br>
                        <small style="font-style: oblique;" ><?=$cancionPorNumero->nombre_album ?></small><br>
                        <small style="font-weight: bold;" ><?=$cancionPorNumero->nombre_interprete ?></small>
                    </li>

                    <?php
                }
                ?>

            </ul>
        </div>
    </div>
</div>