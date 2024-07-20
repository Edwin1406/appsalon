<?php
namespace Controllers;

use MVC\Router;

class ApiController {
    public static function index(Router $router) {
        
        $router->render('api/index',[
            
        ]);
    }
}


?>