<h1 class="nombre-pagina">Olvidaste contraseña</h1>
<p class="descripcion-pagina">Restablece tu password escribiendo tu Email a continuación</p>
<?php include_once __DIR__. '/../templates/alertas.php'; ?> 

<form class="formulario" method="POST" action="/olvide">
    <div class="campo">
        <label for="email">Email</label>
        <input 
            type="email" 
            id="email" 
            placeholder="Tu Email" 
            name="email"
        />
    </div>
    <input type="submit" class="boton boton-verde" value="Restablecer Contraseña">
</form>

<div class="acciones">
    <a href="/">¿Ya tienes cuenta? Inicia Sessión</a>
    <a href="/crear-cuenta">¿Aún no tienes una cuenta? Crea una</a>
</div>