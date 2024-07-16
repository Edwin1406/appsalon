<?php

$db = mysqli_connect('localhost', 'u504036119_proyecto', 'Edwin19982.', 'u504036119_proyecto');


if (!$db) {
    echo "Error: No se pudo conectar a MySQL.";
    echo "errno de depuración: " . mysqli_connect_errno();
    echo "error de depuración: " . mysqli_connect_error();
    exit;
}
