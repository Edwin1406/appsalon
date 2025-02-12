
<link rel="stylesheet" href="/public/build/css/app.css">

<h1 class="nombre-pagina">Agendar</h1>
<p class="descripcion-pagina">Llenar todos los campos </p>
<?php 
// include_once __DIR__. '/../templates/barra.php';
include_once __DIR__. '/../templates/alertas.php';

?>


<form action="/admin/servicios/cliente" method="POST" class="formulario">
            

    
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
        <label for="email">Email</label>
        <input 
            type="email" 
            id="email" 
            placeholder="Tu Email" 
            name="email"
            value=""
        />
    </div>

   
    <input type="submit" value="Crear Cliente" class="boton boton-verde">

</form>




