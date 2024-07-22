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
    nombreCita(); //añade el nombre del cliente al objeto cita
    seleccionarFecha(); // añade la fecha al objeto cita
    seleccionarHora(); //añade la hora al objeto cita
    mostrarResumen(); //muestra el resumen de la cita
    
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
        mostrarResumen();
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

    const {id} = servicio;
    const {servicios} = cita; //destructuring
    // identificar al elemento que se le dio click
    const servicioDiv = document.querySelector(`[data-id-servicio="${id}"]`);
    // comprabar si un servicio ya esta agregado
    if(servicios.some(agregado=>agregado.id=== id )){ //arrow mehtods
        // eliminar el servicio del arreglo
        cita.servicios = servicios.filter(agregado => agregado.id !== id);
        servicioDiv.classList.remove('seleccionado');
    } else{
        // agregar el servicio al arreglo
        cita.servicios = [...servicios, servicio]; //agregar el servicio al arreglo de servicios
        servicioDiv.classList.add('seleccionado');
    }

    console.log(cita);
}



function nombreCita(){
    const nombre=document.querySelector('#nombre').value;
    cita.nombre = nombre;
    console.log(cita);
}


function seleccionarFecha(){
    const inputFecha = document.querySelector('#fecha');
    inputFecha.addEventListener('input',function(e){
        const dia = new Date(e.target.value).getUTCDay();
        if([6,0].includes(dia)){
            e.target.value = '';
            mostrarAlerta('No se puede agendar en fin de semana','error','.formulario');
           
        }else{
            cita.fecha = e.target.value;
            console.log(cita);
           
        }

    });
}


function seleccionarHora(){
    const inputHora = document.querySelector('#hora');
    inputHora.addEventListener('input',function(e){
    
    const horaCita = e.target.value
    const hora = horaCita.split(":");

    if(hora[0] < 10 || hora[0] > 18){
        e.target.value = '';
       mostrarAlerta('Hora no valida','error','.formulario');
    }else{
        cita.hora = horaCita;
        console.log(cita);
    }
    })
}






function mostrarAlerta(mensaje,tipo,elemento,desparece=true){
    // si hay una alerta previa no crear otra
    const alertaPrevia = document.querySelector('.alerta');
    if(alertaPrevia) {
        alertaPrevia.remove();
    };
    
    // scriptin de la alerta
    // crear la alerta
    const alerta = document.createElement('DIV');
    alerta.textContent = mensaje;
    alerta.classList.add('alerta');
    alerta.classList.add(tipo);
    const referencia = document.querySelector(elemento);
    referencia.appendChild(alerta);
    if(desparece){
        // eliminar la alerta despues de 3 segundos
        setTimeout(()=>{
            alerta.remove();
        },3000);
    }
   
}




function mostrarResumen (){
    const resumen = document.querySelector('.contenido-resumen');
    // limpiar el html previo
    while(resumen.firstChild){
        resumen.removeChild(resumen.firstChild);
    }

    //  iteramos sobre el objeto cita para mostrar el resumen
    if(Object.values(cita).includes('') || cita.servicios.length === 0){
       
        mostrarAlerta('Faltan datos de servicios, hora, fecha o nombre','error','.contenido-resumen',false);
     return;
    }
    // formatear el Div
    const {nombre,fecha,hora,servicios} = cita;
    const nombreCliente = document.createElement('P');
    nombreCliente.innerHTML = `<span>Nombre:</span> ${nombre}`;
    const fechaCita = document.createElement('P');
    fechaCita.innerHTML = `<span>Fecha:</span> ${fecha}`;
    const horaCita = document.createElement('P');
    horaCita.innerHTML = `<span>Hora:</span> ${hora}`;

    // para los servicios foreach
    servicios.forEach(servicio =>{
        // destructuring
        const {id,nombre,precio} = servicio;
        const contenedorServicio = document.createElement('DIV');
        contenedorServicio.classList.add('contenedor-servicio');

    
        const textoServicio = document.createElement('P');
        textoServicio.innerHTML = `<span>Servicio:</span> ${nombre}`;


        const precioServicio = document.createElement('P');
        precioServicio.innerHTML = `<span>Precio:</span> $ ${precio}`;

        const x = document.createElement('P');
        x.textContent = 'X';
        x.classList.add('eliminar');
        x.onclick = function(){
            cita.servicios = cita.servicios.filter(servicio => servicio.id !== id);
            mostrarResumen();
        }

        contenedorServicio.appendChild(textoServicio);
        contenedorServicio.appendChild(x);
        contenedorServicio.appendChild(precioServicio);
        resumen.appendChild(contenedorServicio);

    })


    resumen.appendChild(nombreCliente);
    resumen.appendChild(fechaCita);
    resumen.appendChild(horaCita);


}