var botonAdminRegistrar = document.getElementById("botonAdminRegistrar");
var direccion = "registro.php?tipoUsuario=" + botonAdminRegistrar.value;
console.log(direccion);

if (botonAdminRegistrar) {
    botonAdminRegistrar.addEventListener('click', (event) => {
        document.location.href = direccion;
    });
}
