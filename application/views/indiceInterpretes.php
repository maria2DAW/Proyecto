<br>

<head>Índice de intérpretes</head>

<br><br>

<a onclick="cargarSimbolos()" >#</a><?=" | ";?>

<?php 

foreach(range('A', 'Z') as $letter)
{ ?>
	<a onclick="cargarLetra('<?=$letter;?>')" >
	<?=$letter;?>
	</a><?=" | ";?>
	
<?php
}
?>

<a onclick="cargarNumeros()">0-9</a><?=" | ";?>

<br><br>

<div id="cargaListaInterpretes">
	
</div>