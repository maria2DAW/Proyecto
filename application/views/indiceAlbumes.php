<br>

<head>Lista de Álbumes</head>

<br><br>

<?php 

foreach($listaAlbumes as $album)
{ ?>
	<ul>
		<li><a href='#'><?=$album->nombre_album;?></a></li>
	</ul>
	
<?php
}
?>

<br><br>