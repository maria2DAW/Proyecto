<br>

<head>Nuevo Intérprete</head>

<br><br>

<form action='<?= base_url(); ?>index.php/Controlador_principal/guardar_datos_interprete' method='post' enctype="multipart/form-data">
	<label for='nomInt' >Nombre del intérprete: </label>
	<input type='text' name='nomInt' id='nomInt' /><br><br>
	
	<label for='tipoInt' >Tipo de intérprete: </label>
	<select name="tipoInt" id="tipoInt">
		<!--<option>Cantante</option>
		<option>Banda</option>-->
		
		<?php
		
		foreach($listaTiposInterprete as $tipoInterprete)
		{
			echo "<option value='".$tipoInterprete->id_tipo_interprete."'>".$tipoInterprete->nombre_tipo_interprete."</option>";
		}
		
		?>
				
	</select><br><br>
	
	<label for='orgInt' >Origen del intérprete: </label>
	<input type='text' name='orgInt' id='orgInt' /><br><br>
	
	<label for='bioInt' >Biografía del interprete: </label><br>
	<textarea name="bioInt" id="bioInt"></textarea><br><br>
	
	<label for='imgInt' >Imagen del intérprete: </label>
	<input type='file' name='imgInt' id='imgInt' /><br><br>
	
	<input type='submit' value='Enviar Datos' ><br><br>
	
</form>