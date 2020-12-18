function peticionAjaxRedireccion(scriptPeticion,paginaRedireccion,parametros) {
    var peticion = new XMLHttpRequest();

    peticion.open('POST', scriptPeticion);
		peticion.onload = () => {
			if (peticion.status == 200 && peticion.responseText != '') {
                var response = null;

				try {
                    response = JSON.parse(peticion.responseText);
				} catch (e) {
					console.error("No se pudo parsear la información del servidor");
				}

				if (response) {
					if (response.exito) {
						document.location.href = paginaRedireccion;
					}
				}
			} else {
				console.error('Peticion fallida');
			}
        };
        peticion.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        peticion.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

		peticion.send(parametros);
}

function peticionAjaxRespuesta(scriptPeticion,parametros,callbackExito) {
    var peticion = new XMLHttpRequest();

    peticion.open('POST', scriptPeticion);
		peticion.onload = () => {
			if (peticion.status == 200 && peticion.responseText != '') {
                var response = null;

				try {
                    response = JSON.parse(peticion.responseText);
				} catch (e) {
					console.error("No se pudo parsear la información del servidor");
				}

				if (response) {
					if (response.exito) {
						callbackExito(response);
					}
				}
			} else {
				console.error('Peticion fallida');
			}
        };
        peticion.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        peticion.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

		peticion.send(parametros);
}
