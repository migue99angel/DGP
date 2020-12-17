var botonChat = document.getElementById('botonChat');

if (botonChat) {
    botonChat.addEventListener('click', (event) => {
        document.location.href = 'mostrarChat.php';
    });
}
