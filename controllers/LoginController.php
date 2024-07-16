<?php

namespace Controllers;
use MVC\Router;
 

class LoginController
{
    public static function login(Router $router)
    {
        echo "Desde el Controlador login";
    }
    public static function logout(Router $router)
    {
        echo "Desde el Controlador logout";
    }
    public static function olvide(Router $router)
    {
        echo "Desde el Controlador olvide contraseña";
    }
    public static function recuperar(Router $router)
    {
        echo "Desde el Controlador recuperar contraseña ";
    }
}