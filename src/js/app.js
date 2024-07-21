let paso = 1;
const cita = {
    nombre: '',
    fecha: '',
    hora: '',
    servicios: []

} 




document.addEventListener('DOMContentLoaded', function() {
    inciarApp();
});

function inciarApp() { 
    mostrarSeccion(); //mostrar la seccion actual
    tabs(); //cambiar la seccion cuando se da click en un tab
    botonesPaginador(); //agrega o quita botones del paginador
    paginaSiguiente(); //cambia a la pagina siguiente
    paginaAnterior(); //cambia a la pagina anterior
    ApiServicios(); //consultando la api de servicios
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






async function ApiServicios(){
    try {
        const url = 'https://serviacrilico.com/api/servicios';
        const resultado = await fetch(url);
        const servicios = await resultado.json();
        mostrarServicios(servicios);
    } catch (e) {
      console.log(e);
        
    }

}

function mostrarServicios(servicios){
    servicios.forEach(servicio => {
        const {id,nombre,precio} =servicio;
        // scripting de los servicios
        const nombreServicio = document.createElement('P');
        nombreServicio.classList.add('nombre-servicio');
        nombreServicio.textContent = nombre;
       
        const precioServicio =document.createElement('P');
        precioServicio.classList.add('precio-servicio');
        precioServicio.textContent = `$ ${precio}`;

        // contenedor de servicios
        const servicioDiv = document.createElement('DIV');
        servicioDiv.classList.add('servicio');
        servicioDiv.dataset.idServicio = id; //creamos un atributo personalizado
        // seleccionar un servicio para la cita
        servicioDiv.onclick = function (){ // ejecuta una funcion al hacer click una funcion callback
            seleccionarServicio(servicio);
        }; 
        
        servicioDiv.appendChild(nombreServicio);
        servicioDiv.appendChild(precioServicio);

        document.querySelector('#servicios').appendChild(servicioDiv);


        
    });

}

function seleccionarServicio (servicio){
    console.log(servicio)
}