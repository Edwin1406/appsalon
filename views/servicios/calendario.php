<link rel="shortcut icon" href="/public/build/img/dentista.jpg" type="image/x-icon">
<h1 class="nombre-pagina">Calendario</h1>
<?php include_once __DIR__. '/../templates/barras.php' ?>


<div class="contenido_ir">

    <div class="dashboard__contenedor-boton">
        <a class="dashboard__boton" href="/admin/servicios/cliente">
            <i class="fa-solid fa-circle-arrow-left"></i>
            AGREGAR CLIENTE
        </a>
        
    </div>
    <div class="dashboard__contenedor-boton">
        <a class="dashboard__boton" href="/admin/servicios/agendar">
            <i class="fa-solid fa-circle-arrow-left"></i>
            AGREGAR CITA
        </a>
        
    </div>
    <div class="dashboard__contenedor-boton">
        <a class="dashboard__boton" href="/admin/servicios/odontologo">
            <i class="fa-solid fa-circle-arrow-left"></i>
                CREAR ODONTÓLOGO
        </a>
    </div>

    <div class="dashboard__contenedor-boton">
        <a class="dashboard__boton" href="/admin">
            <i class="fa-solid fa-circle-arrow-left"></i>
            INICIO
        </a>
        
    </div>



</div>
<style>

.contenido_ir {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap; /* Permitir que los botones se muevan a la siguiente línea si no caben */
    margin-top: 2rem;
    border-radius: 1rem;
    padding: 1rem;
    gap: 1rem;
    width: auto; /* Permitir que se adapte al contenido */
}

.dashboard__contenedor-boton {
    display: flex;
    justify-content: center;
    margin-top: 2rem;
    border-radius: 1rem;
    padding: 1rem;
    width: auto; /* Permitir que el contenedor se adapte al contenido */
}

.dashboard__boton {
    text-decoration: none;
    color: white;
    background-color: #333;
    padding: 1rem;
    border-radius: 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    gap: 0.5rem;
    min-width: 150px; /* Ajustar el tamaño mínimo */
    white-space: nowrap; /* Evitar saltos de línea en el texto */
}

.dashboard__boton i {
    font-size: 1rem; /* Ajustar el tamaño del icono */
}


#calendar {
            max-width: 100%;
            margin: 1rem ;
            background-color: #fff;
            color: black;
            padding: 1rem;
            border-radius: 0.5rem;
        }

        

        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 999;
        }

        .modal_contenido {
            background: #fff;
            padding: 20px 30px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
            max-width: 90%;
            max-height: 80vh;
            overflow-y: auto;
            position: relative;
        }

        .cerrar_modal {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            font-weight: bold;
            color: #333;
            cursor: pointer;
        }

        .modal_titulo {
            font-size: 20px;
            font-weight: bold;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        .modal_detalles p {
            font-size: 16px;
            line-height: 1.5;
            color: #555;
            margin-bottom: 10px;
            word-wrap: break-word;
        }

        .modal_detalles p strong {
            color: #333;
        }

        #whatsappButton {
            background-color: #25d366;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }

        h2{
            color: #333;
            text-align: center;
        }
        

        @media (max-width: 768px) {

            .fc .fc-toolbar{
                display: block;
            }
        }





</style>
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<?php if(isset($_SESSION['mensaje_exito'])): ?>
    <p class="alerta exito"><?php echo $_SESSION['mensaje_exito']; ?></p>
    <?php unset($_SESSION['mensaje_exito']); ?>
<?php endif; ?>


<div id="calendar"></div>
<div id="modalInfoCita" class="modal" style="display: none;">
    <div class="modal_contenido">
        <span class="cerrar_modal" id="cerrarModal">&times;</span>
        <h2 class="modal_titulo">Detalles de la Cita</h2>
        <div class="modal_detalles">
            <p><strong>Nombre del Paciente:</strong> <span id="nombre_paciente_info"></span></p>
            <p><strong>Fecha:</strong> <span id="fecha_info"></span></p>
            <p><strong>Hora:</strong> <span id="hora_info"></span></p>
            <p><strong>Teléfono:</strong> <span id="telefono_info"></span></p>
            <p><strong>Doctor:</strong> <span id="doctor_info"></span></p>
            <p><strong>Asunto:</strong> <span id="asunto_info"></span></p>            
            <p><strong>Estado:</strong> <span id="estado_info"></span></p>
            <!-- cambio -->
            <p><strong>Nota:</strong> <span id="nota_info"></span></p>




<style>
    .pendiente {
        color: tomato;
    }

    .confirmado {
        color: green;
    }

    .cancelado {
        color: red;
    }

    #estado_info {
        display: inline-block;
        padding: 0.5rem;
        border-radius: 0.5rem;
        background-color: #f1f1f1;
        /* sombreado */
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    #estado_info:hover {
        cursor: pointer;
        /* background-color: #B5B2B2; */
        /* color: white; */
    }
