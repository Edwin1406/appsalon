let paso = 1;
const cita = {
    id: '',
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
    idCliente(); //añade el id del cliente al objeto cita
    seleccionarFecha(); // añade la fecha al objeto cita
    // seleccionarHora(); //añade la hora al objeto cita
    mostrarResumen(); //muestra el resumen de la citA
    ApiHoras(); //consultando la api de horas disponibles  
    generarHorasDisponibles(); //genera las horas disponibles en el input de hora  
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
        const url = `${location.origin}/api/servicios`;
        const resultado = await fetch(url);
        const servicios = await resultado.json();
        // console.log(servicios);
        mostrarServicios(servicios);
       
    } catch (e) {
      console.log(e);
        
    }

}

function mostrarServicios(servicios){
    servicios.forEach(servicio => {
        const {id,nombre,precio,odontologo} =servicio;
        // console.log(servicio);
        // scripting de los servicios
        const nombreServicio = document.createElement('P');
        nombreServicio.classList.add('precio-servicio');
        nombreServicio.textContent = nombre;
       
        // const precioServicio =document.createElement('P');
        // precioServicio.classList.add('precio-servicio');
        // precioServicio.textContent = `$ ${precio}`;

        const odontologos = document.createElement('P');
        odontologos.classList.add('nombre-servicio');
        odontologos.textContent = odontologo;

        // contenedor de servicios
        const servicioDiv = document.createElement('DIV');
        servicioDiv.classList.add('servicio');
        servicioDiv.dataset.idServicio = id; //creamos un atributo personalizado
        // seleccionar un servicio para la cita
        servicioDiv.onclick = function (){ // ejecuta una funcion al hacer click una funcion callback
            seleccionarServicio(servicio);
        }; 
        
        servicioDiv.appendChild(nombreServicio);
        // servicioDiv.appendChild(precioServicio);
        servicioDiv.appendChild(odontologos);

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

// id del cliente agregado al objeto cita
function idCliente(){
    const id = document.querySelector('#id').value;
    cita.id=id;
    console.log(cita);

}
// nombre del cliente agregado al objeto cita
function nombreCita(){
    const nombre=document.querySelector('#nombre').value;
    cita.nombre = nombre;

    // console.log(cita);
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




// API DE HORAS SELECCIONADAS PARA LA CITA

async function ApiHoras(){
    try {
        const url = `${location.origin}/api/horas`;
        const resultado = await fetch(url);
        const horas = await resultado.json();
        mostrarHoras(horas);
      
        
    } catch (error) {
        console.log(error);
        
    }
   
}


function generarHorasDisponibles() {
    const datalist = document.querySelector('#horasDisponibles');
    const startTime = 10; // Hora de inicio
    const endTime = 19;  // Hora de finalización
    const interval = 30; // Intervalo de 30 minutos

    for (let hour = startTime; hour < endTime; hour++) {
        for (let minute = 0; minute < 60; minute += interval) {
            let timeString = `${String(hour).padStart(2, '0')}:${String(minute).padStart(2, '0')}`;
            const option = document.createElement('option');
            option.value = timeString;
            datalist.appendChild(option);
        }
    }
}



function mostrarHoras(horas) {
    // const horasReservadas = horas.map(horasReservada => horasReservada.hora.slice(0, 5)); // Elimina los segundos
    // const fechasReservadas = horas.map(fechaReservada => fechaReservada.fecha);

    const inputHora = document.querySelector('#hora');
    const inputFecha = document.querySelector('#fecha');

    inputHora.addEventListener('input', function(e) {
        const horaCita = e.target.value.slice(0, 5); // Solo hora y minutos
        const fechaCita = inputFecha.value;
        console.log(fechaCita);

        // Comprobar si la fecha y hora ya están reservadas
        const fechaYHoraReservada = horas.some(hora => hora.hora.slice(0, 5) === horaCita && hora.fecha === fechaCita);
        
        if (fechaYHoraReservada) {
            e.target.value = '';
            // mostrarAlerta('Hora ya reservada en esa fecha', 'error', '.formulario');
            Swal.fire({
                icon: "error",
                title: "Hora ya reservada en esa fecha",
                text: "Por favor selecciona otra hora",
              });
        } else if (parseInt(horaCita.split(":")[0]) < 10 || parseInt(horaCita.split(":")[0]) == 19) {
            e.target.value = '';
            // mostrarAlerta('Hora no válida', 'error', '.formulario');
            Swal.fire({
                icon: "error",
                title: "Hora no valida",
                text: "Ya esa hora no esta disponible",
              });
        } else {
            cita.hora = horaCita;
            console.log(cita); 
        }
    });
}

// -------------------------------------------  ALERTAS ----------------------------------------------

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
    // destructuring
    const {nombre,fecha,hora,servicios} = cita;
  
    // heading para el resumen de Servicios
    const headingServicios = document.createElement('H3');
    headingServicios.textContent = 'Resumen de Servicios';
    resumen.appendChild(headingServicios);

    // Iterar sobre el arreglo de servicios y mostrar el resumen
    servicios.forEach(servicio =>{
        // destructuring
        const {id,nombre,precio,odontologo} = servicio;
        const contenedorServicio = document.createElement('DIV');
        contenedorServicio.classList.add('contenedor-servicio');

    
        const textoServicio = document.createElement('P');
        textoServicio.innerHTML = `<span>Servicio:</span> ${nombre}`;


        // const precioServicio = document.createElement('P');
        // precioServicio.innerHTML = `<span>Precio:</span> $ ${precio}`;

    
        const odonto = document.createElement('P');
        odonto.innerHTML = `<span>Odontólogo/a:</span> ${odontologo}`;

    

        contenedorServicio.appendChild(textoServicio);
        // contenedorServicio.appendChild(precioServicio);
        contenedorServicio.appendChild(odonto);
        resumen.appendChild(contenedorServicio);

    })

      
    // heading para el resumen de Servicios
    const headingCitas = document.createElement('H3');
    headingCitas.textContent = 'Resumen de Cita';
    resumen.appendChild(headingCitas);

    // scriptin del resumen
    const nombreCliente = document.createElement('P');
    nombreCliente.innerHTML = `<span>Nombre:</span> ${nombre}`;


    // formatear la fecha en español
    const fechaObj = new Date(fecha);
    const mes = fechaObj.getMonth();
    const dia = fechaObj.getDate()+2;
    const year = fechaObj.getFullYear();

    const fechaUTC = new Date(Date.UTC(year,mes,dia));
    const fechaFormateada = fechaUTC.toLocaleDateString('es-ES',{
        weekday:'long',
        year:'numeric',
        month:'long',
        day:'numeric',
    });

    const fechaCita = document.createElement('P');
    fechaCita.innerHTML = `<span>Fecha:</span> ${fechaFormateada}`;

    const horaCita = document.createElement('P');
    horaCita.innerHTML = `<span>Hora:</span> ${hora} Horas`;

    // boton para crear la cita
    const botonReservar = document.createElement('BUTTON');
    botonReservar.classList.add('boton');
    botonReservar.textContent = 'Reservar Cita';
    botonReservar.onclick = reservarCita; // agregamos la funcion de reservar cita




    resumen.appendChild(nombreCliente);
    resumen.appendChild(fechaCita);
    resumen.appendChild(horaCita);
    resumen.appendChild(botonReservar);

}

// -------------------------------------------  FETCH API ----------------------------------------------    

async function reservarCita(){
    // destructuring
    const {nombre,fecha,hora,servicios,id} = cita;
    const idServicio = servicios.map(servicio => servicio.id); //map para extraer los id de los servicios
    console.log(idServicio);

    // enviar la peticion a la api
    const datos =  new FormData();
    datos.append('fecha',fecha);
    datos.append('hora',hora);
    datos.append('usuarioId',id);
    datos.append('servicios',idServicio);
    
  

    try {

         //conexion a la api 
      const url = `${location.origin}/admin/api/citas`;
      const respuesta = await fetch(url,{
          method:'POST',
          body:datos
      });

        const resultado = await respuesta.json();
        console.log(resultado.resultado);
        if(resultado.resultado){
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: `Gracias ${nombre} tu cita ha sido registrada`,
                showConfirmButton: false,
                timer: 3000
            }).then(()=>{ // creamos un callback para que se ejecute despues de que se cierre el alert
                // setTimeout(()=>{
                // },3000);
                window.location.reload(); 
            })
        }
        
    } catch (error) {
        Swal.fire({
            position: "top-end",
            icon: "error",
            title: "Error no se pudo registrar la cita",
            showConfirmButton: false,
            timer: 3000
        })
    }

    // sprend operator para los servicios
    // console.log([...datos]); // para ver los datos que se envian
}

