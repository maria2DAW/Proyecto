<div class="container">
    <div class="row centered">
        <div class="col-md-4 col-md-offset-4">
            <h3 align="center">Nuevo Intérprete</h3>

            <br>

            <span class="help-block"><span class="glyphicon glyphicon-info-sign" style="color: #0080FF;" ></span> Campos obligatorios (*)</span>

            <br>

            <form action='<?= base_url(); ?>index.php/Controlador_principal/guardar_datos_interprete' method='post' enctype="multipart/form-data" role="form">
                <div class="form-group">
                    <label class="control-label" for='nomInt' >* Nombre del intérprete:</label>
                    <input class="form-control" type='text' name='nomInt' id='nomInt' value='<?= set_value('nomInt');?>' />
                    <?=form_error('nomInt'); ?>
                </div>

                <div class="form-group">
                    <label class="control-label" for='tipoInt' >Tipo de intérprete: </label>
                    <select class="form-control" name="tipoInt" id="tipoInt">

                        <?php

                        foreach($listaTiposInterprete as $tipoInterprete)
                        {
                            echo "<option value='".$tipoInterprete->id_tipo_interprete."' ";
                            echo set_select('tipoInt', $tipoInterprete->id_tipo_interprete);
                            echo ">".$tipoInterprete->nombre_tipo_interprete."</option>";
                        }

                        ?>

                    </select>
                </div>

                <div class="form-group">
                    <label class="control-label" for='genInt' >Género/s del intérprete: </label>
                    <select class="selectGeneros" name="genInt[]" id="genInt" multiple="multiple">

                        <?php

                        foreach($listaGeneros as $genero)
                        {
                            echo "<option value='".$genero->id_genero."' ";
                            echo set_select('genInt', $genero->id_genero);
                            echo ">".$genero->nombre_genero."</option>";
                        }

                        ?>

                    </select>
                </div>

                <!--<label>Género/s del intérprete: </label><br><br>

                <div class="listaGenerosInt">
                <?php

                    foreach($listaGeneros as $genero)
                    {
                        //usar <label><input type="checkbox" />etiqueta</label> para asociar la etiqueta adjunta, así el check se marca al hacer click en la etiqueta
                        echo "<label class='checkbox-inline'><input name='genInt[]' id='genInt' type='checkbox' value='".$genero->id_genero."' ";
                        echo set_checkbox('genInt', $genero->id_genero);
                        echo ">".$genero->nombre_genero."</label>";
                    }

                ?>
                </div>-->

                <input type="hidden" name="generosRecogidos" id="generosRecogidos" value="">

                <br><br>

                <div class="form-group">
                    <label class="control-label" for='orgInt' >Origen del intérprete: </label>
                    <input class="form-control" type='text' name='orgInt' id='orgInt' value='<?= set_value('orgInt');?>' />
                    <?=form_error('orgInt'); ?>
                </div>

                <div class="form-group">
                    <label class="control-label" for='bioInt' >Biografía del interprete: </label><br>
                    <textarea class="form-control" rows="6" name="bioInt" id="bioInt" value='<?= set_value('bioInt');?>' ></textarea>
                    <?=form_error('bioInt'); ?>
                </div>

                <div class="form-group">
                    <label class="control-label" for='imgInt' >Imagen del intérprete: </label>
                    <input type='file' name='imgInt' id='imgInt' />
                </div>

                <br>

                <input class="btn btn-rosado btn-block" type='submit' value='Enviar Datos' onClick="recogerGenerosInterprete();" ><br><br>

            </form>
        </div>
    </div>
</div>