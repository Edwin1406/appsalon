<?php
namespace MVC;

class Router {
    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn) {
        $this->rutasGET[$url] = $fn;
    }
    public function post($url, $fn) {
        $this->rutasPOST[$url] = $fn;
    }

    public function comprobarRutas() {
        // session_start();
        // $auth = $_SESSION['login'] ?? null;
        // debuguear($auth);
      

        // arreglo de rutas protegidas
        // $rutas_protegidas= ['/admin', '/admin/propiedades/crear', '/admin/propiedades/actualizar', '/admin/propiedades/eliminar', '/admin/vendedores/crear', '/admin/vendedores/actualizar', '/admin/vendedores/eliminar'];

        // $urlActual = $_SERVER['REQUEST_URI'] ?? '/';
        // $urlActual = str_replace('/Appsalon', '', $urlActual);
        // $urlActual = strtok($urlActual, '?');
        // $metodo= $_SERVER['REQUEST_METHOD'];
      

        // if($metodo === 'GET') {
        //     $fn = $this->rutasGET[$urlActual] ?? null;
        // } else {
        //     // debuguear($_POST);
        //     $fn = $this->rutasPOST[$urlActual] ?? null;
        // }
        
        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method === 'GET') {
            $fn = $this->rutasGET[$urlActual] ?? null;
        } else {
            $fn = $this->rutasPOST[$urlActual] ?? null;
        }


        if ( $fn ) {
            // Call user fn va a llamar una función cuando no sabemos cual sera
            call_user_func($fn, $this); // This es para pasar argumentos
        } else {
            echo "Página No Encontrada o Ruta no válida";
        }

        // // Proteger las rutas inarray me devuelve true si la url actual esta en el arreglo de rutas protegidas
        // if(in_array($urlActual,$rutas_protegidas) && !$auth){
           
        //     header('Location:/appsalon/login');

        // }
 
          if($fn) {
              
                // si la ruta existe, llamar al callback con la instancia del router
              call_user_func($fn, $this);
                
          } else {
               echo 'Página no encontrada';
          }
       
        
     } 
        //  Muestra una vista
     public function render($view,$datos=[]) {

        // acceder a la llave valor del arreglo
        foreach($datos as $key => $value){
            // $$ variable de variable
            $$key = $value;

        }

        ob_start(); //inicia el almacenamiento en el memoria
         include __DIR__ . "/views/$view.php";
         $contenido = ob_get_clean(); //limpia la memoria y lo guarda en la variable
         include __DIR__ . "/views/layout.php";

     }
}
?>

