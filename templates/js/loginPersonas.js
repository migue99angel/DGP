var pictograma = "";

function pictogramaPulsado(picto) {
   // Comprobar que ya hay 3 pictogramas elegidos
   if (pictograma.length < 3) {
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

   if (pictograma.length === 3) {
      var input = document.createElement("input");
      input.type = "hidden";
      input.value = pictograma;
      input.name = "pictograma";

      document.getElementById("loginPersonas").appendChild(input);
   }
}

function eliminarPictogramasSeleccionados() {
    pictograma = "";
    document.getElementById("contraseñaPictogramas").innerHTML = "";
}