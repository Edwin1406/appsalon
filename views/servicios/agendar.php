
<link rel="stylesheet" href="/public/build/css/app.css">

<h1 class="nombre-pagina">Agendar</h1>
<p class="descripcion-pagina">Llenar todos los campos </p>
<?php 
// include_once __DIR__. '/../templates/barra.php';
include_once __DIR__. '/../templates/alertas.php';

?>


<form action="/admin/servicios/cliente" method="POST" class="formulario">
            

    
    <div class="campo">
        <label for="nombre">Cliente:</label>
        <select name="nombre" id="nombre" class="formulario__input">
            <?php foreach ($usuarios as $usuario): ?>
                <option value="<?php echo $usuario->id; ?>" 
                    <?php echo $usuario->id ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($usuario->nombre ) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <div class="campo">
        <label for="nombre">Servicio:</label>
        <select name="nombre" id="nombre" class="formulario__input">
            <?php foreach ($servicios as $servicio): ?>
                <option value="<?php echo $servicio->id; ?>" 
                    <?php echo $servicio->id ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($servicio->nombre ) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    
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

        <div class="campo">
            <label for="fecha">Fecha</label>
            <input 
                type="date" 
                id="fecha" 
                name="fecha"
                value=""
            />
        </div>



        <div class="campo">
    <label for="hora">Hora</label>
    <select id="hora" name="hora">
        <option value="10:00">10:00</option>
        <option value="10:30">10:30</option>
        <option value="11:00">11:00</option>
        <option value="11:30">11:30</option>
        <option value="12:00">12:00</option>
        <option value="12:30">12:30</option>
        <option value="13:00">13:00</option>
        <option value="13:30">13:30</option>
        <option value="14:00">14:00</option>
        <option value="14:30">14:30</option>
        <option value="15:00">15:00</option>
        <option value="15:30">15:30</option>
        <option value="16:00">16:00</option>
        <option value="16:30">16:30</option>
        <option value="17:00">17:00</option>
        <option value="17:30">17:30</option>
        <option value="18:00">18:00</option>
        <option value="18:30">18:30</option>
        <option value="19:00">19:00</option>
        <option value="19:30">19:30</option>
        <option value="20:00">20:00</option>
        <option value="20:30">20:30</option>
        <option value="21:00">21:00</option>
        <option value="21:30">21:30</option>
        <option value="22:00">22:00</option>
    </select>
</div>



   
    <input type="submit" value="Crear Cliente" class="boton boton-verde">

</form>




