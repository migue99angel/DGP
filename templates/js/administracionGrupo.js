var botonPrincipalFacilitador = document.getElementById("botonAdminRegistrar");

if (botonPrincipalFacilitador) {
    botonPrincipalFacilitador.addEventListener('click', (event) => {
        document.location.href = "crearGrupo.php";
    });
}