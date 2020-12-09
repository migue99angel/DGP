listaPersonas = document.getElementById('listaPersonas');
listaGrups = document.getElementById('listaGrupos');

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
            if (event.target.checked) {
                deseleccionarGrupos();
            }
        });
    }
}

function deseleccionarGrupos() {
    for (i=0; i<listaGrupos.elements.length; i++) {
        listaGrupos.elements[i].checked = false;
    }
}

function asignarEventoListaGrupos(elemento) {
    if (elemento.type == 'checkbox') {
        elemento.addEventListener('change', (event) => {
            if (event.target.checked) {
                deseleccionarPersonas();
            }
        });
    }
}

function deseleccionarPersonas() {
    for (i=0; i<listaPersonas.elements.length; i++) {
        listaPersonas.elements[i].checked = false;
    }
}
