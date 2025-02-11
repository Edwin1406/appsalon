<h1 class="nombre-pagina">Calendario</h1>
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

            // Cargar los eventos desde la API
            fetch('https://megawebsistem.com/admin/api/citas')
                .then(response => response.json())
                .then(data => {
                    const eventos = data.map(cita => ({
                        id: cita.id,
                        title: cita.nombre_paciente + ' - ' + cita.hora,
                        start: cita.fecha,  // Solo se usa la fecha, sin hora
                        extendedProps: {
                            hora: cita.hora,
                            telefono: cita.telefono,
                            doctor: cita.doctor,
                            asunto: cita.asunto
                        }
                    }));


                    // Crear el calendario con los eventos transformados
                    const calendar = new FullCalendar.Calendar(calendarEl, {
                        initialView: 'dayGridMonth',
                        locale: 'es',  // Idioma en español
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
                            // Mostrar datos en el modal
                            document.getElementById('nombre_paciente_info').textContent = info.event.title;
                            document.getElementById('fecha_info').textContent = info.event.start.toISOString().split('T')[0];
                            document.getElementById('hora_info').textContent = info.event.extendedProps.hora;
                            document.getElementById('telefono_info').textContent = info.event.extendedProps.telefono;
                            document.getElementById('doctor_info').textContent = info.event.extendedProps.doctor;
                            document.getElementById('asunto_info').textContent = info.event.extendedProps.asunto;

                            modal.style.display = 'flex';
                        }
                    });

                    calendar.render();
                });

            // Cerrar el modal
            cerrarModal.addEventListener('click', function() {
                modal.style.display = 'none';
            });
        });
    </script>

