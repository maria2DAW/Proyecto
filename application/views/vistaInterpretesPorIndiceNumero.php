<br>

<head>Intérpretes que empiezan por ...</head>

<br><br>

<?php 

foreach($listaInterpretesPorNumero as $interpretePorNumero)
{ ?>
	<ul>
		<li><?=$interpretePorNumero->nombre_interprete;?></li>
	</ul>
	
<?php
}
?>

<br><br>