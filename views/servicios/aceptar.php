<h1 class="nombre-pagina">Actualizar el estado de la Cita</h1>
<p class="descripcion-pagina">Escoge una Estado</p>
<?php 
// include_once __DIR__. '/../templates/barra.php';
include_once __DIR__. '/../templates/alertas.php';

?>

<form  method="POST" class="formulario">

    <div class="campo">
        <label for="estado">Estado:</label>
        <select name="estado" id="estado">
            <?php if ($aceptar->estado == 'PENDIENTE'): ?>
                <option value="CONFIRMADO">Aceptar</option>
                <option value="CANCELADO">Cancelar</option>
            <?php elseif ($aceptar->estado == 'CONFIRMADO'): ?>
                <option value="CANCELADO">Cancelar</option>
            <?php else: ?>
                <option value="CANCELADO" selected>Cancelado</option>
            <?php endif; ?>
        </select>
    </div>
    <input type="submit" value="Actualizar" class="boton boton-verde">

</form>