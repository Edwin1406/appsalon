<div class="barra">
    <p>Bienvenido: <?php echo $nombre ?? ''; ?></p>
    <a href="/logout" class="boton">Cerrar Session</a>
</div>

<?php
if(isset($_SESSION['admin'])){
    echo ' es admin';

}else{
    echo 'no es admin';
}