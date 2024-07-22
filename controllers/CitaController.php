<?php
namespace Controllers;

use MVC\Router;

class CitaController {
    public static function index( Router $router ) {
        session_start();
    // Imprimir los valores de la sesión
    
         debuguear($_SESSION['nombre']);
         debuguear($_SESSION['id']);

        $router->render('cita/index',[
            'id' => $_SESSION['id'],
            'nombre' => $_SESSION['nombre'],
        ]);
    }
}