<?php
namespace Controllers;

use Model\Servicio;
use MVC\Router;

class ServicioController{
    public static function index(Router $router){
        $servicios = Servicio::all();
        debuguear($servicios);
        $router->render('servicios/index',[
          'servicios' => $servicios

        ]);
        
    }
    public static function crear(Router $router){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

        }
        $router->render('servicios/crear');
    }
    public static function actualizar(Router $router){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

        }
        $router->render('servicios/actualizar');
    }
    public static function eliminar(Router $router){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

        }
    }

}
?>