<h1 class="nombre-pagina">Cliente</h1>

<link rel="stylesheet" href="/public/build/css/app.css">

<h1 class="nombre-pagina">Nuevo Cliente</h1>
< class="descripcion-pagina">Llenar todos los campos para añadir un nuevo Cliente</p>
<?php 
// include_once __DIR__. '/../templates/barra.php';
include_once __DIR__. '/../templates/alertas.php';

?>


<form action="/admin/servicios/crear" method="POST" class="formulario">
            

        <div class="campo">
            <label for="nombre">Nombre:</label>
            <input type="text"
            name="nombre" 
            id="nombre"
            placeholder="Nombre del Servicio"
            value="<?php echo $servicio->nombre; ?>">
        </div>

    <input type="submit" value="Crear Servicio" class="boton boton-verde">

</form>




