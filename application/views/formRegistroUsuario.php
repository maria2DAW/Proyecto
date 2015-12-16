<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <h3>Registro de usuario</h3>

            <br><br>

            <form action='<?= base_url(); ?>index.php/Controlador_principal/guardar_datos_usuario' method='post' role="form">

                <fieldset>
                    <legend>Datos de la cuenta</legend>
                    <div class="form-group <?php if(validation_errors()) echo 'has-error has-feedback'; ?>">
                        <label class="control-label" for='nombreUsuario' >Nombre de usuario: </label>
                        <input class="form-control" type='text' name='nombreUsuario' id='nombreUsuario' value="<?= set_value('nombreUsuario'); ?>" />
                        <?=form_error('nombreUsuario'); ?>
                    </div>

                    <div class="form-group <?php if(validation_errors()) echo 'has-error has-feedback'; ?>">
                        <label class="control-label" for='passUsuario' >Contraseña: </label>
                        <input class="form-control" type='password' name='passUsuario' id='passUsuario' maxlength='12' />
                        <?=form_error('passUsuario'); ?>
                    </div>

                    <div class="form-group <?php if(validation_errors()) echo 'has-error has-feedback'; ?>">
                        <label class="control-label" for='pass2Usuario' >Repita la contraseña: </label>
                        <input class="form-control" type='password' name='pass2Usuario' id='pass2Usuario' maxlength='12' />
                        <?=form_error('pass2Usuario'); ?>
                    </div>
                </fieldset>

                <fieldset>
                    <legend>Datos personales</legend>
                    <div class="form-group <?php if(validation_errors()) echo 'has-error has-feedback'; ?>">
                        <label class="control-label" for='nombre' >Nombre: </label>
                        <input class="form-control" type='text' name='nombre' id='nombre' value="<?= set_value('nombre'); ?>">
                        <?=form_error('nombre'); ?>
                    </div>

                    <div class="form-group <?php if(validation_errors()) echo 'has-error has-feedback'; ?>">
                        <label class="control-label" for='apellidos' >Apellidos: </label>
                        <input class="form-control" type='text' name='apellidos' id='apellidos' value="<?= set_value('apellidos'); ?>">
                        <?=form_error('apellidos'); ?>
                    </div>

                    <div class="form-group <?php if(validation_errors()) echo 'has-error has-feedback'; ?>">
                        <label class="control-label" for='email' >E-mail: </label>
                        <input class="form-control" type='text' name='email' id='email' value="<?= set_value('email'); ?>">
                        <?=form_error('email'); ?>
                    </div>

                    <div class="form-group">
                    <label class="control-label" for='pais' >País: </label>
                    <select class="form-control" name="pais" id="pais">

                        <?php

                        for($i = 0; $i < count($listaContinentes); $i++)
                        {
                            echo "<optgroup label='".$listaContinentes[$i]."'>";

                            for($j = 0; $j < count($listaPaisesContinente[$i]); $j++)
                            {
                                echo "<option value='".$listaPaisesContinente[$i][$j]["id_pais"]."' ";
                                echo set_select('pais', $listaPaisesContinente[$i][$j]["id_pais"]);
                                echo ">".$listaPaisesContinente[$i][$j]["nombre_pais"]."</option>";
                            }

                            echo "</optgroup>";
                        }

                        ?>

                    </select>
                </fieldset>

                <br><br>
                <input class="btn btn-rosado btn-block" type='submit' value='Registrarse' ><br><br>

            </form>
        </div>
    </div>
</div>
