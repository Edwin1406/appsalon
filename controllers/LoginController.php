<?php

namespace Controllers;
use MVC\Router;
use Model\Usuario;
 

class LoginController
{
    public static function login(Router $router)
    {
       $router->render('auth/login');
    }
    public static function logout(Router $router)
    {
        echo "Desde el Controlador logout";
    }
    // crea una cuenta de usuario
    public static function crear(Router $router)
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
          //instanciar Usuario
            $usuario = new Usuario($_POST);
            debuguear($usuario);

        }



       $router->render('auth/crear-cuenta',[

       ]);
    }
    public static function olvide(Router $router)
    {
       $router->render('auth/olvide');
    }
   
}