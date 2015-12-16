<div class="well well-lg" >

    <p>Número de álbumes publicados: <?=$numAlbumesInt; ?></p>

    <?php

    foreach($listaAlbumesInt as $albumesInt)
    { ?>
        <div class="media">
            <a class="pull-left" href="<?=base_url(); ?>index.php/Controlador_principal/vista_info_albumes/<?=$albumesInt->id_album;?>">
                <img style="width: 30px;" class="img-responsive media-object" src="<?=base_url(); ?>assets/img/albumes/<?= $albumesInt->imagen_album; ?>">
            </a>
            <div class="media-body">
                <h4 class="media-heading"><strong><?= $albumesInt->nombre_album; ?></strong></h4>
                <?= $albumesInt->nombre_interprete; ?>
            </div>
        </div>

    <?php
    }
    ?>


</div>