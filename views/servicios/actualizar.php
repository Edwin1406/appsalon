<link rel="stylesheet" href="/public/build/css/app.css">

<h1 class="nombre-pagina">Actualizar Servicios</h1>
<p class="descripcion-pagina">Administracion de Servicios</p>
<?php 
// include_once __DIR__. '/../templates/barra.php';
include_once __DIR__. '/../templates/alertas.php';

?>


<form  method="POST" class="formulario">
    <?php include_once __DIR__. '/formulario.php' ?>

    <input type="submit" value="Actualizar Servicio" class="boton boton-verde">

</form>
