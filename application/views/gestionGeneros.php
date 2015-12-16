<br>

<head>Gestión de Géneros</head>

<br><br>

<a href='<?=base_url(); ?>index.php/Controlador_principal/formularioNuevoGenero'>Añadir Género</a>

<br><br>

<?php 

foreach($listaGeneros as $genero)
{ ?>
	<?=$genero->id_genero;  ?>
	<?=$genero->nombre_genero;  ?><br>
	<a href='<?=base_url(); ?>index.php/Controlador_principal/formularioModificarGenero/<?=$genero->id_genero;?>'>Modificar</a>
	<a href='<?=base_url(); ?>index.php/Controlador_principal/eliminarGenero/<?=$genero->id_genero;?>'>Eliminar</a>	
	<br><br>
<?php
}
?>

