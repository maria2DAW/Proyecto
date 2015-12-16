<div class="container">
    <div class="row">
        <h4 align="center"><?=$letra;?></h4>

        <br>

        <span>Intérpretes por esta letra: <?=$numInterpretesLetra;?></span>

        <br><br><br>

        <div class="row">
            <ul style="text-align: left; list-style: none;">

                <?php

                foreach($listaInterpretesPorLetra as $interpretePorLetra)
                { ?>
                    <li>
                        <div class="thumbnail">
                            <img src="<?=base_url()?>/assets/img/interpretes/<?=$interpretePorLetra->imagen_interprete ?>" class="media-object pull-left" alt="imagen">
                            <div class="caption">
                                <h4><a href="<?= base_url(); ?>index.php/Controlador_principal/vista_info_interpretes/<?=$interpretePorLetra->id_interprete;?>"vvv ><?=$interpretePorLetra->nombre_interprete;?><a></h4>
                            </div>
                        </div>
                    </li>
                    <?php
                }
                ?>

            </ul>
        </div>

        <div class="paginacion">
            <?php echo $paginacion ?>
        </div>
    </div>
</div>