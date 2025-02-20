<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Aplicación de citas odontologicas">
    <meta name="keywords" content="citas, odontologicas, dentista, pacientes, doctores, clinica, salud">
    <meta name="author" content="Edwin Diaz">
    <link rel="shortcut icon" href="/public/build/img/dentista.jpg" type="image/x-icon">
    <title>Citas</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;700;900&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="/public/build/css/app.css">

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/locales/es.global.min.js"></script> -->
    
</head>
<body>
    
    <div class="contenedor-app">
        
        <div class="imagen"></div>
        <div class="app">
            <?php echo $contenido; ?>
        </div>

    </div>
    <?php echo $script ?? ''; ?>

           
</body>
</html>