<br>

<head>Gestión de Tipos de Intérprete</head>

<br><br>

<a href='<?=base_url(); ?>index.php/Controlador_principal/formularioNuevoTipoInterprete'>Añadir tipo de intérprete</a>

<br><br>

<?php 

foreach($listaTiposInterprete as $tipoInterprete)
{ ?>
	<?=$tipoInterprete->id_tipo_interprete;  ?>
	<?=$tipoInterprete->nombre_tipo_interprete;  ?><br>
	<a href='<?=base_url(); ?>index.php/Controlador_principal/formularioModificarTipoInterprete/<?=$tipoInterprete->id_tipo_interprete;?>'>Modificar</a>
	<a href='<?=base_url(); ?>index.php/Controlador_principal/eliminarTipoInterprete/<?=$tipoInterprete->id_tipo_interprete;?>'>Eliminar</a>	
	<br><br>
<?php
}
?>

