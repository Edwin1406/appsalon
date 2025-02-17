<div class="campo">
    <label for="estado">Estado:</label>
    <select name="estado" id="estado">
        <option value="PENDIENTE" <?php echo ($aceptar->estado == 'PENDIENTE') ? 'selected' : ''; ?>>Pendiente</option>
        <option value="CONFIRMADO" <?php echo ($aceptar->estado == 'CONFIRMADO') ? 'selected' : ''; ?>>Aceptado</option>
        <option value="CANCELADO" <?php echo ($aceptar->estado == 'CANCELADO') ? 'selected' : ''; ?>>Cancelado</option>
    </select>
</div>
