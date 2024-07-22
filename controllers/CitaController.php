<?php
namespace Controllers;

use MVC\Router;

class CitaController {
    public static function index( Router $router ) {
        session_start();
        error_log("Session ID: " . session_id());
    error_log("Session variables: " . print_r($_SESSION, true));
        $router->render('cita/index',[
            'id' => $_SESSION['id'],
            'nombre' => $_SESSION['nombre'],
        ]);
    }
}