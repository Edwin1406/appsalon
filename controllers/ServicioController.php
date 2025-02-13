<?php
namespace Controllers;

use Model\Cita;
use MVC\Router;
use Model\Cliente;
use Model\Usuario;
use Model\Servicio;
use Model\Odontologo;
use Model\CitaServicio;

class ServicioController{
    public static function index(Router $router){
        session_start();
        // isAdmin();
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
        // isAdmin();

        $odontologos = Odontologo::all();

        // crear un nuevo servicio vacio
        $servicio = new Servicio;
        $alertas = [];
     
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            // este metodo se encarga de llenar el objeto servicio con los datos enviados por el usuario
            $servicio->sincronizar($_POST);

            // debuguear($_POST);
            // validacion
            $alertas = $servicio->validar();
            // debuguear($alertas);
            if(empty($alertas)){
                $servicio->guardar();
                header('Location: /admin/servicios');
            }
        }

        $router->render('servicios/crear',[
            'nombre' => $_SESSION['nombre'],
            'servicio' => $servicio,
            'alertas' => $alertas,
            'odontologos' => $odontologos
        ]);
    }

    // -------------------------------------ACTUALIZAR-------------------------------------
    public static function actualizar(Router $router){

        session_start();
        // isAdmin();

        
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
                header('Location: /admin/servicios');
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
        // isAdmin();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id= $_POST['id'];
            $servicio = Servicio::find($id);
            $servicio->eliminar();
            header('Location: /admin/servicios');
            
            // debuguear($servicio);

        }
    }

    public static function calendario(Router $router){
        session_start();
        isAdmin();
        $router->render('servicios/calendario',[
            'nombre' => $_SESSION['nombre']
        ]);
    }



    public static function cliente(Router $router){
       //instanciar Usuario
       $usuario = new Cliente;
       //arreglo con mensajes de errores
       $alertas = Cliente::getAlertas();
       $alertas = []; //porque cuando inicia la pagina no hay errores

       if($_SERVER['REQUEST_METHOD'] === 'POST'){

          $usuario ->sincronizar($_POST);
          $alertas = $usuario->validar();
       //revisar que el arreglo de errores este vacio
           if(empty($alertas)){
               // existeUsuario
             $resultado=$usuario->existeUsuario();

               if($resultado->num_rows){
                   $alertas=Cliente::getAlertas();
               }else{
                   // Almacenar el usuario en la base de datos
                   $resultado = $usuario->guardar();

                   if($resultado){
                      echo 'Cliente Creado';
                   }

                
               }
           }
         
       }
        $router->render('servicios/cliente',[
            'alertas' => $alertas
        ]);
        
    }



    public static function agendar(Router $router){
       
        
        session_start();
        isAdmin();
        
        $alertas = [];
        $usuarios = Usuario::all();
        $odontologos = Odontologo::all();
        $servicios = Servicio::all();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fecha = $_POST['fecha'];
            $hora = $_POST['hora'];
            $odontologoId = $_POST['odontologoId'];
    
            // Verificar si ya existe una cita con la misma hora para el mismo odontólogo en esa fecha
            $citaExistente = Cita::where('fecha', $fecha, 'hora', $hora, 'odontologoId', $odontologoId);
    
            if ($citaExistente) {
                $_SESSION['mensaje_error'] = "Ya existe una cita con el Dr./Dra. a las $hora en la fecha $fecha.";
                header('Location: /admin/servicios/agendar');
                exit;
            }
    
            // Guardar la nueva cita
            $cita = new Cita([
                'usuarioId' => $_POST['usuarioId'],
                'odontologoId' => $odontologoId,
                'fecha' => $fecha,
                'hora' => $hora
            ]);
    
            $resultado = $cita->guardar();
            $citaId = $resultado['id'];
    
            if ($citaId) {
                $citaServicio = new CitaServicio([
                    'citaId' => $citaId,
                    'servicioId' => $_POST['servicio']
                ]);
                $citaServicio->guardar();
    
                $_SESSION['mensaje_exito'] = "Cita creada correctamente";
                header('Location: /admin/servicios/agendar');
                exit;
            }
        }

        $router->render('servicios/agendar',[
            'usuarios' => $usuarios,
            'alertas' => $alertas,
            'odontologos' => $odontologos,
            'servicios' => $servicios,
        ]);
    }
}



?>