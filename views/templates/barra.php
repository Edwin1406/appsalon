<div class="barra">
    <p>Bienvenido: <?php echo $nombre ?? ''; ?></p>
    <a href="/logout" class="boton">Cerrar Session</a>
</div>

<?php if(isset($_SESSION['admin'])): ?>
    <?php debuguear($_SESSION); ?>
    <div class="barra-servicios">
        <a class="boton" href="/admin">Ver Citas</a>
        <a class="boton" href="/admin/servicios">Ver Servicios</a>
        <a class="boton" href="/admin/servicios/crear">Nuevo Servicio</a>
        <a class="boton" href="/admin/servicios/calendario"> Ver Calendario</a>

    </div>
<?php endif; ?>
