<div class="container">
    <div class="row">
        <h4 align="center">Letras de <?=$nombreGenero?></h4>

        <div class="row">

            <p>Número de letras en esta categoría: <?= $numResultados?></p>

            <ul class="list-group" style="text-align: left; list-style: none;">

                <?php

                foreach($LetrasGeneroSeleccionado as $generoSeleccionado)
                { ?>
                    <li class="list-group-item" >
                        <span class="glyphicon glyphicon-music"></span>
                        <a href='<?=base_url(); ?>index.php/Controlador_principal/mostrar_letra/<?=$generoSeleccionado->id_cancion;?>'>
                        <?=$generoSeleccionado->nombre_cancion ?>
                        </a>
                    </li>
                    <?php
                }
                ?>

            </ul>
        </div>

    </div>
</div>