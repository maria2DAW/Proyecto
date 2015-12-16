<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="panel-title" align="center" >Nueva Contraseña</h1>
                </div>

                <div class="panel-body">
                    <form action='<?= base_url(); ?>index.php/Controlador_principal/guardar_datos_nueva_pass' method='post' role="form">

                        <div class="form-group ">
                            <label class="control-label" for='conActual' >Contraseña actual: </label>
                            <input class="form-control" type='password' name='conActual' id='conActual' />
                            <?=form_error('conActual')?>
                        </div>

                        <div class="form-group ">
                            <label class="control-label" for='conNueva' >Nueva contraseña: </label>
                            <input class="form-control" type='password' name='conNueva' id='conNueva' />
                            <?=form_error('conNueva')?>
                        </div>

                        <div class="form-group ">
                            <label class="control-label" for='conNueva2' >Repita la nueva contraseña: </label>
                            <input class="form-control" type='password' name='conNueva2' id='conNueva2' />
                            <?=form_error('conNueva2')?>
                        </div>

                        <input class="btn btn-rosado btn-block" type='submit' value='Cambiar Contraseña' >
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>