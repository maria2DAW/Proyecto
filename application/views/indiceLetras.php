<br>

<head>Lista de letras</head>

<br><br>

<?php 

foreach($listaCanciones as $cancion)
{ ?>
	<ul>
		<li><a href='<?=base_url(); ?>index.php/Controlador_principal/mostrar_letra/<?=$cancion->id_cancion;?>'><?=$cancion->nombre_cancion;?></a></li>
	</ul>
	
<?php
}
?>

<br><br>