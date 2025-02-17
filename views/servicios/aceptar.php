<div class="campo">
    <label for="estado">Estado:</label>
    <select name="estado" id="estado">
        <option value="pendiente" <?php echo ($aceptar->estado == 'PENDIENTE') ? 'selected' : ''; ?>>Pendiente</option>
        <option value="aceptado" <?php echo ($aceptar->estado == 'CONFIRMADO') ? 'selected' : ''; ?>>Aceptado</option>
        <option value="cancelado" <?php echo ($aceptar->estado == 'CANCELADO') ? 'selected' : ''; ?>>Cancelado</option>
    </select>
</div>
