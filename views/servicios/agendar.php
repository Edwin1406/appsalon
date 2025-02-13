
<link rel="stylesheet" href="/public/build/css/app.css">

<h1 class="nombre-pagina">Agendar</h1>
<p class="descripcion-pagina">Llenar todos los campos </p>
<?php 
// include_once __DIR__. '/../templates/barra.php';
include_once __DIR__. '/../templates/alertas.php';

?>

<style>
 .campo{
    margin-bottom: 1rem;
}

select{
    width: 100%;
    padding: 1rem;
    font-size: 1.5rem;
    border-radius: .5rem;
    border: 1px solid #e1e1e1;
}


</style>

    <!-- moestrar el mensaje exito porqe en la l tengo respesta = 1  https://odonto.megawebsistem.com/admin/servicios/agendar?resultado=1 -->
    <?php if(isset($_GET['resultado']) && $_GET['resultado'] == 1): ?>
        <p class="alerta exito">Cita creada correctamente</p>
    <?php endif; ?>
    



<form action="/admin/servicios/agendar" method="POST" class="formulario">

    <div class="campo">
        <label for="usuarioId">Cliente:</label>
        <select name="usuarioId" id="usuarioId" class="formulario__input">
            <?php foreach ($usuarios as $usuario): ?>
                <option value="<?php echo $usuario->id; ?>">
                    <?php echo htmlspecialchars($usuario->nombre ) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="campo">
        <label for="servicios">Servicios:</label>
        <select name="servicios[]" id="servicios" class="formulario__input" multiple>
            <?php foreach ($servicios as $servicio): ?>
                <option value="<?php echo $servicio->id; ?>">
                    <?php echo htmlspecialchars($servicio->nombre ) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <p>Presiona Ctrl (Windows) o Cmd (Mac) para seleccionar múltiples opciones</p>
    </div>

    <div class="campo">
        <label for="odontologoId">Odontólogo:</label>
        <select name="odontologoId" id="odontologoId" class="formulario__input">
            <?php foreach ($odontologos as $odontologo): ?>
                <option value="<?php echo $odontologo->id; ?>">
                    <?php echo htmlspecialchars($odontologo->nombre ) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="campo">
        <label for="fecha">Fecha</label>
        <input type="date" id="fecha" name="fecha" required />
    </div>

    <div class="campo">
        <label for="hora">Hora</label>
        <select id="hora" name="hora" required>
            <?php 
            $horas = ["10:00", "10:30", "11:00", "11:30", "12:00", "12:30",
                      "13:00", "13:30", "14:00", "14:30", "15:00", "15:30",
                      "16:00", "16:30", "17:00", "17:30", "18:00", "18:30",
                      "19:00", "19:30", "20:00", "20:30", "21:00", "21:30", "22:00"];
            foreach ($horas as $hora): ?>
                <option value="<?php echo $hora; ?>"><?php echo $hora; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <input type="submit" value="Agendar Cita" class="boton boton-verde">
</form>




