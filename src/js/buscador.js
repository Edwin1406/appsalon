document.addEventListener('DOMContentLoaded', function() {
    iniciarApp();

});

function iniciarApp() {
    buscarPorFecha();
}

function buscarPorFecha(){
    const fecha = document.querySelector('#fecha');
    fechainput.addEventListener('input', e => {
        const fechaSeleccionada = new Date(e.target.value);
        console.log(fechaSeleccionada);

    });

}