<div class="container">
    <div class="row">
        <div class="col-md-2 pull-right">
            <a class="btn btn-rosado btn-block" href='<?=base_url(); ?>index.php/Controlador_principal/cerrarSesion'>
                Cerrar sesión
                <span class="glyphicon glyphicon-remove pull-right"></span>
            </a>
        </div>
    </div>
    <div class="row centered">

        <h3 align="center">Perfil de <?=$usuarioConectado->nombre_registro_usuario?></h3>

        <br>

        <div class="col-md-4">
            <div class="panel panel-warning">
                <div class="panel-body">
                    <span class="glyphicon glyphicon-list-alt"></span>
                </div>
                <div class="panel-footer"><a onclick="datosUsuario();">Mis datos</a></div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel panel-warning">
                <div class="panel-body">
                    <span class="glyphicon glyphicon-headphones"></span>
                </div>
                <div class="panel-footer"><a onclick="vistaPublicacionesUsuario();">Publicaciones</a></div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel panel-warning">
                <div class="panel-body">
                    <span class="glyphicon glyphicon-plus"></span>
                </div>
                <div class="panel-footer"><a onclick="vistaAnyadirPublicacionesUsuario();">Añadir</a></div>
            </div>
        </div>
    </div>

    <div id="contenidoPerfilUsuario">

    </div>

</div>