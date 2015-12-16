<br>

<head>Registro de usuario</head>

<br><br>

<form action='<?= base_url(); ?>index.php/Controlador_principal/guardar_datos_usuario' method='post'>
	<label for='nombreUsuario' >Nombre de usuario: </label>
	<input type='text' name='nombreUsuario' id='nombreUsuario' value="<?= set_value('nombreUsuario'); ?>" /><br><br>
	
	<?=form_error('nombreUsuario'); ?><br><br>
	
	<label for='passUsuario' >Contraseña: </label>
	<input type='password' name='passUsuario' id='passUsuario' maxlength='12' /><br><br>
	
	<?=form_error('passUsuario'); ?><br><br>
	
	<label for='pass2Usuario' >Repita la contraseña: </label>
	<input type='password' name='pass2Usuario' id='pass2Usuario' maxlength='12' /><br><br>
	
	<?=form_error('pass2Usuario'); ?><br><br>
	
	<label for='nombre' >Nombre: </label>
	<input type='text' name='nombre' id='nombre' value="<?= set_value('nombre'); ?>"><br><br>
	
	<?=form_error('nombre'); ?><br><br>
	
	<label for='apellidos' >Apellidos: </label>
	<input type='text' name='apellidos' id='apellidos' value="<?= set_value('apellidos'); ?>"><br><br>
	
	<?=form_error('apellidos'); ?><br><br>
	
	<label for='email' >E-mail: </label>
	<input type='text' name='email' id='email' value="<?= set_value('email'); ?>"><br><br>
	
	<?=form_error('email'); ?><br><br>
	
	<label for='pais' >País: </label>
	<select name="pais" id="pais">
		
		<?php
		
		for($i = 0; $i < count($listaContinentes); $i++)
		{
			echo "<optgroup label='".$listaContinentes[$i]."'>";
			
			for($j = 0; $j < count($listaPaisesContinente[$i]); $j++)
			{
				echo "<option value='".$listaPaisesContinente[$i][$j]["id_pais"]."' ";
                echo set_select('pais', $listaPaisesContinente[$i][$j]["id_pais"]);
                echo ">".$listaPaisesContinente[$i][$j]["nombre_pais"]."</option>";
			}
			
			echo "</optgroup>";
		}
		
		?>
				
	</select><br><br>
	
	<input type='submit' value='Registrarse' ><br><br>
	
</form>