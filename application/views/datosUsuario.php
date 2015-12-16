<div class="panel panel-default">

    <div class="row centered">
        <a href='<?=base_url(); ?>index.php/Controlador_principal/formularioCambiarPass' class="btn btn-info btn-sm" >Cambiar contraseña</a>
    </div>

    <p>Nick: <?=$usuarioConectado->nombre_registro_usuario?></p>
    <p>E-mail: <?=$usuarioConectado->email_usuario?></p>
    <p>Nombre: <?=$usuarioConectado->nombre_usuario?></p>
    <p>Apellidos: <?=$usuarioConectado->apellidos_usuario?></p>
    <p>País: <?=$paisUsuario->nombre_pais?>, <?=$paisUsuario->continente_pais?></p>
    <p>Fecha de registro: <?php $date = date_create($usuarioConectado->registro_usuario);
        echo date_format($date, 'd-m-y H:i');?></p>

    <div class="row centered">
        <a href='<?=base_url(); ?>index.php/Controlador_principal/formularioModificarUsuario/<?=$usuarioConectado->id_usuario?>' class="btn btn-warning btn-sm" >Modificar datos</a>
    </div>

</div>