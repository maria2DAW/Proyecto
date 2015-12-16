<br>

<head>Gestión de Usuarios</head>

<br><br>

<a href='<?=base_url(); ?>index.php/Controlador_principal/formularioRegistro'>Añadir Usuario</a>

<br><br>

<?php 

foreach($listaUsuarios as $usuario)
{ ?>
	<?=$usuario->id_usuario;  ?>
	<?=$usuario->nombre_registro_usuario;  ?>
	<?=$usuario->email_usuario;  ?>
	<?=$usuario->nombre_usuario;  ?>
	<?=$usuario->apellidos_usuario;  ?>
	<?=$usuario->pais_usuario;  ?>
	<?=$usuario->registro_usuario;  ?>
	<?=$usuario->baja;  ?><br>
	<a href='<?=base_url(); ?>index.php/Controlador_principal/formularioModificarUsuario/<?=$usuario->id_usuario;?>'>Modificar</a>
	<a href='<?=base_url(); ?>index.php/Controlador_principal/dar_de_baja_usuario/<?=$usuario->id_usuario;?>'>Dar de baja</a>	
	<br><br>
<?php
}
?>

