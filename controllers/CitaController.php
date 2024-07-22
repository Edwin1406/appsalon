<?php
namespace Controllers;

use MVC\Router;

class CitaController {
    public static function index( Router $router ) {
        session_start();
    // Imprimir los valores de la sesión
    echo "<pre>";
    print_r($_SESSION);
    echo "</pre>";
        $router->render('cita/index',[
            'id' => $_SESSION['id'],
            'nombre' => $_SESSION['nombre'],
        ]);
    }
}