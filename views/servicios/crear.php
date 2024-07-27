<h1 class="nombre-pagina">Nuevo Servicios</h1>
<p class="descripcion-pagina">Llenar todos los campos para añadir un nuevo Servicio</p>
<h1>nayeli nanalla</h1>
<?php 
// include_once __DIR__. '/../templates/barra.php';
include_once __DIR__. '/../templates/alertas.php';

?>


<form action="/servicios/crear" method="POST" class="formulario">
    <?php include_once __DIR__. '/formulario.php' ?>

    <input type="submit" value="Crear Servicio" class="boton boton-verde">

</form>
