var pictograma = "";

function pictogramaPulsado(picto) {
   // Comprobar que ya hay 3 pictogramas elegidos
   if (pictograma.length < 3) {
      // Otener la imagen del pictograma
      pictograma += picto;
      var imgPictograma = document.getElementById("Pictograma" + picto).src;

      if (pictograma.length == 1) {
         document.getElementById("picto1").src = imgPictograma;
      } else if (pictograma.length == 2) {
         document.getElementById("picto2").src = imgPictograma;
      }
   }

   if (pictograma.length === 3) {
      document.getElementById("picto3").src = imgPictograma;

      var input = document.createElement("input");
      input.type = "hidden";
      input.value = pictograma;
      input.name = "pictograma";

      document.getElementById("loginPersonas").appendChild(input);
   }
}

function eliminarPictogramasSeleccionados() {
    pictograma = "";
    document.getElementById("picto1").src = "templates/img/cross.png";
    document.getElementById("picto2").src = "templates/img/cross.png";
    document.getElementById("picto3").src = "templates/img/cross.png";
}