<div class="container">
    <div class="row centered">
        <div class="col-md-8 col-md-offset-2">
            <h2 align="center">Nueva Letra</h2>	<br><br>
            <div class="center-block">

            <form action='<?= base_url(); ?>index.php/Controlador_principal/guardar_datos_letra' method='post' role="form">
            <div class="form-group">
                <label class="control-label" for='intCan' >Intérprete: </label>
                <input class="form-control" type='text' name='intCan' id='intCan' />
            </div>

            <div class="form-group">
                <label class="control-label" for='albCan' >Álbum: </label>
                <input class="form-control" type='text' name='albCan' id='albCan' />
            </div>

            <div class="form-group">
                <label class="control-label" for='titCan' >Título de la canción: </label>
                <input class="form-control" type='text' name='titCan' id='titCan' />
            </div>

            <div class="form-group">
                <textarea class="form-control" id="wysihtml5-textarea" name="wysihtml5-textarea" placeholder="Introduzca texto ..."></textarea>
            </div>

            <input type="hidden" name="letraCancion" id="letraCancion" value="">

            <input class="btn btn-rosado btn-block" type='submit' onClick="recogerLetra();" value='Enviar Letra' />
            </form>
            </div>
        </div>
    </div>
</div>


    <br><br>