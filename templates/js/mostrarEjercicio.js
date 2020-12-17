var botonChat = document.getElementById('botonChat');

if (botonChat) {
    botonChat.addEventListener('click', (event) => {
        document.location.href = 'chat.php';
    });
}

function updateTextInput(val) {
    document.getElementById('textInput').innerHTML = val;
}

function updateFile(val) {
    var valor = val.replace('C:\\fakepath\\', '');
    document.getElementById('archivoSeleccionado').innerHTML = valor;
}