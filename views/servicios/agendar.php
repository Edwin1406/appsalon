
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
<?php if(isset($_SESSION['mensaje_exito'])): ?>
    <p class="alerta exito"><?php echo $_SESSION['mensaje_exito']; ?></p>
    <?php unset($_SESSION['mensaje_exito']); ?>
<?php endif; ?>

<?php if(isset($_SESSION['mensaje_error'])): ?>
    <p class="alerta error"><?php echo $_SESSION['mensaje_error']; ?></p>
    <?php unset($_SESSION['mensaje_error']); ?>
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
    <label for="servicio">Servicio:</label>
    <select name="servicio" id="servicio" class="formulario__input">
        <option value="" disabled selected>Selecciona un servicio</option>
        <?php foreach ($servicios as $servicio): ?>
            <option value="<?php echo $servicio->id; ?>" data-odontologo="<?php echo $servicio->odontologoid; ?>">
                <?php echo htmlspecialchars($servicio->nombre); ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

<div class="campo">
    <label for="odontologoId">Odontólogo:</label>
    <select name="odontologoId" id="odontologoId" class="formulario__input">
        <option value="" disabled selected>Selecciona un odontólogo</option>
        <?php foreach ($odontologos as $odontologo): ?>
            <option value="<?php echo $odontologo->id; ?>">
                <?php echo htmlspecialchars($odontologo->nombre); ?>
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
<script>
document.addEventListener("DOMContentLoaded", function() {
    const servicioSelect = document.getElementById("servicio");
    const odontologoSelect = document.getElementById("odontologoId");

    servicioSelect.addEventListener("change", function() {
        // Obtener el odontologoId asociado al servicio seleccionado
        const selectedOption = servicioSelect.options[servicioSelect.selectedIndex];
        const odontologoId = selectedOption.getAttribute("data-odontologo");

        if (odontologoId) {
            // Recorrer el select de odontólogos y seleccionar el correcto
            for (let i = 0; i < odontologoSelect.options.length; i++) {
                if (odontologoSelect.options[i].value === odontologoId) {
                    odontologoSelect.selectedIndex = i;
                    break;
                }
            }
        }
    });

    // Disparar el evento manualmente al cargar la página (si ya hay un servicio seleccionado)
    servicioSelect.dispatchEvent(new Event("change"));
});
</script>




