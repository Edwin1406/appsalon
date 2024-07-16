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
        //instanciar Usuario
        $usuario = new Usuario;
        //arreglo con mensajes de errores
        // $errores = Usuario::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
           $usuario ->sincronizar($_POST);

        }



       $router->render('auth/crear-cuenta',[
        'usuario' => $usuario,
       
       ]);
    }
    public static function olvide(Router $router)
    {
       $router->render('auth/olvide');
    }
   
}