let paso = 1;
document.addEventListener('DOMContentLoaded', function() {
    inciarApp();
});

function inciarApp() { 
    tabs(); //cambiar la seccion cuando se da click en un tab
}
function mostrarSeccion(paso){
    //ocultar la seccion anterior
    const seccionAnterior = document.querySelector('.mostrar');
    seccionAnterior.classList.remove('mostrar');
  

    // seleccionar la seccion con el paso
    const pasoSelector= `#paso-${paso}`;
    const seccion = document.querySelector(pasoSelector);
    seccion.classList.add('mostrar');



}

function tabs(){
    const botones = document.querySelectorAll('.tabs button');
    botones.forEach(boton =>{
        boton.addEventListener('click', (e) =>{
            paso = parseInt(e.target.dataset.paso);
            mostrarSeccion(paso);
        });
    });


}