<div class="container">
	<div class="row centered">
		<div class="col-md-4 col-md-offset-4">
			<h3 align="center">Nuevo Álbum</h3>
			
			<br>

            <span class="help-block"><span class="glyphicon glyphicon-info-sign" style="color: #0080FF;" ></span> Campos obligatorios (*)</span>

            <br>

			<form action='<?= base_url(); ?>index.php/Controlador_principal/guardar_datos_album' method='post' enctype="multipart/form-data" role="form">
				<div class="form-group">
					<label class="control-label" for='nomAlb' >* Nombre del álbum: </label>
					<input class="form-control" type='text' name='nomAlb' id='nomAlb' />
					<?=form_error('nomAlb'); ?>
				</div>
				
				<div class="form-group">
					<label class="control-label" for='intAlb' >* Intérprete del álbum: </label>
					<input class="form-control" type='text' name='intAlb' id='intAlb' />
					<?=form_error('intAlb'); ?>
				</div>
				
				<div class="form-group">
                    <label class="control-label" for='genAlb' >Género/s del álbum: </label>
                    <select class="selectGeneros" name="genAlb[]" id="genAlb" multiple="multiple">

                        <?php

                        foreach($listaGeneros as $genero)
                        {
                            echo "<option value='".$genero->id_genero."' ";
                            echo set_select('genInt', $genero->id_genero);
                            echo ">".$genero->nombre_genero."</option>";
                        }

                        ?>

                    </select>
                </div>
				
				<div class="form-group">
					<label class="control-label" for='numPis' >Número de pistas: </label>
					<input class="form-control" type='text' name='numPis' id='numPis' />
					<?=form_error('numPis'); ?>
				</div>
				
				<div class="form-group">
					<label class="control-label" for='anLan' >Año de lanzamiento: </label>
					<input class="form-control" type='text' name='anLan' id='anLan' />
					<?=form_error('anLan'); ?>
				</div>
				
				<div class="form-group">
					<label class="control-label" for='infAlb' >Información del álbum: </label><br>
					<textarea class="form-control" rows="6" name="infAlb" id="infAlb"></textarea>
					<?=form_error('infAlb'); ?>
				</div>
				
				<div class="form-group">
					<label class="control-label" for='imgAlb' >Imagen del álbum: </label>
					<input type='file' name='imgAlb' id='imgAlb' /><br>
				</div>
				
				<input class="btn btn-rosado btn-block" type='submit' value='Enviar Datos' ><br><br>
				
			</form>
		</div>
	</div>
</div>