<?php
require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$db = mysqli_connect(
$_ENV['BD_HOST'], 
$_ENV['BD_USER'], 
$_ENV['BD_PASS'],
$_ENV['DB_NAME'],
);


if (!$db) {
    echo "Error: No se pudo conectar a MySQL.";
    echo "errno de depuración: " . mysqli_connect_errno();
    echo "error de depuración: " . mysqli_connect_error();
    exit;
}
