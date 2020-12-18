var botonCorregir = document.getElementById("botonAdminRegistrar");

if (botonCorregir) {
    var direccion = "corregirEjercicio.php?idEjercicio=" + botonCorregir.value;
    botonPrincipalFacilitador.addEventListener('click', (event) => {
        document.location.href = direccion;
    });
}

if (lunes = document.getElementById('lunes')) {
    diasSemana = {
        lunes     : lunes,
        martes    : document.getElementById('martes'),
        miercoles : document.getElementById('miercoles'),
        jueves    : document.getElementById('jueves'),
        viernes   : document.getElementById('viernes'),
        sabado    : document.getElementById('sabado'),
        domingo   : document.getElementById('domingo')
    };

    for (const dia in diasSemana) {
        diasSemana[dia].addEventListener('click', () => {
            document.getElementById('inputDia').value = dia;

            document.getElementById('diaEnviar').submit();
        });
    }
}
var ejercicios = document.getElementsByClassName('reiniciarBoton previewEjercicio');
if (ejercicios.length > 0) {
    for (const ej of ejercicios) {
        ej.addEventListener('click', (event) => {
            var idEjercicio = ej.getAttribute('id').trim();
            var idFacilitador = ej.getAttribute('data-idfacilitador').trim();
            var fechaAsignacion = ej.getAttribute('data-fechaasignacion').trim();

            var script = 'ajax/cargarEjercicioAsignado.php';
            var redireccion = 'mostrarEjercicio.php';
            var params = `idEjercicio=${idEjercicio}&idFacilitador=${idFacilitador}&fechaAsignacion=${fechaAsignacion}`;
            peticionAjaxRedireccion(script,redireccion,params);
        });
    }
}
