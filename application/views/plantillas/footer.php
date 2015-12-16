<!-- wysihtml5 parser rules -->
<!--<script src="<?=base_url(); ?>assets/js/xing-wysihtml5-fb0cfe4/parser_rules/advanced.js"></script>
<!-- Library -->
<!--<script src="<?=base_url(); ?>assets/js/xing-wysihtml5-fb0cfe4/dist/wysihtml5-0.3.0.min.js"></script>-->

<script type="text/javascript" src="<?=base_url(); ?>assets/js/jquery-1.11.3.min.js"></script>

<!--bootstrap.min.js de SPOT Theme -->
<!-- <script type="text/javascript" src="<?=base_url();?>assets/js/bootstrap.min.js"></script>-->
<script type="text/javascript" src="<?=base_url();?>assets/css/bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>

<!-- Archivos js para bootstrap3-wysihtml5 -->
<script src="<?=base_url();?>assets/css/bootstrap3-wysiwyg-master/components/wysihtml-0.4.17/dist/wysihtml5x-toolbar.min.js"></script>
<script src="<?=base_url();?>assets/css/bootstrap3-wysiwyg-master/components/handlebars.runtime.min.js"></script>
<script src="<?=base_url();?>assets/css/bootstrap3-wysiwyg-master/src/generated/templates.js"></script>
<script src="<?=base_url();?>assets/css/bootstrap3-wysiwyg-master/src/bootstrap3-wysihtml5.js"></script>
<script src="<?=base_url();?>assets/css/bootstrap3-wysiwyg-master/src/locales/bootstrap-wysihtml5.es-ES.js"></script>
<script src="<?=base_url();?>assets/css/bootstrap3-wysiwyg-master/src/generated/commands.js"></script>


<script type="text/javascript" src="<?=base_url(); ?>assets/js/funciones.js"></script>


<script>

function recogerLetra()
{
	var contenidoLetra = document.getElementById("wysihtml5-textarea");
	//alert(contenidoLetra.value);
	letraCancion.value = contenidoLetra.value;
	//alert(letraCancion.value);
}

var customTemplates = {
    custombuttons: function(customOptions) {
        var size = (customOptions.options && customOptions.options.size) ? ' btn-'+customOptions.options.size : '';
        return "<li>" +
            "<div class='btn-group'>" +
            "<a class='btn btn-default" + size + "' data-wysihtml5-command='undo' tabindex='-1'><span class='fa fa-arrow-left'></span></a>" +
            "<a class='btn btn-default" + size + "' data-wysihtml5-command='redo' tabindex='-1'><span class='fa fa-arrow-right'></span></a>" +
            "</div>" +
            "</li>"+
            "<li>" +
            "<div class='btn-group'>" +
            "<a class='btn btn-default" + size + "' data-wysihtml5-command='justifyLeft' tabindex='-1'><span class='fa fa-align-left'></span></a>" +
            "<a class='btn btn-default" + size + "' data-wysihtml5-command='justifyCenter' tabindex='-1'><span class='fa fa-align-center'></span>r</a>" +
            "<a class='btn btn-default" + size + "' data-wysihtml5-command='justifyRight' tabindex='-1'><span class='fa fa-align-right'></a>" +
            "</div>" +
            "</li>";
    }
};

$('#wysihtml5-textarea').wysihtml5({
        toolbar: {
            "font-styles": false, //Font styling, e.g. h1, h2, etc. Default true
            "emphasis": {
                'small': false
            }, //Italics, bold, etc. Default true
            "lists": false, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
            "html": true, //Button which allows you to edit the generated HTML. Default false
            "link": false, //Button to insert a link. Default true
            "image": false, //Button to insert an image. Default true,
            "color": true, //Button to change color of font
            "blockquote": false, //Blockquote
            fa: true,
            'custombuttons': true
        },
        locale: 'es-ES',
        "stylesheets": ["<?=base_url(); ?>assets/css/style_wysihtml5.css"],
        customTemplates: customTemplates
    }
);

/*var editor = new wysihtml5.Editor("wysihtml5-textarea", { // id of textarea element
	toolbar:      "wysihtml5-toolbar", // id of toolbar element
	stylesheets:  "<?= base_url(); ?>assets/css/style.css",
	cleanUp: true,
	parserRules:  wysihtml5ParserRules // defined in parser rules set 
});*/

//document.getElementById("cargaListaInterpretes").innerHTML = "eeerrr";

var conexionAjax;

function crearXMLHttpRequest() 
{
  var xmlHttp=null;
  if (window.ActiveXObject) 
    xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
  else 
    if (window.XMLHttpRequest) 
      xmlHttp = new XMLHttpRequest();
  return xmlHttp;
}

function cargarLetra(letra)
{
	//alert("ajax")
  conexionAjax=crearXMLHttpRequest();
  conexionAjax.onreadystatechange = cargarLista;
  var url = '<?=base_url(); ?>index.php/Controlador_principal/interpretes_por_indice_letra/' + letra;
  conexionAjax.open("GET", url, true);
  conexionAjax.send(null);
  
  //Conexión con ajax
	/*$.ajax({
		url: '<?=base_url(); ?>index.php/Controlador_principal/interpretes_por_indice_letra/' + letra;
		type: 'GET', //Lo mandamos por el método GET.
		async: true, //True para permitir el uso de ajax.
		success: cargarLista, //Función a la que se llama cada vez que actúa ajax.
		timeout:4000  // Tiempo máximo de espera para ajax 4 segundos.
		
	}).fail(function()  //Después de 4 segundos ajax dará un error.
	{
		alert( "Error de ajax" );
	});*/
}

function cargarNumeros()
{
  conexionAjax=crearXMLHttpRequest();
  conexionAjax.onreadystatechange = cargarLista;
  var url = '<?=base_url(); ?>index.php/Controlador_principal/interpretes_por_indice_numero';
  conexionAjax.open("GET", url, true);
  conexionAjax.send(null);
}

function cargarSimbolos()
{
  conexionAjax=crearXMLHttpRequest();
  conexionAjax.onreadystatechange = cargarLista;
  var url = '<?=base_url(); ?>index.php/Controlador_principal/interpretes_por_indice_simbolo';
  conexionAjax.open("GET", url, true);
  conexionAjax.send(null);
}

function cargarLista()
{
  var divListaInterpretes = document.getElementById("cargaListaInterpretes");
  
  if(conexionAjax.readyState == 4)
  {
	divListaInterpretes.innerHTML = conexionAjax.responseText;
	
	//$("#divListaInterpretes").html("eeee");
	
  }
}
</script>

</body>

<div class="container">
<footer>
	<p>María Rengel Casimiro - Proyecto de Desarrollo de Aplicaciones Web.</p>	
</footer>
</div>


</html>