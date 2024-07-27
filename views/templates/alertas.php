<!-- <?php

foreach( $alertas as $key => $mensajes):
    foreach($mensajes as $mensaje):
?>
    <div class="alerta <?php echo $key;?>">
        <?php echo $mensaje;?>
    </div>


<?php
    endforeach;
endforeach;

?> -->

<?php
// Asegúrate de que $alertas sea un array antes de usar foreach
if (is_array($alertas)) {
    foreach ($alertas as $key => $mensaje) {
        echo "<div class='alerta $key'>$mensaje</div>";
    }
} else {
    // Maneja el caso en que $alertas no sea un array
    echo "<div class='alerta error'>No hay alertas para mostrar</div>";
}
?>
