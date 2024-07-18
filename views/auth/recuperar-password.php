<h1 class="nombre-pagina"> Recuperar Password</h1>
<p class="descripcion-pagina">Coloca tu nueva contraseña</p>

<form class="formulario" method="POST">
    <?php include_once __DIR__. '/../templates/alertas.php'; ?> 
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