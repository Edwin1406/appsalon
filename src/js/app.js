let paso = 1;
document.addEventListener('DOMContentLoaded', function() {
    inciarApp();
});

function inciarApp() { 
    tabs(); //cambiar la seccion cuando se da click en un tab
}
function mostrarSeccion(){
    // //ocultar la seccion anterior
    // const seccionAnterior = document.querySelector('.mostrar');
    // if(seccionAnterior){
    // seccionAnterior.classList.remove('mostrar');
    // // console.log('removiendo la clase mostrar');
    // }

    // // seleccionar la seccion con el paso
    // const pasoSelector= `#paso-${paso}`;
    // const seccion = document.querySelector(pasoSelector);
    // seccion.classList.add('mostrar');
    console.log('mostrar seccion', paso);


}

function tabs(){
    const botones = document.querySelectorAll('.tabs button');
    botones.forEach(boton =>{
        boton.addEventListener('click', (e) =>{
            paso = parseInt(e.target.dataset.paso);
            mostrarSeccion();
        });
    });


}