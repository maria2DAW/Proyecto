<div class="container">
    <div class="row centered">
        <h3 align="center">CATEGORÍA DE LETRAS </h3>

        <br><br>

        <div class="center-block">
            <ul class="list-inline">

                <li style="width: 200px; height: 200px;">
                    <a href='<?=base_url(); ?>index.php/Controlador_principal/categoriaSinGeneroLetra'>
                        <img class="img-responsive" src="<?=base_url(); ?>/assets/img/folder-piano-by-maria.png" alt=""><br>
                        Letras sin categoría
                    </a>
                </li>

            <?php

            foreach($listaGeneros as $genero)
            { ?>
                <li style="width: 200px; height: 200px;">
                    <a href='<?=base_url(); ?>index.php/Controlador_principal/categoriaSeleccionadaLetra/<?=$genero->id_genero;?>'>
                        <img class="img-responsive" src="<?=base_url(); ?>/assets/img/folder-piano-by-maria.png" alt=""><br>
                        <?=$genero->nombre_genero;?>
                    </a>
                </li>

            <?php
            }
            ?>
            </ul>
        </div>
    </div>
</div>

