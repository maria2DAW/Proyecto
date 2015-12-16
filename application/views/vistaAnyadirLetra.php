<section id="parrafo" >Editor</section>	<br><br>

<form action='<?= base_url(); ?>index.php/Controlador_principal/guardar_datos_letra' method='post'>
<label for='intCan' >Intérprete: </label>
<input type='text' name='intCan' id='intCan' />

<label for='albCan' >Álbum: </label>
<input type='text' name='albCan' id='albCan' /><br><br>

<label for='titCan' >Título de la canción: </label><br>
<input type='text' name='titCan' id='titCan' /><br><br>

<textarea id="wysihtml5-textarea" name="wysihtml5-textarea" placeholder="Introduzca texto ..."></textarea><br><br>

<input type="hidden" name="letraCancion" id="letraCancion" value="">

<input type='submit' onClick="recogerLetra();" value='Enviar Letra' />
</form>
<br><br>