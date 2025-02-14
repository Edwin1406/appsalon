
<link rel="stylesheet" href="/public/build/css/app.css">

<h1 class="nombre-pagina">Nuevo Odontologo</h1>
<p class="descripcion-pagina">Llenar todos los campos para añadir un nuevo odontologo</p>
<?php 
// include_once __DIR__. '/../templates/barra.php';
include_once __DIR__. '/../templates/alertas.php';

?>


<form action="/admin/servicios/odontologo" method="POST" class="formulario">
            

<div class="campo">
        <label for="nombre">Nombre</label>
        <input 
            type="text" 
            id="nombre" 
            placeholder="Nombre Odontologo" 
            name="nombre"
            value="<?php echo s($odontologo->nombre); ?>"
        />
    </div>
   

   
    <input type="submit" value="Crear Odontologo" class="boton boton-verde">

</form>




