<div class="container vistaInfo">
    <div class="row">
        <h4 class="pull-right" align="center" >
            <a onclick="listaCancionesAlbum(<?=$infoAlbumes->id_album;?>);" >CANCIONES PUBLICADAS</a>
        </h4>

        <div class="col-md-3">
            <img class="img-responsive" src="<?=base_url(); ?>assets/img/albumes/<?= $infoAlbumes->imagen_album; ?>"><br>
            <h4 style="font-weight: bold; text-transform: uppercase;"><?= $infoAlbumes->nombre_album; ?></h4>
            <h4><a href="<?= base_url(); ?>index.php/Controlador_principal/vista_info_interpretes/<?=$interpreteAlbum->id_interprete;?>" ><?=$interpreteAlbum->nombre_interprete  ?></a></h4>
        </div>

        <div id="divListaCancionesAlbum" class="col-md-5 col-md-offset-4">
        </div>

    </div>

    <div style="margin-top: 30px;" class="row">
        <div class="col-md-5">
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <td><strong>Género/s</strong></td>
                        <td>
                            <?php
                                foreach($listaGenerosAlbum as $generoAlb)
                                {
                                    echo $generoAlb->nombre_genero.', ';
                                }

                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td><strong>Número de pistas</strong></td>
                        <td><?= $infoAlbumes->numero_pistas; ?></td>
                    </tr>

                    <tr>
                        <td><strong>Año de lanzamiento</strong></td>
                        <td><?= $infoAlbumes->anyo_lanzamiento; ?></td>
                    </tr>

                    <tr>
                        <td><strong>Información del álbum</strong></td>
                        <td><?= $infoAlbumes->informacion_album; ?></td>
                    </tr>

                    <tr>
                        <td><strong>Publicado por</strong></td>
                        <td><?= $usuarioAlbum; ?></td>
                    </tr>

                    <tr>
                        <td><strong>Fecha de publicación</strong></td>
                        <td>
                            <?php
                                $date = date_create($infoAlbumes->publicacion_album);
                                echo date_format($date, 'd-m-y');
                            ?>

                        </td>
                    </tr>

                </tbody>
            </table>

        </div>

    </div>


</div>