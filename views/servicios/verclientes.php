
<h1 class="nombre-pagina">Cliente</h1>
<p class="descripcion-pagina">Administracion de clientes</p>
<?php include_once __DIR__. '/../templates/barra.php' ?>

<ul class="servicios">
    <?php foreach ($clientes as $cliente):?>
        <li>
            <p> Nombre : <span> <?php echo $cliente->nombre?></span></p>
            
            <div class="acciones">
                <a  class="boton" href="/admin/servicios/actualizarcliente?id=<?php echo $cliente->id ?>">Actualizar</a>

            <form action="/admin/servicios/eliminar" method="POST">
                <input type="hidden" name="id" value="<?php echo $cliente->id?>">
                <input type="submit" value="Eliminar" class="boton-eliminar">
            </form>
            </div>
        </li>
    <?php endforeach?>

</ul>