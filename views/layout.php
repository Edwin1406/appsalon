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
    <link rel="stylesheet" href="/public/build/css/app.css">
    
</head>
<body>
    
<?php 
        include_once __DIR__ .'/templates/header.php';
        echo $contenido;
        include_once __DIR__ .'/templates/footer.php'; 
    ?>
    <?php echo $script ?? ''; ?>

           
</body>
</html>