</style>


        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');
    const modal = document.getElementById('modalInfoCita');
    const cerrarModal = document.getElementById('cerrarModal');
    const estadoInfo = document.getElementById('estado_info'); 
    const whatsappButton = document.createElement('button');
    whatsappButton.textContent = 'Enviar WhatsApp';
    whatsappButton.id = 'whatsappButton';
    whatsappButton.style.marginTop = '10px';
    document.querySelector('.modal_contenido').appendChild(whatsappButton);

    const colorPorAsunto = {
        'Odontología General': '#007bff', 
        'Ortodoncia': '#28a745',      
        'Endodoncia': '#dc3545',       
        'Limpieza Dental': '#ffc107', 
        'Blanqueamiento': '#17a2b8',   
        'Rehabilitación Oral': '#6c757d',
        'Extracción': '#6610f2',        
        'Cirugía Oral': '#fd7e14', 
        'Restauración': '#e8f6f3', 
        'Periodoncia': '#f8d7da',
    };

    const calendar = new FullCalendar.Calendar(calendarEl, {

        
        
        initialView: 'dayGridMonth',
        locale: 'es',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        buttonText: {
            today: 'Hoy',
            month: 'Mes',
            week: 'Semana',
            day: 'Día'
        },
        events: function(fetchInfo, successCallback, failureCallback) {
            fetch(`${location.origin}/admin/api/apicitaservicio`)
                .then(response => response.json())
                .then(data => {
                    // Ordenamos los eventos por fecha y hora
                    data.sort((a, b) => {
                        const dateA = new Date(`${a.fecha}T${a.hora}`);
                        const dateB = new Date(`${b.fecha}T${b.hora}`);
                        return dateA - dateB;
                    });

                    const eventos = data.map(cita => ({
                 
                        id: cita.cita_id,
                        title: `${cita.hora.substring(0,5)}- ${cita.nombrecliente} ${cita.apellidocliente}- ${cita.nota}`,
                        start: cita.fecha, 
                        extendedProps: {
                            hora: cita.hora,
                            telefono: cita.telefonocliente.startsWith('+') ? cita.telefonocliente : `+593${cita.telefonocliente.replace(/^0/, '')}`,
                            doctor: cita.nombreodontologo.trim(),
                            asunto: cita.nombreservicio.trim(),
                            estado: cita.estado.trim(),
                            // se agrego nota
                            nota: cita.nota.trim()

                        },
                        backgroundColor: colorPorAsunto[cita.nombreservicio.trim()] || colorPorAsunto['Otro'],
                        borderColor: colorPorAsunto[cita.nombreservicio.trim()] || colorPorAsunto['Otro']
                    }));

                    mostrarNotificacion();

                    successCallback(eventos);
                })
                .catch(error => failureCallback(error));
        },
        eventOrder: "title",  // Asegura que los eventos se ordenen por la hora en el título
        eventClick: function(info) {
            document.getElementById('nombre_paciente_info').textContent = info.event.title;
            document.getElementById('fecha_info').textContent = info.event.start.toISOString().split('T')[0];
            document.getElementById('hora_info').textContent = info.event.extendedProps.hora;
            document.getElementById('telefono_info').textContent = info.event.extendedProps.telefono;
            document.getElementById('doctor_info').textContent = info.event.extendedProps.doctor;
            document.getElementById('asunto_info').textContent = info.event.extendedProps.asunto;
            document.getElementById('estado_info').textContent = info.event.extendedProps.estado;
            // se agrego nota
            document.getElementById('nota_info').textContent = info.event.extendedProps.nota;


            estadoInfo.setAttribute('data-cita-id', info.event.id);
            const tituloSeparado = info.event.title.split("- "); 
            const nombre = tituloSeparado.length > 1 ? tituloSeparado[1].trim() : tituloSeparado[0].trim();

            console.log(nombre)

            const mensaje = `Hola, ${nombre}, Te saluda Dental Álvarez. Te recordamos tu cita el día ${info.event.start.toISOString().split('T')[0]} a las ${info.event.extendedProps.hora}. Confirma tu asistencia en el siguiente enlace: https://odonto.megawebsistem.com/aceptar?id=${info.event.id}`;

            const telefono = info.event.extendedProps.telefono;

            whatsappButton.onclick = function() {
                const whatsappURL = `https://wa.me/${telefono}?text=${encodeURIComponent(mensaje)}`;
                window.open(whatsappURL, '_blank');
            };



            if (info.event.extendedProps.nota)
            {
            
            Toastify({
                text: `Nota: ${info.event.extendedProps.nota}`   ,
                duration: 3000,
                gravity: "top", // top, bottom
                position: "right", // left, right, center
                backgroundColor: "linear-gradient(to right, #ff416c, #ff4b2b)",
                stopOnFocus: true, 
                style: {
                    borderRadius: "8px",
                    boxShadow: "0px 0px 10px rgba(0, 0, 0, 0.2)"
                },
             
            }).showToast();
        
            }else 
            {
                Toastify({
                text: `No hay notas para esta cita`,
                duration: 3000,
                gravity: "top", // top, bottom
                position: "right", // left, right, center
                backgroundColor: "linear-gradient(to right, #007bff, #007bff)",
                stopOnFocus: true, 
                style: {
                    borderRadius: "8px",
                    boxShadow: "0px 0px 10px rgba(0, 0, 0, 0.2)"
                },
                
            }).showToast();
            }



            modal.style.display = 'flex';
        }











        
    });

    calendar.render();
    setInterval(() => calendar.refetchEvents(), 60000); // Actualizar cada 60 segundos

    cerrarModal.addEventListener('click', function() {
        modal.style.display = 'none';
    });



