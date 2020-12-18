var botonPrincipalPersona = document.getElementById("botonEjerciciosPersona");

if (botonPrincipalPersona) {
    botonPrincipalPersona.addEventListener('click', (event) => {
        document.location.href = "listaEjercicios.php";
    });
}

botonPrincipalPersona = document.getElementById("botonAdiosPersona");

if (botonPrincipalPersona) {
    botonPrincipalPersona.addEventListener('click', (event) => {
        document.location.href = "principalPersonas.php?cerrarSesion=1";
    });
}