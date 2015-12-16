<div class="container">
    <div class="row centered">
        <div class="col-md-8 col-md-offset-2">
            <h2 align="center">Nueva Letra</h2>
            <div id="formNuevaLetra" class="center-block">

            <br>

            <span class="help-block"><span class="glyphicon glyphicon-info-sign" style="color: #0080FF;" ></span> Campos obligatorios (*)</span>

            <br>

            <form action='<?= base_url(); ?>index.php/Controlador_principal/guardar_datos_letra' method='post' role="form">
            <div class="form-group">
                <label class="control-label" for='intCan' >* Intérprete: </label>
                <input class="form-control" type='text' name='intCan' id='intCan' value='<?= set_value('intCan');?>' />
                <?=form_error('intCan'); ?>
            </div><br>

            <div class="form-group">
                <label class="control-label" for='albCan' >* Álbum: </label>
                <input class="form-control" type='text' name='albCan' id='albCan' value='<?= set_value('albCan');?>' />
                <?=form_error('albCan'); ?>
            </div><br>

            <div class="form-group" id="grupoTitCan">
                <label class="control-label" for='titCan' >* Título de la canción: </label>
                <input class="form-control" type='text' name='titCan' id='titCan' value='<?= set_value('titCan');?>' />
                <?=form_error('titCan'); ?>
            </div>

                <button style="display: none;"  type="button" id="bAddInfoCancion" class="btn btn-primary btn-xs pull-left">
                    <span class="glyphicon glyphicon-plus"></span> Añadir más información sobre ésta canción
                </button>
                <br><br>

            <div class="form-group">
                <label class="control-label" for='wysihtml5-textarea' >* Letra de la canción: </label><br><br>
                <textarea class="form-control" id="wysihtml5-textarea" name="wysihtml5-textarea" placeholder="Introduzca texto ..." value='<?= set_value('wysihtml5-textarea');?>'></textarea>
                <?=form_error('wysihtml5-textarea'); ?>
            </div><br>

            <input type="hidden" name="letraCancion" id="letraCancion" value="">

            <input class="btn btn-rosado btn-block" type='submit' value='Enviar Letra' />
            </form>
            </div>
        </div>
    </div>
</div>


    <br><br>