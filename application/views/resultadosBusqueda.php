<br><br>

<div class="container">
    <div class="row">
        <h4 align="center">Resultados de la búsqueda</h4>

        <div class="row">

            <p>Número de resultados para esta búsqueda: <?= $numResultados?></p>

            <ul class="list-group" style="text-align: left; list-style: none;">

                <?php

                foreach($resultadoObtenido as $resultado)
                { ?>
                    <li class="list-group-item" >
                        <a href='<?=base_url(); ?>index.php/Controlador_principal/mostrar_letra/<?=$resultado->id_cancion;?>'1>
                            <?=$resultado->nombre_cancion ?>
                        </a><br>
                        <small style="font-style: oblique;" ><?=$resultado->nombre_album ?></small><br>
                        <small style="font-weight: bold;" ><?=$resultado->nombre_interprete ?></small>
                    </li>
                    <?php
                }
                ?>

            </ul>
        </div>

    </div>
</div>