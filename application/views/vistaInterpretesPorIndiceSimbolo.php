<br>

<head>Intérpretes que empiezan por ...</head>

<br><br>

<?php 

foreach($listaInterpretesPorSimbolo as $interpretePorSimbolo)
{ ?>
	<ul>
		<li><?=$interpretePorSimbolo->nombre_interprete;?></li>
	</ul>
	
<?php
}
?>

<br><br>