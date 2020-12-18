var ejercicios = document.getElementsByClassName('reiniciarBoton previewEjercicio');
if (ejercicios.length > 0) {
    for (const ej of ejercicios) {
        ej.addEventListener('click', (event) => {
            var idEjercicio = ej.getAttribute('id').trim();
            var idPersona = ej.getAttribute('data-idpersona').trim();
            var fechaAsignacion = ej.getAttribute('data-fechaasignacion').trim();

            var script = 'ajax/cargarEjercicioAsignado.php';
            var redireccion = 'mostrarChat.php';
            var params = `idEjercicio=${idEjercicio}&idPersona=${idPersona}&fechaAsignacion=${fechaAsignacion}`;
            peticionAjaxRedireccion(script,redireccion,params);
        });
    }
}
