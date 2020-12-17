var nota = document.getElementById("nota").innerHTML;
for(var i=0; i < nota; i++)
{
    document.getElementById("estrella"+i).style.color = "orange" ;
}


var botonChat = document.getElementById('botonChat');

if (botonChat) {
    botonChat.addEventListener('click', (event) => {
        document.location.href = 'chat.php';
    });
}

