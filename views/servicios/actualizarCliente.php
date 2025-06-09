

<link rel="stylesheet" href="/public/build/css/app.css">

<h1 class="nombre-pagina">Actualizar Servicios</h1>
<p class="descripcion-pagina">Administracion de Servicios</p>
<?php 
// include_once __DIR__. '/../templates/barra.php';
include_once __DIR__. '/../templates/alertas.php';

?>


<form  method="POST" class="formulario">
    <div class="campo">
        <label for="nombre">Nombre</label>
        <input 
            type="text" 
            id="nombre" 
            placeholder="Nombre del Servicio" 
            name="nombre"
            value="<?php echo $cliente->nombre; ?>"
        />
    </div>

    <!-- apellido -->

    <div class="campo">
        <label for="apellido">Apellido</label>
        <input 
            type="text" 
            id="apellido" 
            placeholder="Apellido del Servicio" 
            name="apellido"
            value="<?php echo $cliente->apellido; ?>"
        />
    </div>
    <div class="campo">
        <label for="telefono">Telefono</label>
        <input 
            type="text" 
            id="telefono" 
            placeholder="Telefono del Servicio" 
            name="telefono"
            value="<?php echo $cliente->telefono; ?>"
        />
    </div>


    <input type="submit" value="Actualizar Servicio" class="boton boton-verde">

</form>
