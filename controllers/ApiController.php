<?php
namespace Controllers;

use Model\Servicio;
use MVC\Router;

class ApiController {
    public static function index(Router $router) {

        $servicios = Servicio::all();
        $router->render('api/servicios',[
            'servicios' => $servicios
        ]);
        echo json_encode($servicios);
    }
}


?>