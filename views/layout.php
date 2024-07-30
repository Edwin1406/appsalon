<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Aplicación de citas odontologicas">
    <meta name="keywords" content="citas, odontologicas, dentista">
    <meta name="author" content="Edwin Diaz">
    <link rel="shortcut icon" href="public/build/img/dentista.jpg" type="image/x-icon">
    <title>Citas</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;700;900&display=swap" rel="stylesheet"> 
    <!-- <link rel="stylesheet" href="/public/build/css/app.css"> -->
    
</head>
<body>
    
<header class="header">

<div class="contenedor">
    <div class="barra">
        <a class="logo" href="">
        <h1 class="logo__nombre no-margin centrar-texto">New <span class="logo__bold">Dental</span></h1>
        </a>
        <nav class="navegacion">
          <a href="" class="navegacion__enlace">Nosotros</a>
          <a href="" class="navegacion__enlace">Cursos</a>
          <a href="" class="navegacion__enlace"> Contacto</a>
        </nav>
     
    </div>
</div>
<div class="header__texto">
    <h2 class="no-margin">¡Te ayudamos para que tu sonrisa esté siempre perfecta!</h2>
<p class="no-margin">Inicio || Precios Tabacundo</p>
</div>


</header>
    <div class="contenedor-app">
        <div class="imagen"></div>
        <div class="app">
            <?php echo $contenido; ?>
        </div>

    </div>
    <?php echo $script ?? ''; ?>

           
</body>
</html>