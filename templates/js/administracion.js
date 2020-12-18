var botonAdminRegistrar = document.getElementById("botonAdminRegistrar");
var direccion = "registro.php?tipoUsuario=" + botonAdminRegistrar.value;

if (botonAdminRegistrar) {
    botonAdminRegistrar.addEventListener('click', (event) => {
        document.location.href = direccion;
    });
}
