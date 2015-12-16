<br>

<head>Nuevo Tipo de Intérprete</head>

<br><br>

<form action='<?= base_url(); ?>index.php/Controlador_principal/guardar_datos_tipo_interprete' method='post'>
	<label for='nomTipoInt' >Nombre del Tipo de Intérprete: </label>
	<input type='text' name='nomTipoInt' id='nomTipoInt' value="<?= set_value('nomTipoInt'); ?>" /><br><br>
	<!--<?= form_error('nomTipoInt'); ?>-->
	
	<input type='submit' value='Enviar Datos' ><br><br>
	
</form>

<div>
        <?php echo validation_errors(); ?>
</div>

<br><br>