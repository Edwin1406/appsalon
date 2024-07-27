<?php
namespace Controllers;

use Model\Servicio;
use MVC\Router;

class ServicioController{
    public static function index(Router $router){
        session_start();
        $servicios = Servicio::all();
        $servicio = new Servicio;
        // debuguear($servicios);
        $router->render('servicios/index',[
          'servicios' => $servicios,
            'nombre' => $_SESSION['nombre'],
            'servicio' => $servicio

        ]);
        
    }
    public static function crear(Router $router){
        session_start();
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

        }
        $router->render('servicios/crear',[
            'nombre' => $_SESSION['nombre']
        ]);
    }
    public static function actualizar(Router $router){
        session_start();
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

        }
        $router->render('servicios/actualizar',[
            'nombre' => $_SESSION['nombre']
        ]);
    }
    public static function eliminar(Router $router){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

        }
    }

}
?>