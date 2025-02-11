
<div class="campo">
    <label for="nombre">Nombre:</label>
    <input type="text"
     name="nombre" 
     id="nombre"
     placeholder="Nombre del Servicio"
     value="<?php echo $servicio->nombre; ?>">
</div>
<!-- opcion -->

<style>
.formulario__input{
    padding: 1rem;
    font-size: 1.5rem;
    border-radius: .5rem;
    border: 1px solid #e1e1e1;
    width: 100%;
}
    
</style>


<div class="campo">
    <label for="odontologoId">Odontólogo:</label>
    <select name="odontologoId" id="odontologoId" class="formulario__input">
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