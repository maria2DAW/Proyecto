<div class="container">
    <div class="row">
        <h4 align="center">0-9</h4>

        <br>

        <span>Álbumes que empiezan por números: <?=$numAlbumesPorNumero;?></span>

        <br><br><br>

        <div class="row">
            <ul class="list-group" style="text-align: left;">

                <?php

                foreach($listaAlbumesPorNumero as $albumPorNumero)
                { ?>

                    <li class="list-group-item" >
                        <span class="glyphicon glyphicon-music"></span>
                        <a href='<?=base_url(); ?>index.php/Controlador_principal/vista_info_albumes/<?=$albumPorNumero->id_album;?>'>
                        <?=$albumPorNumero->nombre_album ?>
                        </a><br>
                        <small style="font-style: oblique;" ><?=$albumPorNumero->nombre_interprete ?></small>
                    </li>

                    <?php
                }
                ?>

            </ul>
        </div>
    </div>
</div>