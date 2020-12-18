var botonTexto = document.getElementById('botonTextoChat');
var inputSeleccionado = {
    texto: false,
    audio: false,
    video: false
};

if (botonTexto) {
    botonTexto.addEventListener('click', (event) => {
        toggleElement('escribirTextoChat','inline-block');
        toggleElement('enviarMensaje','inline-block');
        inputSeleccionado.texto = !inputSeleccionado.texto;
    });
}

var botonEnviar = document.getElementById('enviarMensaje');

if (botonEnviar) {
    botonEnviar.addEventListener('click', (event) => {
        var script = 'ajax/enviarMensaje.php';
        var tipoMensaje = getTipoMensaje();
        var mensaje = {
            tipo: tipoMensaje,
            contenido: document.getElementById('escribirTextoChat').value
        }
        var params = `mensaje=${JSON.stringify(mensaje)}`;

        peticionAjaxRespuesta(script,params,recargarMensajes);
        document.getElementById('escribirTextoChat').value = "";
    });
}

function toggleElement(elementId,displayStyle) {
    var element = document.getElementById(elementId);
    if (element.style.display == displayStyle) {
        element.style.display = 'none';
    } else {
        element.style.display = displayStyle;
    }
}

function recargarMensajes(response) {
    var mensajes = document.getElementById('contenedorMensajes');

    mensajes.innerHTML = response.mensajes;
    console.log('Entrando');
}

function getTipoMensaje() {
    if (inputSeleccionado.texto == true) {
        return 'texto';
    } else if (inputSeleccionado.audio == true) {
        return 'audio';
    } else if (inputSeleccionado.video == true) {
        return 'video';
    } else {
        return 'texto';
    }
}

function refrescarMensajes() {
    var script = 'ajax/recargarMensajes.php';
    var params = '';
    peticionAjaxRespuesta(script,params,recargarMensajes);
}
var intervalo = setInterval(refrescarMensajes,3000);
console.log(intervalo);
