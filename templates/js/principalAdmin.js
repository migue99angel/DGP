var botonPrincipalAdmin = document.getElementById("botonAdmin1");

if (botonPrincipalAdmin) {
    botonPrincipalAdmin.addEventListener('click', (event) => {
        document.location.href = "administracion.php?tipoUsuario=Persona";
    });
}

botonPrincipalAdmin = document.getElementById("botonAdmin2");

if (botonPrincipalAdmin) {
    botonPrincipalAdmin.addEventListener('click', (event) => {
        document.location.href = "administracion.php?tipoUsuario=Facilitador";
    });
}

botonPrincipalAdmin = document.getElementById("botonAdmin3");

if (botonPrincipalAdmin) {
    botonPrincipalAdmin.addEventListener('click', (event) => {
        document.location.href = "administracion.php?tipoUsuario=Administrador";
    });
}