<?php
if(is_array($alertas)){
foreach( $alertas as $key => $mensajes):
    foreach($mensajes as $mensaje):
?>
    <div class="alerta <?php echo $key;?>">
        <?php echo $mensaje;?>
    </div>


<?php
    endforeach;
endforeach;
}else{
    echo $alertas;
}
?>