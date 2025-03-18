<h1 class="nombre-pagina">HISTORIAL DEL PACIENTE</h1>
<p class="descripcion-pagina">     </p>
<?php include_once __DIR__. '/../templates/barra.php' ?>

<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8" />
    <title>Odontograph 1.0.0</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <style>
        body {
            margin: 0px;
            padding: 0px;
        }
    </style>
    <script src="/cdn/js/engine.js" type="text/javascript"></script>
</head>

<body oncontextmenu="return false;">
    <canvas id="canvas" width="648" height="800" crossorigin="anonymous"></canvas>
    <script>
        var canvas = document.getElementById('canvas');

        var engine = new Engine();

        engine.setCanvas(canvas);

        engine.init();

        canvas.addEventListener('mousedown', function (event) {
            engine.onMouseClick(event);
        }, false);

        canvas.addEventListener('mousemove', function (event) {
            engine.onMouseMove(event);
        }, false);

        window.addEventListener('keydown', function (event) {
            engine.onButtonClick(event);
        }, false);

        engine.loadPatientData("New York",
            "Bardur Thomsen",
            "1002",
            "hc 001",
            "26/02/2018",
            "dentist one",
            "Test observations",
            "Test specifications");


    </script>
</body>

</html>