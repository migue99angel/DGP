var botonLogin = document.getElementById("botonLoginPersona");

if (botonLogin) {
    botonLogin.addEventListener('click', (event) => {
        document.location.href = "loginPersonas.php";
    });
}

botonLogin = document.getElementById("botonLoginFacilitador");

if (botonLogin) {
    botonLogin.addEventListener('click', (event) => {
        document.location.href = "loginFacilitador.php";
    });
}

botonLogin = document.getElementById("botonLoginAdministrador");

if (botonLogin) {
    botonLogin.addEventListener('click', (event) => {
        document.location.href = "loginAdministrador.php";
    });
}