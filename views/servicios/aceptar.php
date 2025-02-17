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

