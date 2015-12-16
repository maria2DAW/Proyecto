<br>

<head>Gestión de Intérpretes</head>

<br><br>

<a href='<?=base_url(); ?>index.php/Controlador_principal/formularioNuevoInterprete'>Añadir Intérprete</a>

<br><br>

<?php 

foreach($listaInterpretes as $interprete)
{ ?>
	<?=$interprete->id_interprete;  ?>
	<?=$interprete->nombre_interprete;  ?>
	<?=$interprete->tipo_interprete;  ?>
	<?=$interprete->origen_interprete;  ?>
	<?=$interprete->biografia_interprete;  ?>
	<?=$interprete->imagen_interprete;  ?>
	<?=$interprete->usuario_interprete;  ?>
	<?=$interprete->publicacion_interprete;  ?>
	<?=$interprete->usuario_modificacion_interprete;  ?>
	<?=$interprete->modificacion_interprete;  ?><br>
	<a href='#'>Modificar</a>
	<a href='#'>Eliminar</a>
	<br><br>
<?php
}
?>

