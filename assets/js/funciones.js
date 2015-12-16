/*********************************************************************
AJAX
**********************************************************************/

var xhr = ""; //variable para ajax

function cargarLetra(letra)
{
    //Conexión con ajax
    xhr = $.ajax({
        url: baseUrl + 'index.php/Controlador_principal/interpretes_por_indice_letra/' + letra,
        type: 'GET', //Lo mandamos por el método GET.
        async: true, //True para permitir el uso de ajax.
        success: cargarLista, //Función a la que se llama cada vez que actúa ajax.
        timeout:4000  // Tiempo máximo de espera para ajax 4 segundos.

    }).fail(function()  //Después de 4 segundos ajax dará un error.
        {
            alert( "Tiempo de espera excedido" );
        });
}

function cargarNumeros()
{
    xhr = $.ajax({
        url: baseUrl + 'index.php/Controlador_principal/interpretes_por_indice_numero',
        type: 'GET', //Lo mandamos por el método GET.
        async: true, //True para permitir el uso de ajax.
        success: cargarLista, //Función a la que se llama cada vez que actúa ajax.
        timeout:4000  // Tiempo máximo de espera para ajax 4 segundos.

    }).fail(function()  //Después de 4 segundos ajax dará un error.
        {
            alert( "Tiempo de espera excedido" );
        });
}

function cargarSimbolos()
{
    xhr = $.ajax({
        url: baseUrl + 'index.php/Controlador_principal/interpretes_por_indice_simbolo',
        type: 'GET', //Lo mandamos por el método GET.
        async: true, //True para permitir el uso de ajax.
        success: cargarLista, //Función a la que se llama cada vez que actúa ajax.
        timeout:4000  // Tiempo máximo de espera para ajax 4 segundos.

    }).fail(function()  //Después de 4 segundos ajax dará un error.
        {
            alert( "Tiempo de espera excedido" );
        });
}

function cargarLista()
{
    $("#cargaListaInterpretes").html(xhr.responseText);
}

//Usuarios

function datosUsuario()
{
    //Conexión con ajax
    xhr = $.ajax({
        url: baseUrl + 'index.php/Controlador_principal/datos_usuario',
        type: 'GET', //Lo mandamos por el método GET.
        async: true, //True para permitir el uso de ajax.
        success: cargarEnPerfilUsuario, //Función a la que se llama cada vez que actúa ajax.
        timeout:4000  // Tiempo máximo de espera para ajax 4 segundos.

    }).fail(function()  //Después de 4 segundos ajax dará un error.
        {
            alert( "Tiempo de espera excedido" );
        });
}

function vistaAnyadirPublicacionesUsuario()
{
    //Conexión con ajax
    xhr = $.ajax({
        url: baseUrl + 'index.php/Controlador_principal/vista_anyadir_publicaciones_Usuario',
        type: 'GET', //Lo mandamos por el método GET.
        async: true, //True para permitir el uso de ajax.
        success: cargarEnPerfilUsuario, //Función a la que se llama cada vez que actúa ajax.
        timeout:4000  // Tiempo máximo de espera para ajax 4 segundos.

    }).fail(function()  //Después de 4 segundos ajax dará un error.
        {
            alert( "Tiempo de espera excedido" );
        });
}

function vistaPublicacionesUsuario()
{
    //Conexión con ajax
    xhr = $.ajax({
        url: baseUrl + 'index.php/Controlador_principal/vista_publicaciones_Usuario',
        type: 'GET', //Lo mandamos por el método GET.
        async: true, //True para permitir el uso de ajax.
        success: cargarEnPerfilUsuario, //Función a la que se llama cada vez que actúa ajax.
        timeout:4000  // Tiempo máximo de espera para ajax 4 segundos.

    }).fail(function()  //Después de 4 segundos ajax dará un error.
        {
            alert( "Tiempo de espera excedido" );
        });
}

function interpretesUsuario()
{
    //Conexión con ajax
    xhr = $.ajax({
        url: baseUrl + 'index.php/Controlador_principal/interpretes_Usuario',
        type: 'GET', //Lo mandamos por el método GET.
        async: true, //True para permitir el uso de ajax.
        success: cargarPublicacion, //Función a la que se llama cada vez que actúa ajax.
        timeout:4000  // Tiempo máximo de espera para ajax 4 segundos.

    }).fail(function()  //Después de 4 segundos ajax dará un error.
        {
            alert( "Tiempo de espera excedido" );
        });
}

function albumesUsuario()
{
    //Conexión con ajax
    xhr = $.ajax({
        url: baseUrl + 'index.php/Controlador_principal/albumes_Usuario',
        type: 'GET', //Lo mandamos por el método GET.
        async: true, //True para permitir el uso de ajax.
        success: cargarPublicacion, //Función a la que se llama cada vez que actúa ajax.
        timeout:4000  // Tiempo máximo de espera para ajax 4 segundos.

    }).fail(function()  //Después de 4 segundos ajax dará un error.
        {
            alert( "Tiempo de espera excedido" );
        });
}

