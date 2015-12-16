<br>

<head>Intérpretes que empiezan por <?=$letra;?></head>

<br><br>

<?=count($listaInterpretesPorLetra);?>

<?php 

foreach($listaInterpretesPorLetra as $interpretePorLetra)
{ ?>
	<ul>
		<li><?=$interpretePorLetra->nombre_interprete;?></li>
	</ul>
	
<?php
}
?>

<br><br>