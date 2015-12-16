<section id="parrafo" >Editor</section>	<br><br>

<form action='<?= base_url(); ?>index.php/Controlador_principal/guardar_datos_letra' method='post'>
<label for='intCan' >Intérprete: </label>
<input type='text' name='intCan' id='intCan' />

<label for='albCan' >Álbum: </label>
<input type='text' name='albCan' id='albCan' /><br><br>

<label for='titCan' >Título de la canción: </label><br>
<input type='text' name='titCan' id='titCan' /><br><br>

<!--<div id="wysihtml5-toolbar" style="display: none;">
<a data-wysihtml5-command="bold" title="CTRL+B">bold</a> |
<a data-wysihtml5-command="italic" title="CTRL+I">italic</a> |
<div data-wysihtml5-command-group="foreColor" class="fore-color" >
	<a data-wysihtml5-command="foreColor" data-wysihtml5-command-value="red" unselectable="on" >red</a> |
	<a data-wysihtml5-command="foreColor" data-wysihtml5-command-value="green" unselectable="on" >green</a> |
	<a data-wysihtml5-command="foreColor" data-wysihtml5-command-value="blue" unselectable="on" >blue</a> |
	<a data-wysihtml5-command="foreColor" data-wysihtml5-command-value="silver"unselectable="on" >plata</a> |
	<a data-wysihtml5-command="foreColor" data-wysihtml5-command-value="purple"unselectable="on" >morado</a> |
	<a data-wysihtml5-command="foreColor" data-wysihtml5-command-value="maroon" unselectable="on" >marron</a> |
	<a data-wysihtml5-command="foreColor" data-wysihtml5-command-value="lime" unselectable="on" >lima</a> |
	<a data-wysihtml5-command="foreColor" data-wysihtml5-command-value="yellow" unselectable="on" >amarillo</a> |
</div>

<a data-wysihtml5-action="change_view">switch to html view</a>
	
</div>-->
<textarea id="wysihtml5-textarea" name="wysihtml5-textarea" placeholder="Introduzca texto ..." style="width: 500px; height: 200px; font-size: 14px; line-height: 18px;"></textarea><br><br>

<input type="hidden" name="letraCancion" id="letraCancion" value="">

<input type='submit' onClick="recogerLetra();" value='Enviar Letra' />
</form>
<br><br>