<br>

<head>Modificar Género</head>

<br><br>

<form action='<?= base_url(); ?>index.php/Controlador_principal/modificar_datos_genero' method='post'>
	<label for='nomGen' >Nombre del Género: </label>
	<input type='text' name='nomGen' id='nomGen' value="<?= set_value('nomGen', $generoObtenido->nombre_genero); ?>" />
	<input type='hidden' name='idGen' id='idGen' value="<?=$generoObtenido->id_genero; ?>" /><br><br>
	<?= form_error('nomGen'); ?><br>
	
	<input type='submit' value='Enviar Datos' ><br><br>
	
</form>

<br><br>