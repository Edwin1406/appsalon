<link rel="stylesheet" href="/public/build/css/app.css">

<h1 class="nombre-pagina">Panel de Adminsitración</h1>
<?php



include_once __DIR__ . '/../templates/barra.php' ?>
<h2>Buscar Citas</h2>
<div class="busqueda">
    <form class="formulario">
        <div class="campo">
            <label for="fecha">Fecha:</label>
            <input
                type="date"
                id="fecha"
                name="fecha"
                value="<?php echo $fecha ?>">

        </div>

    </form>
</div>

<?php
if (count($citas) === 0) {
    echo '<h2 class="text-center">No hay citas</h2>';
}
?>

<div id="citas-admin">
    <ul class="citas">
        <?php
        $idCita = 0;
        foreach ($citas as $key => $cita):
            // debuguear($cita);

            if ($idCita != $cita->id):
                $total = 0;


        ?>
                <h3>Información del Cliente</h3>
                <li class="cita">
                    <p class="cita-titulo">ID:<?php echo $cita->id ?></p>
                    <p><span>Cliente:</span> <?php echo $cita->cliente ?></p>
                    <p><span>Email:</span> <?php echo $cita->email ?></p>
                    <p><span>Telefono:</span> <?php echo $cita->telefono ?></p>
                    <p><span>Fecha:</span> <?php echo $cita->fecha ?></p>
                    <p><span>Estado:</span> <?php echo $cita->estado ?></p>
                    <h3>Servicios</h3>

                <?php $idCita = $cita->id;
            endif;
            // $total += $cita->precio;
                ?>
                <!-- <p> - <?php echo $cita->servicio . ' ' . $cita->precio ?></p> -->
                <p><span>Hora:</span> <?php echo $cita->hora ?></p>

                <?php
                $actual = $cita->id;
                $proximo = $citas[$key + 1]->id ?? 0;
                if (esUltimo($actual, $proximo)): ?>
                    <p class="total"><span>Doctor/a:</span> <?php echo $cita->odontologo ?></p>
                    <form action="/api/eliminar" method="POST">
                        <input type="hidden" name="id" value="<?php echo $cita->id; ?>">
                        <input type="submit" class="boton-eliminar" value="Eliminar">

                    </form>
                    <?php
                    // Establecer la zona horaria de Ecuador
                    date_default_timezone_set('America/Guayaquil');

                    // Crear un objeto DateTime para la fecha de la cita
                    $date = new DateTime($cita->fechas_whats);
                    $time = new DateTime($cita->hora);

                    // Formatear la fecha como "martes 13 de agosto del 2024"
                    $formatter = new IntlDateFormatter(
                        'es_ES',
                        IntlDateFormatter::FULL,
                        IntlDateFormatter::NONE,
                        'America/Guayaquil',
                        IntlDateFormatter::GREGORIAN
                    );
                    $appointment_date = $formatter->format($date);

                    // Formatear la hora como "10:00 AM"
                    $appointment_time = $time->format('g:i A');

                    // Eliminar el cero del teléfono
                    $telefono_sin_cero = ltrim($cita->telefono, '0');
                    $business_name = "DENTAL ÁLVAREZ"; // Nombre de tu negocio)";
                    $client_name = $cita->cliente; // Asume que $cita->nombre contiene el nombre del cliente
                    $phone_number = $telefono_sin_cero; // Número de WhatsApp incluyendo el código del país (ej. 593 para Ecuador)

                    // Obtener la hora actual del servidor en la zona horaria de Ecuador
                    $current_hour = date('H');

                    // Determinar saludo dependiendo de la hora actual
                    if ($current_hour < 12) {
                        $saludo = "Buenos días";
                    } elseif ($current_hour < 18) {
                        $saludo = "Buenas tardes";
                    } else {
                        $saludo = "Buenas noches";
                    }

                    // Crear el mensaje para WhatsApp
                    $message = urlencode("$saludo $client_name, te saludamos de $business_name (lugar). Te recordamos que tienes una cita el día $appointment_date a las $appointment_time. Por favor, responde a este mensaje confirmando tu asistencia. ¡Te esperamos!");

                    $whatsapp_url = "https://wa.me/$phone_number?text=$message";
                    ?>
                    <a class="boton-whatsapp" href="<?php echo $whatsapp_url; ?>" target="_blank">
                        Enviar mensaje de WhatsApp
                    </a>

                <?php endif; ?>

            <?php endforeach; ?>









    </ul>
</div>

<?php
$script = "<script src='public/build/js/buscador.js'></script>";
?>