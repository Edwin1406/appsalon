<?php
namespace Controllers;

use Model\Cita;
use Model\Citas;
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
        isAdmin();

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
        session_start();
        isAdmin();
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
                          //redireccionar al usuario
                          header('Location: /admin/servicios/agendar');
                   }

                
               }
           }
         
       }
        $router->render('servicios/cliente',[
            'alertas' => $alertas
        ]);
        
    }


    public static function agendar(Router $router) {
        session_start();
        isAdmin();
        
        $alertas = [];
        $usuarios = Usuario::allDesc('DESC');
        $odontologos = Odontologo::all();
        $servicios = Servicio::all();
        // debuguear($odontologos);

    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nota = $_POST['nota'];
            $fecha = $_POST['fecha'];
            $hora = $_POST['hora'];
            $usuarioId = $_POST['usuarioId'];
            $odontologoId = $_POST['odontologoId'];
            $servicioId = $_POST['servicio'];
    
            // Contar cuántas citas existen en la misma fecha y hora
            $citasExistentes = Cita::contarDonde('hora', $hora, 'fecha', $fecha);
    
            // Permitir hasta dos citas en la misma hora
            if ($citasExistentes >= 2) {
                $_SESSION['mensaje_error'] = "Ya existen dos citas a las $hora en la fecha $fecha. Por favor, elige otra hora.";
                header('Location: /admin/servicios/agendar');
                exit;
            }

              // sevicioId = 0 significa que no se ha seleccionado un servicio
              if ($servicioId == 0 || !$odontologoId==0) {
                $_SESSION['mensaje_error'] = "Por favor, selecciona una Paciente Especialidad";
                header('Location: /admin/servicios/agendar');
                exit;
            }

            // Guardar la nueva cita
            $cita = new Cita([
                'usuarioId' => $usuarioId,
                'odontologoId' => $odontologoId,
                'fecha' => $fecha,
                'hora' => $hora,
                'nota' => $nota,
            ]);

            // debuguear($cita);
    
            $resultado = $cita->guardar();
            $citaId = $resultado['id'] ?? null;
    
            if ($citaId) {
                $citaServicio = new CitaServicio([
                    'citaId' => $citaId,
                    'servicioId' => $servicioId
                ]);
                $citaServicio->guardar();
    
                $_SESSION['mensaje_exito'] = "Cita creada correctamente";
                header('Location: /admin/servicios/calendario');
                exit;
            }
        }
    
        $router->render('servicios/agendar', [
            'usuarios' => $usuarios,
            'alertas' => $alertas,
            'odontologos' => $odontologos,
            'servicios' => $servicios,
        ]);
    }
    

    
    
    public static function apicitaservicio(Router $router) {
        $citas = CitaServicio::obtenerCitas(); // Obtiene el array directamente
    
        // Configurar el encabezado de la respuesta
        header('Content-Type: application/json');
        
        // Codificar y devolver JSON una sola vez
        echo json_encode($citas, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        exit;
    }
    



    public static function estado (Router $router){
        $visor_id= $_GET['id'] ?? '';
        $visor_id= filter_var($visor_id,FILTER_VALIDATE_INT);
        if(!$visor_id){
            echo json_encode([]);
            return;
            }

        $estados = Citas::find($visor_id);
        echo json_encode($estados);
    }


    public static function actualizarestado(){

   

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();
            $cita = Citas::find($_POST['id']);
 
            if (!$cita || (int)$cita->id !== (int)$_POST['id']) {
             $respuesta = [
                 'estado' => 'error',
                 'mensaje' => 'Error al actualizar el estado'
             ];
             echo json_encode($respuesta);
             return;
         }
             $visor = new Citas($_POST);
             $visor->id = $cita->id;
             // debuguear($visor);
             $resultado = $visor->guardar();
             if($resultado){
                 $respuesta = [
                     'tipo' => 'correcto',
                     'mensaje' => 'Estado actualizado'
                 ];
             } 
             echo json_encode(['respuesta' => $respuesta]);
        }
        
     



        
    }




    public static function odontologo(Router $router){
       


        session_start();
        isAdmin();
       //instanciar Usuario
       $odontologo = new Odontologo;
       //arreglo con mensajes de errores
       $alertas = Odontologo::getAlertas();
       $alertas = []; //porque cuando inicia la pagina no hay errores

       if($_SERVER['REQUEST_METHOD'] === 'POST'){

          $odontologo ->sincronizar($_POST);
          $alertas = $odontologo->validar();
       //revisar que el arreglo de errores este vacio
           if(empty($alertas)){
               // existeUsuario
             $resultado=$odontologo->existeUsuario();

               if($resultado->num_rows){
                   $alertas=Odontologo::getAlertas();
               }else{
                   // Almacenar el usuario en la base de datos
                   $resultado = $odontologo->guardar();

                   if($resultado){
                          //redireccionar al usuario
                          header('Location: /admin/servicios/crear');
                   }
                   
                
               }
           }
         
       }
        
         $router->render('servicios/odontologo',[
             'alertas' => $alertas,
             'odontologo' => $odontologo

         ]);

    }



    public static function aceptar(Router $router){
      

        $id = $_GET['id'] ?? null;
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if (!$id){
            header('Location: /');
        }

        $alertas = [];
        $aceptar = Citas::find($id);

        // debuguear($aceptar);

        if($_SERVER['REQUEST_METHOD']=='POST'){
            $aceptar->sincronizar($_POST);

            // debuguear($_POST);
          
            $alertas = $aceptar->validar();
            if(empty($alertas)){
                $aceptar->actualizar();
                header('Location: /mensaje');
            }

        }
        $router->render('servicios/aceptar', [
            'titulo' => 'Aceptar Cita',
            'alertas' => $alertas,
            'aceptar' => $aceptar
          
            
        ]);
        
        


    }





    public static function mensaje(Router $router){
       
        $router->render('servicios/mensaje',[
            'titulo' => 'Cita Actualizada'
        ]);
    }

    public static function historial(Router $router){
        session_start();
        isAdmin();
        $usuarioId= $_GET['id'] ?? '';
        $usuarioId= filter_var($usuarioId,FILTER_VALIDATE_INT);

        if(!$usuarioId){
            header('Location: /');
        }

        $users = Usuario::find($usuarioId);
        // debuguear($users);

        // debuguear($citas);
        $router->render('servicios/historial',[
            'nombre' => $_SESSION['nombre'],
            'users' => $users,

        ]);
    }




    public static function verclientes(Router $router){
        session_start();
        isAdmin();
        $clientes = Cliente::allDesc('DESC');
        // debuguear($usuarios);
        $router->render('servicios/verclientes',[
            'nombre' => $_SESSION['nombre'],
            'clientes' => $clientes
        ]);
    }

    

    public static function actualizarcliente(Router $router){
        session_start();
        isAdmin();

        if(!is_numeric($_GET['id'])) return;
        // debuguear($id);
        $cliente = Cliente::find($_GET['id']);
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            

            $cliente->sincronizar($_POST);
            $alertas = $cliente->validar();
            // debuguear($_POST);
            if(empty($alertas)){
                $cliente->guardar();
                header('Location: /admin/servicios/verclientes');
            }

        }
        $router->render('servicios/actualizarcliente',[
            'nombre' => $_SESSION['nombre'],
            'cliente' => $cliente,
            'alertas' => $alertas
        ]);
    }
    
    
    
}





?>