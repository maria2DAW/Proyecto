<div class="container">
    <div class="row">
        <h4 align="center">#</h4>

        <br>

        <span>Letras de canciones que empiezan por otros caracteres: <?=$numCancionesPorSimbolo;?></span>

        <br><br><br>

        <div class="row">
            <ul class="list-group" style="text-align: left;">

                <?php

                foreach($listaLetrasPorSimbolo as $cancionPorSimbolo)
                { ?>

                    <li class="list-group-item" >
                        <span class="glyphicon glyphicon-music"></span>
                        <a href='<?=base_url(); ?>index.php/Controlador_principal/mostrar_letra/<?=$cancionPorSimbolo->id_cancion;?>'>
                        <?=$cancionPorSimbolo->nombre_cancion ?>
                        </a><br>
                        <small style="font-style: oblique;" ><?=$cancionPorSimbolo->nombre_album ?></small><br>
                        <small style="font-weight: bold;" ><?=$cancionPorSimbolo->nombre_interprete ?></small>
                    </li>

                    <?php
                }
                ?>

            </ul>
        </div>
    </div>
</div>