<?php
namespace Controllers;

use MVC\Router;

class CitaController {
    public static function index( Router $router ) {
        session_start();
    // Imprimir los valores de la sesión
    
            debuguear($_SESSION['id']);
         debuguear($_SESSION['nombre']);

        $router->render('cita/index',[
            'nombre' => $_SESSION['nombre'],
            'id' => $_SESSION['id'],
        ]);
    }
}