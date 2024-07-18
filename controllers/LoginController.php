<?php
namespace Controllers;


use Classes\email;

use MVC\Router;
use Model\Usuario;
 

class LoginController
{
    public static function login(Router $router)
    {
        $alertas = [];

        if($_SERVER['REQUEST_METHOD']==='POST'){
            $auth = new Usuario($_POST);
            $alertas = $auth->validarLogin();
           if(empty($alertas)){
                // comprobar si el usuario existe
                $usuario = Usuario::where('email', $auth->email);
                if($usuario){
                    // verificar si el password es correcto
                    if($usuario->comprobarPasswordAndVerificado($auth->password)){
                        // autenticar el usuario
                        session_start();
                        $_SESSION['usuario'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre.' '.$usuario->apellido;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;
                        
                        // redireccionar
                        if($usuario->admin==='1'){
                            $_SESSION['admin'] = $usuario->admin ?? null;
                            header('Location: /admin');
                            
                        }else{
                            header('Location: /cita');
                            
                        }
                        // debuguear($_SESSION);
                         
                    }

                }else{
                    $alertas = Usuario::setAlerta('error', 'El usuario no existe');
                }
           }
        }
        $alertas = Usuario::getAlertas();
       $router->render('auth/login',[
            'alertas' => $alertas
       ]);
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
                // existeUsuario
              $resultado=$usuario->existeUsuario();

                if($resultado->num_rows){
                    $alertas=Usuario::getAlertas();
                }else{
                    // Hashear el password
                    $usuario->hashPassword();
                    // Generar un token
                    $usuario->crearToken();
                    // enviar email
                    $email = new email($usuario->nombre, $usuario->email, $usuario->token);
                    $email->enviarConfirmacion();

                    // Almacenar el usuario en la base de datos
                    $resultado = $usuario->guardar();

                    if($resultado){
                       header('Location: /mensaje');
                    }

                    // debuguear($usuario);
                }
            }
          
        }

       $router->render('auth/crear-cuenta',[
        'usuario' => $usuario,
        'alertas' => $alertas
       
       ]);
    }

    // recuperar contraseña
    public static function olvide(Router $router)
    {
       $alertas = [];
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $auth = new Usuario($_POST);
            $alertas = $auth->validarEmail();
            if(empty($alertas)){
                $usuario = Usuario::where('email', $auth->email);
                // verificar si el usuario existe
                if($usuario && $usuario->confirmado ==='1'){
                    // generar token
                   $usuario->crearToken();
                   $usuario->guardar();
                    // enviar email
                    $alertas = Usuario::setAlerta('exito', 'Revisa tu email para cambiar tu contraseña');

                }else{
                    $alertas = Usuario::setAlerta('error', 'El usuario no existe o no ha confirmado su cuenta');
                
                }
                
            }   

        }

        $alertas = Usuario::getAlertas();
       $router->render('auth/olvide',[
            'alertas' => $alertas
       ]);
    }
    // mensaje de confirmacion de cuenta
    public static function mensaje(Router $router)
    {
       $router->render('auth/mensaje');
    }

    public static function confirmar(Router $router)
    {
        $alertas = [];
        $token= s($_GET['token']);

        $usuario = Usuario::where('token', $token);
        if(empty($usuario)){
            // mostrar mensaje de error
            Usuario::setAlerta('error', 'Token no valido');
        }else{ 
            $usuario->confirmado = "1";
            $usuario->token = '';
            $usuario->guardar();
            Usuario::setAlerta('exito', 'Cuenta confirmada correctamente');
            // debuguear($usuario);
        }
        // para se que se muestre antes de renderizar
        $alertas = Usuario::getAlertas();
        $router->render('auth/confirmar',[
            'alertas' => $alertas,
            'usuario' => $usuario
         
        ]);
    }
   
}