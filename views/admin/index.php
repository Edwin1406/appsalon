<h1 class="nombre-pagina">Panel de Adminsitración</h1>
<?php include_once __DIR__.'/../templates/barra.php' ?>
<div class="busqueda">
    <form class="formulario">
        <div class="campo">
            <label for="fecha">Fecha:</label>
            <input 
            type="date" 
            id="fecha" 
            name="fecha">
        </div>

    </form>
</div>
<div id="citas-admin"></div>