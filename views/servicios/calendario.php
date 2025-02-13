<h1 class="nombre-pagina">Calendario</h1>

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
    gap: 2rem;
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

        @media (max-width: 768px) {

            .fc .fc-toolbar{
                display: block;
            }
        }





</style>

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
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');
    const modal = document.getElementById('modalInfoCita');
    const cerrarModal = document.getElementById('cerrarModal');
    const whatsappButton = document.createElement('button');
    whatsappButton.textContent = 'Enviar WhatsApp';
    whatsappButton.id = 'whatsappButton';
    whatsappButton.style.marginTop = '10px';
    document.querySelector('.modal_contenido').appendChild(whatsappButton);

    fetch('https://odonto.megawebsistem.com/admin/api/apicitaservicio') 
        .then(response => response.json())
        .then(data => {
            const eventos = data.map(cita => ({
                id: cita.cita_id,
                title: cita.nombrecliente + ' - ' + cita.hora,
                start: cita.fecha, 
                extendedProps: {
                    hora: cita.hora,
                    telefono: cita.telefonocliente.startsWith('+') ? cita.telefonocliente : `+593${cita.telefonocliente.replace(/^0/, '')}`, // Asegurar formato internacional
                    doctor: cita.nombreodontologo.trim(),
                    asunto: cita.nombreservicio.trim()
                }
            }));

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
                events: eventos,
                eventClick: function(info) {
                    document.getElementById('nombre_paciente_info').textContent = info.event.title;
                    document.getElementById('fecha_info').textContent = info.event.start.toISOString().split('T')[0];
                    document.getElementById('hora_info').textContent = info.event.extendedProps.hora;
                    document.getElementById('telefono_info').textContent = info.event.extendedProps.telefono;
                    document.getElementById('doctor_info').textContent = info.event.extendedProps.doctor;
                    document.getElementById('asunto_info').textContent = info.event.extendedProps.asunto;
                    
                    const mensaje = `Hola ${info.event.title}, te recordamos tu cita el día ${info.event.start.toISOString().split('T')[0]} a las ${info.event.extendedProps.hora}. Confirma tu asistencia. ¡Gracias!`;
                    const telefono = info.event.extendedProps.telefono;
                    
                    whatsappButton.onclick = function() {
                        const whatsappURL = `https://wa.me/${telefono}?text=${encodeURIComponent(mensaje)}`;
                        window.open(whatsappURL, '_blank');
                    };
                    
                    modal.style.display = 'flex';
                }
            });

            calendar.render();
        });

    cerrarModal.addEventListener('click', function() {
        modal.style.display = 'none';
    });
});
</script>
