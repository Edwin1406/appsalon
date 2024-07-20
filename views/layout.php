<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Aplicación de citas odontologicas">
    <meta name="keywords" content="citas, odontologicas, dentista">
    <meta name="author" content="Edwin Diaz">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    <meta name="revisit-after" content="1 days">
    <meta name="language" content="Spanish">
    <meta name="classification" content="Business">
    <meta name="distribution" content="Global">
    <meta name="rating" content="General">
    <meta name="theme-color" content="#000000">
    <meta name="googlebot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <meta name="bingbot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Citas">
    <meta name="application-name" content="Citas">
    <meta name="msapplication-TileColor" content="#000000">
    <meta name="msapplication-config" content="browserconfig.xml">
    <meta name="theme-color" content="#000000">
    <meta name="mobile-web-app-capable" content="yes">
    <title>Citas</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;700;900&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="public/build/css/app.css">
    
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