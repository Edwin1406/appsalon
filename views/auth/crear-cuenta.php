<h1 class="nombre-pagina">Crear cuenta</h1>
<p class="descripcion-pagina">LLena el siguiente formulario para crear una cuenta</p>


<!-- alertas -->
 <?php
 include_once __DIR__. '/views/templates/alertas.php';
 ?>

<form class="formulario" method="POST" action="/crear-cuenta">
    <div class="campo">
        <label for="nombre">Nombre</label>
        <input 
            type="text" 
            id="nombre" 
            placeholder="Tu Nombre" 
            name="nombre"
            value="<?php echo s($usuario->nombre); ?>"
        />
    </div>
    <div class="campo">
        <label for="apellido">Apellido</label>
        <input 
            type="text" 
            id="apellido" 
            placeholder="Tu Apellido" 
            name="apellido"
            value="<?php echo s($usuario->apellido); ?>"
        />
    </div>
    <div class="campo">
        <label for="telefono">Telefono</label>
        <input 
            type="tel" 
            id="telefono" 
            placeholder="Tu Telefono" 
            name="telefono"
            value="<?php echo s($usuario->telefono); ?>"
        />
    </div>
    <div class="campo">
        <label for="email">Email</label>
        <input 
            type="email" 
            id="email" 
            placeholder="Tu Email" 
            name="email"
            value="<?php echo s($usuario->email); ?>"
        />
    </div>
    <div class="campo">
        <label for="password">Password</label>
        <input 
            type="password" 
            id="password" 
            placeholder="Tu Password" 
            name="password"

            />
    </div>
    <input type="submit" class="boton boton-verde" value="Crear Cuenta">

</form>
<div class="acciones">
    <a href="/">¿Ya tienes cuenta? Inicia Sessión</a>
    <a href="/olvide">¿Olvidaste tu contraseña?</a>
</div>