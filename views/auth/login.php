<link rel="stylesheet" href="/public/build/css/app.css">

<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Inicia Sesión con tus datos</p>
<?php include_once __DIR__. '/../templates/alertas.php'; ?> 

<form class="formulario" method="POST" action="/">
    <div class="campo">
        <label for="email">Email</label>
        <input 
            type="email" 
            id="email" 
            placeholder="Tu Email" 
            name="email"
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
    <input type="submit" class="boton boton-verde" value="Iniciar Sesión">
</form>
<div class="acciones">
    <a href="/crear-cuenta">¿No tienes cuenta? Regístrate</a>
    <a href="/olvide">¿Olvidaste tu contraseña?</a>
</div>