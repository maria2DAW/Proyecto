<div class="container">
    <div class="row">
        <h4 align="center">Letras sin categoría</h4>

        <div class="row">

            <p>Número de letras en esta categoría: <?= $numResultados?></p>

            <ul class="list-group" style="text-align: left; list-style: none;">

                <?php

                foreach($LetrasSinGenero as $letraSinGenero)
                { ?>
                    <li class="list-group-item" >
                        <span class="glyphicon glyphicon-music"></span>
                        <a href='<?=base_url(); ?>index.php/Controlador_principal/mostrar_letra/<?=$letraSinGenero->id_cancion;?>'>
                        <?=$letraSinGenero->nombre_cancion ?>
                        </a>
                    </li>
                    <?php
                }
                ?>

            </ul>
        </div>

    </div>
</div>