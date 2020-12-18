function updateTextInput(val) {
    document.getElementById('textInput').innerHTML = val;
}

function updateFile(val) {
    var valor = val.replace('C:\\fakepath\\', '');
    document.getElementById('archivoSeleccionado').innerHTML = valor;
}