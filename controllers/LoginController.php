<?php
namespace Controllers;

use Classes\Email;
use MVC\Router;
use Model\Usuario;

class LoginController {
    public static function login(Router $router) {
        $router->render('auth/login');
    }

    public static function logout(Router $router) {
        echo "Desde el Controlador logout";
    }

    // crea una cuenta de usuario
    public static function crear(Router $router) {
        // Instanciar Usuario
        $usuario = new Usuario;
        // Arreglo con mensajes de errores
        $alertas = Usuario::getAlertas();
        $alertas = []; // Porque cuando inicia la página no hay errores

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validar();
            // Revisar que el arreglo de errores esté vacío
            if (empty($alertas)) {
                // Existe Usuario
                $resultado = $usuario->existeUsuario();

                if ($resultado->num_rows) {
                    $alertas = Usuario::getAlertas();
                } else {
                    // Hashear el password
                    $usuario->hashPassword();
                    // Generar un token
                    $usuario->crearToken();
                    // Enviar email

                    // Instancia la clase Email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->apellido, $usuario->token);

                    // Debuguear para verificar
                    debuguear($email);
                }
            }
        }

        $router->render('auth/crear-cuenta', [
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function olvide(Router $router) {
        $router->render('auth/olvide');
    }
}
