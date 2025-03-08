<?php

// $db = mysqli_connect(
// $_ENV['BD_HOST'], 
// $_ENV['BD_USER'], 
// $_ENV['BD_PASS'],
// $_ENV['DB_NAME'],
// );

// $db->set_charset("utf8");

// if (!$db) {
//     echo "Error: No se pudo conectar a MySQL.";
//     echo "errno de depuración: " . mysqli_connect_error();
//     echo "error de depuración: " . mysqli_connect_error();
//     exit;
// }



// Detectar el subdominio
$host = $_SERVER['HTTP_HOST'];
$subdominio = explode('.', $host)[0];

// Cargar credenciales desde el .env
$env = parse_ini_file(__DIR__ . '/../includes/.env');

// Seleccionar la BD correcta
if ($subdominio == "sas") {
    $db_host = $env['BD_HOST_SAS'];
    $db_user = $env['BD_USER_SAS'];
    $db_pass = $env['BD_PASS_SAS'];
    $db_name = $env['BD_NAME_SAS'];
} elseif ($subdominio == "odonto") {
    $db_host = $env['BD_HOST_ODONTO'];
    $db_user = $env['BD_USER_ODONTO'];
    $db_pass = $env['BD_PASS_ODONTO'];
    $db_name = $env['BD_NAME_ODONTO'];
} else {
    die("Error: Clínica no registrada.");
}

// Conectar a la base de datos
$db = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$db) {
    die("Error: No se pudo conectar a MySQL. " . mysqli_connect_error());
}

$db->set_charset("utf8");

