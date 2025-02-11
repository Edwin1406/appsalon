
<div class="campo">
    <label for="nombre">Nombre:</label>
    <input type="text"
     name="nombre" 
     id="nombre"
     placeholder="Nombre del Servicio"
     value="<?php echo $servicio->nombre; ?>">
     >
</div>
<!-- opcion -->

<div class="campo">
    <label for="odontologo">Odontólogo:</label>
    <select name="odontologo" id="odontologo">
        <?php foreach ($odontologos as $odontologo): ?>
            <option value="<?php echo $odontologo->id; ?>" 
                <?php echo $odontologo->id ? 'selected' : ''; ?>>
                <?php echo htmlspecialchars($odontologo->nombre ) ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>





<!-- <div class="campo">
    <label for="precio">Precio:</label>
    <input type="number"
     name="precio" 
     id="precio"
     placeholder="Precio del Servicio"
     value="<?php echo $servicio->precio=0; ?>" disabled>
     >
</div> -->