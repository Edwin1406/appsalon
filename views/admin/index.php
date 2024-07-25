<h1 class="nombre-pagina">Panel de Adminsitración</h1>
<?php

use Model\Cita;

 include_once __DIR__.'/../templates/barra.php' ?>
<h2>Buscar Citas</h2>
<div class="busqueda">
    <form class="formulario">
        <div class="campo">
            <label for="fecha">Fecha:</label>
            <input 
            type="date" 
            id="fecha" 
            name="fecha">
        </div>

    </form>
</div>
<div id="citas-admin">
    <ul class="citas">
    <?php 
    $idCita=0;
    foreach($citas  as $cita):
    if($idCita != $cita->id):
        
        $idCita = $cita->id;
    ?>
        <li class="cita">
            <h3>Información del Cliente</h3>
            <p class="cita-titulo">ID:<?php echo $cita->id?></p>
            <p><span>Cliente:</span> <?php echo $cita->cliente?></p>
            <p><span>Email:</span> <?php echo $cita->email?></p>
            <p><span>Telefono:</span> <?php echo $cita->telefono?></p>
            <h3>Servicios</h3>
            <p><span>Servicio:</span> <?php echo $cita->servicio?></p>
            <p><span>Hora:</span> <?php echo $cita->hora?></p>
            <p><span>Precio:</span> $<?php echo $cita->precio?></p>
        <?php endif;?>
        </li>
    <?php endforeach;?>
    </ul>
    
</div>