// Función para mostrar la notificación de forma automática
function mostrarNotificacion() {
    const eventos = calendar.getEvents();
    const fechaActual = new Date(); // Obtener la fecha y hora actual

    for (const evento of eventos) {
        const fechaCita = evento.start.toISOString().split('T')[0]; // Obtener fecha de la cita
        const horaCita = evento.extendedProps.hora; // Hora en formato "HH:mm"
        //nombre del paciente
        const tituloSeparado = evento.title.split("- ");
        const nombre = tituloSeparado.length > 1 ? tituloSeparado[1].trim() : tituloSeparado[0].trim();

        // Convertir la fecha y hora de la cita a un objeto Date
        const fechaHoraCita = new Date(`${fechaCita}T${horaCita}`);

        // Verificar si la hora actual es menor que la cita (para que se notifique hasta la hora exacta)
        if (fechaActual < fechaHoraCita) {
           
            //mensaje 
            const mensaje = `Hola, ${nombre}, Te saluda Dental Álvarez. Te recordamos tu cita el día ${fechaCita} a las ${horaCita}. Confirma tu asistencia en el siguiente enlace: https://odonto.megawebsistem.com/aceptar?id=${evento.id}`;

            // Mostrar la notificación en pantalla con Toastify
            Toastify({
                text: mensaje,
                duration: 5000,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "#28a745",
                stopOnFocus: true
            }).showToast();

            // Opcional: Enviar mensaje por WhatsApp
            const telefono = evento.extendedProps.telefono;
            const whatsappURL = `https://wa.me/${telefono}?text=${encodeURIComponent(mensaje)}`;
            window.open(whatsappURL, '_blank');
        }
    }
}

// Iniciar las notificaciones automáticas cada 5 segundos
setInterval(mostrarNotificacion, 5000);




    



    estadoInfo.addEventListener('dblclick', function() {
        const citaId = estadoInfo.getAttribute('data-cita-id');
        console.log(citaId);
        Apiestado(citaId);
    });

    async function Apiestado(citaId) {
        try {
            const url = `${location.origin}/admin/api/estado?id=${citaId}`;
            const resultado = await fetch(url);
            const visor = await resultado.json();
            const nuevoEstado = visor.estado === 'PENDIENTE' ? 'CONFIRMADO' : 'CANCELADO';
            visor.estado = nuevoEstado;
            actualizarEstado(visor);
        } catch (error) {
            console.log(error);
        }
    }

    async function actualizarEstado(visor) {
        const { id, fecha, hora, estado, usuarioId } = visor;

        const data = new FormData();
        data.append('id', id);
        data.append('fecha', fecha);
        data.append('hora', hora);
        data.append('estado', estado);
        data.append('usuarioId', usuarioId);

        try {
            const url = `${location.origin}/admin/api/actualizarestado`;
            const respuesta = await fetch(url, {
                method: 'POST',
                body: data
            });
            const resultado = await respuesta.json();
            if (resultado.respuesta.tipo === 'correcto') {
                const elementoEstado = document.getElementById("estado_info");
                if (elementoEstado) {
                    elementoEstado.textContent = estado;
                    elementoEstado.classList.remove('pendiente', 'confirmado', 'cancelado');
                    elementoEstado.classList.add(estado.toLowerCase());
                } else {
                    console.warn("No se encontró el elemento con id='estado_info' en el DOM.");
                }
            }
        } catch (error) {
            console.log(error);
        }
    }

    function mostrarAlerta(titulo, mensaje, tipo, color, fondo) {
        Swal.fire({
            title: titulo,
            text: mensaje,
            icon: "success",
            position: "top-end",
            confirmButtonColor: color,
            background: fondo,
        });
    }
});

</script>
