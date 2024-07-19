let paso = 1;
document.addEventListener('DOMContentLoaded', function() {
    inciarApp();
});

function inciarApp() { 
    mostrarSeccion(); //mostrar la seccion actual
    tabs(); //cambiar la seccion cuando se da click en un tab
    botonesPaginador(); //agrega o quita botones del paginador
    paginaSiguiente(); //cambia a la pagina siguiente
    paginaAnterior(); //cambia a la pagina anterior
}


function mostrarSeccion(){
    //ocultar la seccion anterior
    const seccionAnterior = document.querySelector('.mostrar');
    if(seccionAnterior){
    seccionAnterior.classList.remove('mostrar');
    // console.log('removiendo la clase mostrar');
    }

    // seleccionar la seccion con el paso
    const pasoSelector= `#paso-${paso}`;
    const seccion = document.querySelector(pasoSelector);
    seccion.classList.add('mostrar');

    // limpiar la clase actual en el tab anterior
    const tabAnterior = document.querySelector('.tabs .actual');
    if(tabAnterior){
        tabAnterior.classList.remove('actual');
    }

    // resaltar el tab actual
    const tab = document.querySelector(`[data-paso="${paso}"]`);
    tab.classList.add('actual');
   

}


function tabs(){
    const botones = document.querySelectorAll('.tabs button');
    botones.forEach(boton =>{
        boton.addEventListener('click', (e) =>{
            paso = parseInt(e.target.dataset.paso);
            mostrarSeccion();
            botonesPaginador();
        });
    });


}



function botonesPaginador(){
    const paginaAnterior = document.querySelector('#anterior');
    const paginaSiguiente = document.querySelector('#siguiente');
    if(paso === 1){
        paginaAnterior.classList.add('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    } else if(paso === 3){
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.add('ocultar');
    }else{
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    }

}
function paginaSiguiente(){
    const paginaAnterior = document.querySelector('#anterior');
    paginaAnterior.addEventListener('click', ()=>{
        paso--;
        mostrarSeccion();
        botonesPaginador();
    });

}
function paginaAnterior(){  
    const paginaSiguiente = document.querySelector('#siguiente');
    paginaSiguiente.addEventListener('click', ()=>{
        paso++;
        mostrarSeccion();
        botonesPaginador();

    });

}