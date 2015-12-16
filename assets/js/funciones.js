/*********************************************************************
AJAX
**********************************************************************/
/*var conexionAjax;

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
	alert()
  conexionAjax=crearXMLHttpRequest();
  conexionAjax.onreadystatechange = salidaLetra;
  var url = '<?=base_url(); ?>index.php/Controlador_principal/interpretes_por_indice_letra/' + letra;
  conexionAjax.open("GET", url, true);
  conexionAjax.send(null);
}

function salidaLetra()
{
  var divListaInterpretes = document.getElementById("cargaListaInterpretes");
  
  if(conexionAjax.readyState == 4)
  {
	divListaInterpretes.innerHTML = conexionAjax.responseText;
  }
}

/*********************************************************************
FIN AJAX
**********************************************************************/

$(document).ready(function () {
    $.each($('#navbar').find('li'), function() {
        $(this).toggleClass('active',
            $(this).find('a').attr('href') == window.location.pathname);
    });

    $('.textarea').wysihtml5({
        "font-styles": true, //Font styling, e.g. h1, h2, etc. Default true
        "emphasis": true, //Italics, bold, etc. Default true
        "lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
        "html": true, //Button which allows you to edit the generated HTML. Default false
        "link": true, //Button to insert a link. Default true
        "image": true, //Button to insert an image. Default true,
        "color": true //Button to change color of font
    });
});




    