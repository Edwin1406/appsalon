<?php
namespace Controllers;

use Model\Servicio;
use MVC\Router;

class ServicioController{
    public static function index(Router $router){
        session_start();
        isAdmin();
        $servicios = Servicio::all();
      
        // debuguear($servicios);
        $router->render('servicios/index',[
          'servicios' => $servicios,
            'nombre' => $_SESSION['nombre'],
         

        ]);
        
    }
    // -------------------------------------CREAR-------------------------------------
    public static function crear(Router $router){
        session_start();
        isAdmin();

        // crear un nuevo servicio vacio
        $servicio = new Servicio;
        $alertas = [];
     
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            // este metodo se encarga de llenar el objeto servicio con los datos enviados por el usuario
            $servicio->sincronizar($_POST);
            // validacion
            $alertas = $servicio->validar();
            // debuguear($alertas);
            if(empty($alertas)){
                $servicio->guardar();
                header('Location: /servicios');
            }
        }

        $router->render('servicios/crear',[
            'nombre' => $_SESSION['nombre'],
            'servicio' => $servicio,
            'alertas' => $alertas
        ]);
    }

    // -------------------------------------ACTUALIZAR-------------------------------------
    public static function actualizar(Router $router){

        session_start();
        isAdmin();

        
        if(!is_numeric($_GET['id'])) return;
        // debuguear($id);
        $servicio = Servicio::find($_GET['id']);
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            

            $servicio->sincronizar($_POST);
            $alertas = $servicio->validar();
            // debuguear($_POST);
            if(empty($alertas)){
                $servicio->guardar();
                header('Location: /servicios');
            }

        }
        $router->render('servicios/actualizar',[
            'nombre' => $_SESSION['nombre'],
            'servicio' => $servicio,
            'alertas' => $alertas
        ]);
    }
    // -------------------------------------ELIMINAR-------------------------------------
    public static function eliminar(){
        session_start();
        isAdmin();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id= $_POST['id'];
            $servicio = Servicio::find($id);
            $servicio->eliminar();
            header('Location: /servicios');
            
            // debuguear($servicio);

        }
    }

}
?>