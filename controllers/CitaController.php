<?php
namespace Controllers;

use MVC\Router;

class CitaController {
    public static function index( Router $router ) {
        // session_start();
        // isAuth(); // Si no está autenticado lo redirige al login
        // debuguear($_SESSION['id']);
        $router->render('cita/index',[
            'nombre' => $_SESSION['nombre'],
            'id' => $_SESSION['id']
        ]);
    }
}