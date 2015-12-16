<br>

<head>Login</head>

<br><br>

<form action='<?= base_url(); ?>index.php/Controlador_principal/logear' method='post'>
	<label for='nomUsu' >Usuario: </label>
	<input type='text' name='nomUsu' id='nomUsu' value="<?= set_value('nomUsu'); ?>" /><br><br>
	
	<label for='passUsu' >Contraseña: </label>
	<input type='password' name='passUsu' id='passUsu' /><br><br>
	
	<input type='submit' value='Login' ><br><br>
	
</form>

<div>
        <?php echo validation_errors(); ?>
</div>