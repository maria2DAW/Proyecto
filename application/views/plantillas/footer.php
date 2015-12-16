<script type="text/javascript" >

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

<footer>
	<p>María Rengel Casimiro - Proyecto de Desarrollo de Aplicaciones Web.</p>	
</footer>

</html>