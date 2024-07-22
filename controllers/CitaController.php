<?php
namespace Controllers;

use MVC\Router;

class CitaController {
    public static function index( Router $router ) {
        session_start();
    // Imprimir los valores de la sesión
        $id= $_SESSION['id'];
    // debuguear($_SESSION['id']);
        $router->render('cita/index',[
            'id' => $id,
            'nombre' => $_SESSION['nombre'],
        ]);
    }
}