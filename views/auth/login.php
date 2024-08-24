<div class="contenedor login">
    <div class="contenedor-sm">
    <h2 class="auth__heading"><?php echo $titulo ?? '' ?></h2>
    <p class="auth__texto">Inicia Sesion en Sitio Web </p>
        <?php include_once __DIR__ . '/../templates/alertas.php' ?>

        <form class="formulario"  method="POST">
            <div class="campo">
                <label for="email">Email</label>
                <input 
                    type="email" 
                    name="email" 
                    id="email" 
                    placeholder="Tu Email">
            </div>
            <div class="campo">
                <label for="password">Password</label>
                <input 
                    type="password" 
                    name="password" 
                    id="password" 
                    placeholder="Tu Password">
            </div>
            <input type="submit" class="boton boton-verde" value="Iniciar Sesión">

        </form>
<div class="acciones">
    <a href="/crear-cuenta">¿No tienes cuenta? Regístrate</a>
    <a href="/olvide">¿Olvidaste tu contraseña?</a>
</div>
</div>