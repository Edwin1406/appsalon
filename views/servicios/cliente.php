
<link rel="stylesheet" href="/public/build/css/app.css">

<h1 class="nombre-pagina">Nuevo Cliente</h1>
<p class="descripcion-pagina">Llenar todos los campos para añadir un nuevo Cliente</p>
<?php 
// include_once __DIR__. '/../templates/barra.php';
include_once __DIR__. '/../templates/alertas.php';

?>


<style>
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
</style>

<div class="contenido_ir">

    <div class="dashboard__contenedor-boton">
        <a class="dashboard__boton" href="/admin/servicios/verclientes">
            <i class="fa-solid fa-circle-arrow-left"></i>
            VER CLIENTE
        </a>
        
    </div>
</div>


<form action="/admin/servicios/cliente" method="POST" class="formulario">
            

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




