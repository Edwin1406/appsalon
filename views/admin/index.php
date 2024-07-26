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
    foreach($citas as $key => $cita):
        // debuguear($key);

    if($idCita != $cita->id):
        $total=0;
        

    ?>
            <h3>Información del Cliente</h3>
        <li class="cita">
            <p class="cita-titulo">ID:<?php echo $cita->id?></p>
            <p><span>Cliente:</span> <?php echo $cita->cliente?></p>
            <p><span>Email:</span> <?php echo $cita->email?></p>
            <p><span>Telefono:</span> <?php echo $cita->telefono?></p>
            <h3>Servicios</h3>
           
        <?php $idCita = $cita->id; 
        endif;
        $total += $cita->precio;
        ?>
         <p> - <?php echo $cita->servicio .' '.$cita->precio ?></p>
            <p><span>Hora:</span> <?php echo $cita->hora?></p>

        <?php 
        $actual = $cita->id;
        $proximo = $citas[$key+1]->id ?? 0;
        if(esUltimo($actual,$proximo)):?>
            <p class="total"><span>Total:</span> <?php echo $total?></p>
        <?php endif;?>
        
    <?php endforeach;?>
    </ul>
    
</div>