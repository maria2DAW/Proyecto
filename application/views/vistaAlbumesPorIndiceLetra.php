<div class="container">
    <div class="row">
        <h4 align="center"><?=$letra;?></h4>

        <br>

        <span>Álbumes por esta letra: <?=$numAlbumesPorLetra;?></span>

        <br><br><br>

        <div class="row">
            <ul class="list-group" style="text-align: left;">

                <?php

                foreach($listaAlbumesPorLetra as $albumPorLetra)
                { ?>

                    <li class="list-group-item" >
                        <span class="glyphicon glyphicon-music"></span>
                        <a href='<?=base_url(); ?>index.php/Controlador_principal/vista_info_albumes/<?=$albumPorLetra->id_album;?>'>
                        <?=$albumPorLetra->nombre_album ?>
                        </a><br>
                        <small style="font-style: oblique;" ><?=$albumPorLetra->nombre_interprete ?></small>
                    </li>

                <?php
                }
                ?>

            </ul>
        </div>
    </div>
</div>