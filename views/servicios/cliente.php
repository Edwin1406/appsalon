
<link rel="stylesheet" href="/public/build/css/app.css">

<h1 class="nombre-pagina">Nuevo Cliente</h1>
<p class="descripcion-pagina">Llenar todos los campos para añadir un nuevo Cliente</p>
<?php 
// include_once __DIR__. '/../templates/barra.php';
include_once __DIR__. '/../templates/alertas.php';

?>


<form action="/admin/servicios/crear" method="POST" class="formulario">
            

<div class="campo">
        <label for="nombre">Nombre</label>
        <input 
            type="text" 
            id="nombre" 
            placeholder="Tu Nombre" 
            name="nombre"
            value=""
        />
    </div>
    <div class="campo">
        <label for="apellido">Apellido</label>
        <input 
            type="text" 
            id="apellido" 
            placeholder="Tu Apellido" 
            name="apellido"
            value=""
        />
    </div>
    <div class="campo">
        <label for="telefono">Telefono</label>
        <input 
            type="tel" 
            id="telefono" 
            placeholder="Tu Telefono" 
            name="telefono"
            value=""
        />
    </div>
    <div class="campo">
        <label for="email">Email</label>
        <input 
            type="email" 
            id="email" 
            placeholder="Tu Email" 
            name="email"
            value=""
        />
    </div>

   
    <input type="submit" value="Crear Cliente" class="boton boton-verde">

</form>




