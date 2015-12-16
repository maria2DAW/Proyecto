<br>

<head>Modificar Usuario</head>

<br><br>

<form action='<?= base_url(); ?>index.php/Controlador_principal/modificar_datos_usuario' method='post'>
	<label for='nombre' >Nombre del Usuario: </label>
	<input type='text' name='nombre' id='nombre' value="<?= set_value('nombre', $usuarioObtenido->nombre_usuario); ?>" /><br><br>
	<?=form_error('nombre'); ?><br><br>
	
	<label for='apellidos' >Apellidos del Usuario: </label>
	<input type='text' name='apellidos' id='apellidos' value="<?= set_value('apellidos', $usuarioObtenido->apellidos_usuario); ?>" /><br><br>
	<?=form_error('apellidos'); ?><br><br>
	
	<label for='pais' >País: </label>
	<select name="pais" id="pais">
		
		<?php
		
		for($i = 0; $i < count($listaContinentes); $i++)
		{
			echo "<optgroup label='".$listaContinentes[$i]."'>";
			
			for($j = 0; $j < count($listaPaisesContinente[$i]); $j++)
			{
				echo "<option value='".$listaPaisesContinente[$i][$j]["id_pais"]."'";
				
				if($listaPaisesContinente[$i][$j]["id_pais"] == $usuarioObtenido->pais_usuario)
				{
					echo " selected='selected'";
				}
				
				echo ">".$listaPaisesContinente[$i][$j]["nombre_pais"]."</option>";
			}
			
			echo "</optgroup>";
		}
		
		?>
				
	</select><br><br>
	
	<input type='hidden' name='idUsuario' id='idUsuario' value="<?=$usuarioObtenido->id_usuario; ?>" />
	
	<input type='submit' value='Enviar Datos' ><br><br>
	
</form>

<br><br>