<link rel="stylesheet" href="/public/build/css/app.css">

<h1 class="nombre-pagina">Crear nueva cita</h1>
<p class="descripcion-pagina">Elige tus servicios y coloca tus datos</p>
<!-- cerrar Sesion -->
<?php include_once __DIR__ . '/../templates/barra.php' ?>

<div id="app">
    <nav class="tabs">
        <button class="actual" type="button" data-paso="1">Servicios</button>
        <button type="button" data-paso="2">Informacion cita</button>
        <button type="button" data-paso="3">Resumen</button>

    </nav>

    <div id="paso-1" class="seccion">
        <h2>servicios</h2>
        <p class="text-center">Elige tus servicios a continuación</p>
        <div id="servicios" class="lista-servicios">Doctor/a: </div>
    </div>

    <div id="paso-2" class="seccion">
        <h2>Tus datos y cita</h2>
        <p class="text-center">Coloca tus datos y fecha de tu cita</p>
        <form class="formulario">
            <div class="campo">
                <label for="nombre">Nombre</label>
                <input
                    type="text"
                    id="nombre"
                    placeholder="Tu nombre"
                    value="<?php echo $nombre; ?>"
                    disabled />
            </div>

            <div class="campo">
                <label for="fecha">Fecha</label>
                <input
                    type="date"
                    id="fecha"
                    placeholder="Tu fecha"
                    min="<?php echo date('Y-m-d'); ?>" />
            </div>
            <!-- 
            <div class="campo">
                <label for="hora">Hora</label>
                <input type="time" id="hora" placeholder="Tu hora" list="horasDisponibles" />
                <datalist id="horasDisponibles"></datalist>
            </div> -->

            <div class="campo">
                <label for="hora">Hora</label>
                <select id="hora">
                    <option value="" selected disabled>Selecciona una hora</option>
                </select>
            </div>

    <style>

        #hora{
            padding: 1rem;
            font-size: 1.5rem;
            border-radius: .5rem;
            border: 1px solid #e1e1e1;
            width: 100%;
        }

    </style>

            <input type="hidden" id="id" value="<?php echo $id; ?>">
        </form>

    </div>

    <div id="paso-3" class="seccion contenido-resumen">
        <h2>Resumen</h2>
        <p class="text-center">Verifica si la información sea correcta</p>

    </div>

    <div class="paginacion">
        <button
            id="anterior"
            type="button"
            class="boton">
            &laquo; Anterior</button>

        <button
            id="siguiente"
            type="button"
            class="boton">&raquo; Siguiente</button>
    </div>


</div>
<?php
$script = '
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/public/build/js/app.js"></script>';
?>