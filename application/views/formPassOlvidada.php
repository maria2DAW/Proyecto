<div class="container" xmlns="http://www.w3.org/1999/html">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="panel-title" align="center" >Restaurar Contraseña</h1>
                </div>

                <div class="panel-body">
                    <form action='<?= base_url(); ?>index.php/Controlador_principal/restaurarPass' method='post' role="form">

                        <div class="form-group <?php if(validation_errors()) echo 'has-error has-feedback'; ?>">
                            <label class="control-label" for='emailCuenta' >E-mail: </label>
                            <input class="form-control" type='text' name='emailCuenta' id='emailCuenta' value="<?= set_value('emailCuenta'); ?>" />
                            <?php if(validation_errors()) echo '<span class="glyphicon glyphicon-remove form-control-feedback"></span>'; ?>
                            <?=form_error('emailCuenta')?>
                        </div>

                        <button id="bRestaurarPass" name="bRestaurarPass" class="btn btn-rosado btn-block" type='submit'>Restaurar Contraseña</button>
                    </form>

                    <span class="help-block"><small>Escriba la dirección de e-mail utilizada en el momento de su registro.</small></span>
                    <span class="help-block"><small>Le enviaremos una nueva contraseña a dicha dirección.</small></span>

                </div>
            </div>
        </div>
    </div>
</div>