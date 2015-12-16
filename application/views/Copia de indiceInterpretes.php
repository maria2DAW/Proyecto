<br>

<head>Índice de intérpretes</head>

<br><br>

<a href='<?=base_url(); ?>index.php/Controlador_principal/interpretes_por_indice_simbolo'>#</a><?=" | ";?>

<?php 

foreach(range('A', 'Z') as $letter)
{ ?>
	<a href='<?=base_url(); ?>index.php/Controlador_principal/interpretes_por_indice_letra/<?=$letter;?>'>
	<?=$letter;?>
	</a><?=" | ";?>
	
<?php
}
?>

<a href='<?=base_url(); ?>index.php/Controlador_principal/interpretes_por_indice_numero'>0-9</a><?=" | ";?>

<br><br>

<div id="cargaListaInterpretes">
	
</div>