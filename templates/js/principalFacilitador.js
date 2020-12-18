var botonPrincipalFacilitador = document.getElementById("botonFaciEj1");

if (botonPrincipalFacilitador) {
    botonPrincipalFacilitador.addEventListener('click', (event) => {
        document.location.href = "asignarEjercicio.php";
    });
}

botonPrincipalFacilitador = document.getElementById("botonFaciEj2");

if (botonPrincipalFacilitador) {
    botonPrincipalFacilitador.addEventListener('click', (event) => {
        document.location.href = "listaEjercicios.php";
    });
}

botonPrincipalFacilitador = document.getElementById("botonFaciEj3");

if (botonPrincipalFacilitador) {
    botonPrincipalFacilitador.addEventListener('click', (event) => {
        document.location.href = "crearEjercicio.php";
    });
}

botonPrincipalFacilitador = document.getElementById("botonFaciEj4");

if (botonPrincipalFacilitador) {
    botonPrincipalFacilitador.addEventListener('click', (event) => {
        document.location.href = "administracionGrupo.php";
    });
}

botonPrincipalFacilitador = document.getElementById("botonFaciEj5");

if (botonPrincipalFacilitador) {
    botonPrincipalFacilitador.addEventListener('click', (event) => {
        document.location.href = "desasignarEjercicio.php";
    });
}

botonPrincipalFacilitador = document.getElementById("botonFaciChat");

if (botonPrincipalFacilitador) {
    botonPrincipalFacilitador.addEventListener('click', (event) => {
        document.location.href = "listaChatsFacilitadores.php";
    });
}
