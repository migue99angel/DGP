var pictograma = "";

function pictogramaPulsado(picto) {
    // Comprobar que ya hay 3 pictogramas elegidos
    var pictogramas = document.getElementById("contraseñaPictogramas");
    var numPictogramas = pictogramas.getElementsByTagName("div").length;

    if (numPictogramas < 3) {
        // Otener la imagen del pictograma
        pictograma += picto;
        var imgPictograma = document.getElementById("Pictograma" + picto).src;

        // Crear pictograma seleccionado
        var pictogramaSeleccionado = document.createElement("img");
        pictogramaSeleccionado.src = imgPictograma;

        // Crear estructura y añadir
        var pictogramaLoginPersonas = document.createElement("div");
        pictogramaLoginPersonas.className = "pictogramaContraseñaPersonas";
        pictogramaLoginPersonas.appendChild(pictogramaSeleccionado);
        document.getElementById("contraseñaPictogramas").appendChild(pictogramaLoginPersonas);
    }
    console.log(pictograma);
}

function eliminarPictogramasSeleccionados() {
    pictograma = "";
    document.getElementById("contraseñaPictogramas").innerHTML = "";
}