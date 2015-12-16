<div class="container vistaInfo">
    <div class="row">
        <h4 class="pull-right" align="center" >
            <a onclick="listaAlbumesInterprete(<?=$infoInterpretes->id_interprete;?>);" >ÁLBUMES PUBLICADOS</a>
        </h4>

        <div class="col-md-3">
            <img class="img-responsive" src="<?=base_url(); ?>assets/img/interpretes/<?= $infoInterpretes->imagen_interprete; ?>"><br>
            <h4 style="font-weight: bold; text-transform: uppercase;"><?= $infoInterpretes->nombre_interprete; ?></h4>
            <h4><?= $tipoInterprete; ?></h4>
        </div>

        <div id="divListaAlbumesInterprete" class="col-md-5 col-md-offset-4">
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
                                foreach($listaGenerosInterprete as $generoInt)
                                {
                                    echo $generoInt->nombre_genero.', ';
                                }

                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td><strong>Origen</strong></td>
                        <td><?= $infoInterpretes->origen_interprete; ?></td>
                    </tr>

                    <tr>
                        <td><strong>Biografía</strong></td>
                        <td><?= $infoInterpretes->biografia_interprete; ?></td>
                    </tr>

                    <tr>
                        <td><strong>Publicado por</strong></td>
                        <td><?= $usuarioInterprete; ?></td>
                    </tr>

                    <tr>
                        <td><strong>Fecha de publicación</strong></td>
                        <td>
                            <?php
                                $date = date_create($infoInterpretes->publicacion_interprete);
                                echo date_format($date, 'd-m-y');
                            ?>

                        </td>
                    </tr>

                </tbody>
            </table>

        </div>

    </div>


</div>