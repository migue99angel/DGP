var listaPersonas = document.getElementById('listaPersonas');
var listaGrupos = document.getElementById('listaGrupos');
var labels = [];

if (listaPersonas) {
    for (i=0; i<listaPersonas.elements.length; i++) {
        asignarEventoListaPersonas(listaPersonas.elements[i])
    }
}

if (listaGrupos) {
    for (i=0; i<listaGrupos.elements.length; i++) {
        asignarEventoListaGrupos(listaGrupos.elements[i])
    }
}

function asignarEventoListaPersonas(elemento) {
    if (elemento.type == 'checkbox') {
        elemento.addEventListener('change', (event) => {
            var idElemento = elemento.value.trim();
            if (event.target.checked) {
                deseleccionarGrupos();
                crearInputFecha(elemento,idElemento);
            } else {
                eliminarInputFecha(idElemento);
            }
        });
    }
}

function deseleccionarGrupos() {
    for (i=0; i<listaGrupos.elements.length; i++) {
        listaGrupos.elements[i].checked = false;
        eliminarInputFecha('Grupo' + listaGrupos.elements[i].value.trim())
    }
}

function asignarEventoListaGrupos(elemento) {
    if (elemento.type == 'checkbox') {
        var idElemento = 'Grupo' + elemento.value.trim();
        elemento.addEventListener('change', (event) => {
            if (event.target.checked) {
                deseleccionarPersonas();
                crearInputFecha(elemento,idElemento);
            } else {
                eliminarInputFecha(idElemento);
            }
        });
    }
}

function deseleccionarPersonas() {
    for (i=0; i<listaPersonas.elements.length; i++) {
        listaPersonas.elements[i].checked = false;
        eliminarInputFecha(listaPersonas.elements[i].value.trim())
    }
}

function crearInputFecha(elemento,idElemento) {
    var input = document.createElement('input');
    input.type = 'date';
    input.id = 'fecha' + idElemento;
    input.name = 'fecha' + idElemento;
    input.required = true;

    var label = document.createElement('label');
    label.setAttribute('for', input.id);
    label.innerHTML = 'Resolver para el ';

    labels.push(label);

    elemento.parentElement.appendChild(label);
    elemento.parentElement.appendChild(input);
}

function eliminarInputFecha(idElemento) {
    var input = document.getElementById('fecha'+idElemento);
    if (input) {
        var label = labels.find((element) => element.getAttribute('for').trim() == input.getAttribute('id').trim());
        labels.splice(labels.indexOf(label),1);
        label.remove();
        input.remove();
    }
}
