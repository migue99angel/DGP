function updateImg(val) {
    var valor = val.replace('C:\\fakepath\\', '');
    document.getElementById('archivoSeleccionado').innerHTML = valor;
}

function updateVid(val) {
    var valor = val.replace('C:\\fakepath\\', '');
    document.getElementById('videoSeleccionado').innerHTML = valor;
}