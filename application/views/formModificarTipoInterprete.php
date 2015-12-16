<br>

<head>Modificar Tipo de Intérprete</head>

<br><br>

<form action='<?= base_url(); ?>index.php/Controlador_principal/modificar_datos_tipo_interprete' method='post'>
	<label for='nomTipoInt' >Nombre del Tipo de Intérprete: </label>
	<input type='text' name='nomTipoInt' id='nomTipoInt' value="<?= set_value('nomTipoInt', $tipoIntObtenido->nombre_tipo_interprete); ?>" />
	<input type='hidden' name='idTipoInt' id='idTipoInt' value="<?=$tipoIntObtenido->id_tipo_interprete; ?>" /><br><br>
	
	<input type='submit' value='Enviar Datos' ><br><br>
	
</form>

<div>
        <?php echo validation_errors(); ?>
</div>

<br><br>