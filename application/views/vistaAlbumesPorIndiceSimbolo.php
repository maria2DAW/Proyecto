<div class="container">
    <div class="row">
        <h4 align="center">#</h4>

        <br>

        <span>Álbumes que empiezan por otros caracteres: <?=$numAlbumesPorSimbolo;?></span>

        <br><br><br>

        <div class="row">
            <ul class="list-group" style="text-align: left;">

                <?php

                foreach($listaAlbumesPorSimbolo as $albumPorSimbolo)
                { ?>

                    <li class="list-group-item" >
                        <span class="glyphicon glyphicon-music"></span>
                        <a href='<?=base_url(); ?>index.php/Controlador_principal/vista_info_albumes/<?=$albumPorSimbolo->id_album;?>'>
                        <?=$albumPorSimbolo->nombre_album ?>
                        </a><br>
                        <small style="font-style: oblique;" ><?=$albumPorSimbolo->nombre_interprete ?></small>
                    </li>

                    <?php
                }
                ?>

            </ul>
        </div>
    </div>
</div>