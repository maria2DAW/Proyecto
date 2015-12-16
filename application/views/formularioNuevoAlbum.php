<br>

<head>Nuevo Álbum</head>

<br><br>

<form action='<?= base_url(); ?>index.php/Controlador_principal/guardar_datos_album' method='post' enctype="multipart/form-data">
	<label for='nomAlb' >Nombre del álbum: </label>
	<input type='text' name='nomAlb' id='nomAlb' /><br><br>
	
	<label for='intAlb' >Intérprete del álbum: </label>
	<input type='text' name='intAlb' id='intAlb' /><br><br>
	
	<label for='genAlb' >Género del álbum: </label>
	<input type='text' name='genAlb' id='genAlb' /><br><br>
	
	<label for='numPis' >Número de pistas: </label>
	<input type='text' name='numPis' id='numPis' /><br><br>
	
	<label for='anLan' >Año de lanzamiento: </label>
	<input type='text' name='anLan' id='anLan' /><br><br>
	
	<label for='infAlb' >Información del álbum: </label><br>
	<textarea name="infAlb" id="infAlb"></textarea><br><br>
	
	<label for='imgAlb' >Imagen del álbum: </label>
	<input type='file' name='imgAlb' id='imgAlb' /><br><br>
	
	<input type='submit' value='Enviar Datos' ><br><br>
	
</form>