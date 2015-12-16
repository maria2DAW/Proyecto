<br>

<head>Nuevo Intérprete</head>

<br><br>

<form action='<?= base_url(); ?>index.php/Controlador_principal/guardar_datos_interprete' method='post' enctype="multipart/form-data">
	<label for='nomInt' >Nombre del intérprete: </label>
	<input type='text' name='nomInt' id='nomInt' value='<?= set_value('nomInt');?>' /><br><br>
	<?=form_error('nomInt'); ?><br>
	
	<label for='tipoInt' >Tipo de intérprete: </label>
	<select name="tipoInt" id="tipoInt">
		
		<?php
		
		foreach($listaTiposInterprete as $tipoInterprete)
		{
			echo "<option value='".$tipoInterprete->id_tipo_interprete."' ";
            echo set_select('tipoInt', $tipoInterprete->id_tipo_interprete);
            echo ">".$tipoInterprete->nombre_tipo_interprete."</option>";
		}
		
		?>
				
	</select><br><br>
	
	<label>Género/s del intérprete: </label><br><br>

    <div class="listaGenerosInt">
	<?php
		
		foreach($listaGeneros as $genero)
		{
			//usar <label><input type="checkbox" />etiqueta</label> para asociar la etiqueta adjunta, así el check se marca al hacer click en la etiqueta
			echo "<label><input name='genInt[]' id='genInt' type='checkbox' value='".$genero->id_genero."' ";
            echo set_checkbox('genInt', $genero->id_genero);
            echo ">".$genero->nombre_genero."</label><br>";
		}
		
	?>
    </div>
	
	<br><br>
	
	<label for='orgInt' >Origen del intérprete: </label>
	<input type='text' name='orgInt' id='orgInt' value='<?= set_value('orgInt');?>' /><br><br>
	<?=form_error('orgInt'); ?><br><br>
	
	<label for='bioInt' >Biografía del interprete: </label><br>
	<textarea name="bioInt" id="bioInt" value='<?= set_value('bioInt');?>' ></textarea><br><br>
	<?=form_error('bioInt'); ?><br><br>
	
	<label for='imgInt' >Imagen del intérprete: </label>
	<input type='file' name='imgInt' id='imgInt' /><br><br>
	
	<input type='submit' value='Enviar Datos' ><br><br>
	
</form>