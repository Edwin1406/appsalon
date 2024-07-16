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
        $alertas = Usuario::getAlertas();
        $alertas = []; //porque cuando inicia la pagina no hay errores

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

           $usuario ->sincronizar($_POST);
           $alertas = $usuario->validar();
        //revisar que el arreglo de errores este vacio
            if(empty($alertas)){
                //crear la cuenta
                // $usuario->crear();
                echo "Creando cuenta";

            }
          

        }



       $router->render('auth/crear-cuenta',[
        'usuario' => $usuario,
        'alertas' => $alertas
       
       ]);
    }
    public static function olvide(Router $router)
    {
       $router->render('auth/olvide');
    }
   
}