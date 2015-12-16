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

/*$(document).ready(function () {
        $('.navbar li').click(function(e) {
        $('.navbar li.active').removeClass('active');
        var $this = $(this);
        if (!$this.hasClass('active')) {
            $this.addClass('active');
        }
        e.preventDefault();
    });     
    });*/
    
    