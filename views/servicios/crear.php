<link rel="stylesheet" href="/public/build/css/app.css">

<h1 class="nombre-pagina">Nuevo Servicios</h1>
<p class="descripcion-pagina">Llenar todos los campos para añadir un nuevo Servicio</p>
<?php 
// include_once __DIR__. '/../templates/barra.php';
include_once __DIR__. '/../templates/alertas.php';

?>


<form action="/admin/servicios/crear" method="POST" class="formulario">
    <?php include_once __DIR__. '/formulario.php' ?>

    <input type="submit" value="Crear Servicio" class="boton boton-verde">

</form>
