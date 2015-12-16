<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="panel-title" align="center" >Login</h1>
                </div>

                <div class="panel-body">
                    <form action='<?= base_url(); ?>index.php/Controlador_principal/logear' method='post' role="form">

                        <div class="form-group <?php if(validation_errors()) echo 'has-error has-feedback'; ?>">
                            <label class="control-label" for='nomUsu' >Usuario: </label>
                            <input class="form-control" type='text' name='nomUsu' id='nomUsu' value="<?= set_value('nomUsu'); ?>" />
                            <?php if(validation_errors()) echo '<span class="glyphicon glyphicon-remove form-control-feedback"></span>'; ?>
                            <?=form_error('nomUsu')?>
                        </div>

                        <div class="form-group <?php if(validation_errors()) echo 'has-error has-feedback'; ?>">
                            <label class="control-label" for='passUsu' >Contraseña: </label>
                            <input class="form-control" type='password' name='passUsu' id='passUsu' />
                            <?php if(validation_errors()) echo '<span class="glyphicon glyphicon-remove form-control-feedback"></span>'; ?>
                            <?=form_error('passUsu')?>
                        </div>

                        <input class="btn btn-rosado btn-block" type='submit' value='Login' ><br><br>
                    </form>

                    <div>
                        <a href="<?=base_url(); ?>index.php/Controlador_principal/formularioRegistro">Regístrate aquí</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>