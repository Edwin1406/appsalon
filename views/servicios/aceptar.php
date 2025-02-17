<div class="campo">
    <label for="estado">Estado:</label>
    <select name="estado" id="estado">
        <option value="pendiente" <?php echo ($aceptar->estado == 'pendiente') ? 'selected' : ''; ?>>Pendiente</option>
        <option value="aceptado" <?php echo ($aceptar->estado == 'aceptado') ? 'selected' : ''; ?>>Aceptado</option>
        <option value="cancelado" <?php echo ($aceptar->estado == 'cancelado') ? 'selected' : ''; ?>>Cancelado</option>
    </select>
</div>
