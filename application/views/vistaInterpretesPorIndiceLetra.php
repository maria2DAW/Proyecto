<br>

<head>Intérpretes que empiezan por <?=$letra;?></head>

<br><br>

<?=count($listaInterpretesPorLetra);?>

<?php 

foreach($listaInterpretesPorLetra as $interpretePorLetra)
{ ?>
	<ul>
		<li><a href="<?= base_url(); ?>index.php/Controlador_principal/vista_info_interpretes/<?=$interpretePorLetra->id_interprete;?>" ><?=$interpretePorLetra->nombre_interprete;?><a></li>
	</ul>
	
<?php
}
?>

<br><br>