function cancionesUsuario()
{
    //Conexión con ajax
    xhr = $.ajax({
        url: baseUrl + 'index.php/Controlador_principal/canciones_Usuario',
        type: 'GET', //Lo mandamos por el método GET.
        async: true, //True para permitir el uso de ajax.
        success: cargarPublicacion, //Función a la que se llama cada vez que actúa ajax.
        timeout:4000  // Tiempo máximo de espera para ajax 4 segundos.

    }).fail(function()  //Después de 4 segundos ajax dará un error.
        {
            alert( "Tiempo de espera excedido" );
        });
}

function formNuevoInterprete()
{
    //Conexión con ajax
    xhr = $.ajax({
        url: baseUrl + 'index.php/Controlador_principal/cargarFormularioNuevoInterprete',
        type: 'GET', //Lo mandamos por el método GET.
        async: true, //True para permitir el uso de ajax.
        success: cargarNuevasPublicaciones, //Función a la que se llama cada vez que actúa ajax.
        timeout:4000  // Tiempo máximo de espera para ajax 4 segundos.

    }).fail(function()  //Después de 4 segundos ajax dará un error.
        {
            alert( "Tiempo de espera excedido" );
        });
}

function cargarEnPerfilUsuario()
{
    $("#contenidoPerfilUsuario").html(xhr.responseText);
}

function cargarPublicacion()
{
    $("#cargarPublicacion").html(xhr.responseText);
}

function cargarNuevasPublicaciones()
{
    $("#cargarNuevasPublicaciones").html(xhr.responseText);
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

$("#contAcercaDe").hide();

$('#acercaDe').click(function(){
    $("#contAcercaDe").toggle("slow");
});

$('.selectGeneros').multipleSelect({
    selectAll: false,
    multiple: true,
    multipleWidth: 160,
    width: '100%',
    filter: true,
    placeholder: "Géneros"
});

var customTemplates = {
    custombuttons: function(customOptions) {
        var size = (customOptions.options && customOptions.options.size) ? ' btn-'+customOptions.options.size : '';
        return "<li>" +
            "<div class='btn-group'>" +
            "<a class='btn btn-default" + size + "' data-wysihtml5-command='undo' tabindex='-1' title='Deshacer' ><span class='fa fa-arrow-left'></span></a>" +
            "<a class='btn btn-default" + size + "' data-wysihtml5-command='redo' tabindex='-1' title='Rehacer'><span class='fa fa-arrow-right'></span></a>" +
            "</div>" +
            "</li>"+
            "<li>" +
            "<div class='btn-group'>" +
            "<a class='btn btn-default" + size + "' data-wysihtml5-command='justifyLeft' tabindex='-1' title='Alinear a la Izquierda'><span class='fa fa-align-left'></span></a>" +
            "<a class='btn btn-default" + size + "' data-wysihtml5-command='justifyCenter' tabindex='-1' title='Centrar'><span class='fa fa-align-center'></span></a>" +
            "<a class='btn btn-default" + size + "' data-wysihtml5-command='justifyRight' tabindex='-1' title='Alinear a la Derecha'><span class='fa fa-align-right'></span></a>" +
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
        "stylesheets": [baseUrl + "assets/css/style_wysihtml5.css"],
        customTemplates: customTemplates
    }
);

$('#bAddInfoCancion').click(function () {

    $("<div>", {
        class: "form-group"
    }).append(
        $("<label>", {
            class: "control-label",
            for: "durCan"

        }).text("Duración de la canción:"),

        $("<input>", {
            class: "form-control",
            type: "text",
            name: "durCan",
            id: "durCan"
        })

    ).appendTo('#formNuevaLetra');

    $("<div>", {
        class: "form-group"
    }).append(
        $("<label>", {
            class: "control-label",
            for: "compCan"

        }).text("Compositor de la canción:"),

        $("<input>", {
            class: "form-control",
            type: "text",
            name: "compCan",
            id: "compCan"
        })

    ).appendTo('#formNuevaLetra');

    $("<div>", {
        class: "form-group"
    }).append(
        $("<label>", {
            class: "control-label",
            for: "linkYou"

        }).text("Link a YouTube de la canción:"),

        $("<input>", {
            class: "form-control",
            type: "text",
            name: "linkYou",
            id: "linkYou"
        })

    ).appendTo('#formNuevaLetra');

    $("<div>", {
        class: "form-group"
    }).append(
        $("<label>", {
            class: "control-label",
            for: "comenCan"

        }).text("Comentario sobre la canción:"),

        $("<input>", {
            class: "form-control",
            type: "text",
            name: "comenCan",
            id: "comenCan"
        })

    ).appendTo('#formNuevaLetra');

})