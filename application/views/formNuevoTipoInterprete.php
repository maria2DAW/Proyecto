<div class="container">
    <div class="row centered">
        <div class="col-md-4 col-md-offset-4">

            <h3 align="center">Nuevo Tipo de Intérprete</h3>

            <br>

            <form action='<?= base_url(); ?>index.php/Controlador_principal/guardar_datos_tipo_interprete' method='post' role="form">

                <div class="form-group">
                    <label class="control-label" for='nomTipoInt' >Nombre del Tipo de Intérprete: </label>
                    <input class="form-control" type='text' name='nomTipoInt' id='nomTipoInt' value="<?= set_value('nomTipoInt'); ?>" /><br>
                    <?= form_error('nomTipoInt'); ?>
                </div>

                <input class="btn btn-rosado btn-block" type='submit' value='Enviar Datos' >

            </form>
        </div>
    </div>
</div>

<br><br>