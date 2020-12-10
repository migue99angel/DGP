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
            document.getElementById('idEjercicio').value = ej.getAttribute('id').trim();

            document.getElementById('irEjercicio').submit();
        });
    }
}
