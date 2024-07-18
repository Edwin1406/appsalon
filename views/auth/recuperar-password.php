<h1 class="nombre-pagina"> Recuperar Password</h1>
<p class="descripcion-pagina">Coloca tu nueva contraseña</p>

<?php include_once __DIR__. '/../templates/alertas.php'; ?> 
<?php if($error) return ;?>
<form class="formulario" method="POST">
    <div class="campo">
        <label for="password">Password</label>
        <input 
            type="password" 
            id="password" 
            placeholder="Tu Password" 
            name="password"
            />
    </div>
    <div class="campo">
        <label for="confirmar">Confirmar Password</label>
        <input 
            type="password" 
            id="confirmar" 
            placeholder="Repite tu Password" 
            name="confirmar"
            />
    </div>
    <input type="submit" class="boton boton-verde" value="Cambiar Password">

</form>

<div class="acciones">
    <a href="/">¿Ya tienes cuenta? Inicia Sessión</a>
    <a href="/crear-cuenta">¿Aún no tienes una cuenta? Crea una</a>
</div>