var botonTexto = document.getElementById('botonTextoChat');

if (botonTexto) {
    botonTexto.addEventListener('click', (event) => {
        toggleElement('escribirTextoChat','inline-block');
        toggleElement('enviarMensaje','inline-block');
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
