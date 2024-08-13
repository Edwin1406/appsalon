<link rel="stylesheet" href="/public/build/css/app.css">

<h1 class="nombre-pagina">Panel de Adminsitración</h1>
<?php



 include_once __DIR__.'/../templates/barra.php' ?>
<h2>Buscar Citas</h2>
<div class="busqueda">
    <form class="formulario">
        <div class="campo">
            <label for="fecha">Fecha:</label>
            <input 
            type="date" 
            id="fecha" 
            name="fecha"
            value="<?php echo $fecha?>"
            >
            
        </div>

    </form>
</div>

<?php 
    if(count($citas)===0){
        echo '<h2 class="text-center">No hay citas</h2>';
    }
    ?>

<div id="citas-admin">
    <ul class="citas">
    <?php 
    $idCita=0;
    foreach($citas as $key => $cita):
        // debuguear($cita);

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
        // $total += $cita->precio;
        ?>
         <!-- <p> - <?php echo $cita->servicio .' '.$cita->precio ?></p> -->
            <p><span>Hora:</span> <?php echo $cita->hora?></p>

        <?php 
        $actual = $cita->id;
        $proximo = $citas[$key+1]->id ?? 0;
        if(esUltimo($actual,$proximo)):?>
            <p class="total"><span>Doctor/a:</span> <?php echo $cita->odontologo?></p>
            <form action="/api/eliminar" method="POST">
                <input type="hidden" name="id" value="<?php echo $cita->id;?>">
                <input type="submit" class="boton-eliminar" value="Eliminar">
              
            </form>
        <?php endif;?>
        
    <?php endforeach;?>
    </ul>
    
    <?php
$business_name = "Tu Negocio";
$phone_number = "593962618083"; // Número de WhatsApp incluyendo el código del país (ej. 593 para Ecuador)
$message = urlencode("Hola, me gustaría más información sobre $business_name.");
$whatsapp_url = "https://wa.me/$phone_number?text=$message";
?>
    <a href="<?php echo $whatsapp_url; ?>" target="_blank">
        <button>Contactar por WhatsApp</button>
    </a>



</div>

<?php 
$script="<script src='public/build/js/buscador.js'></script>";
?>