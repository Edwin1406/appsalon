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

                
                $urlActual = strtok($_SERVER['REQUEST_URI'], '?') ?? '/';
                $method = $_SERVER['REQUEST_METHOD'];   

                if ($method === 'GET') {
                    $fn = $this->rutasGET[$urlActual] ?? null;
                } else {
                    $fn = $this->rutasPOST[$urlActual] ?? null;
                }
                
 
          if($fn) {
              
                // si la ruta existe, llamar al callback con la instancia del router
              call_user_func($fn, $this);
                
          } else {
              
               header('Location: /paginaNoEncontrada');
          }
       
        
     } 
        //  Muestra una vista
     public function render($view,$datos=[]):void{

        extract($datos, EXTR_SKIP);

        ob_start(); //inicia el almacenamiento en el memoria
         include __DIR__ . "/views/$view.php";
         $contenido = ob_get_clean(); //limpia la memoria y lo guarda en la variable
         $urlActual = $_SERVER['REQUEST_URI'] ?? '/';

         if (strpos($urlActual, '/admin') !== false) {
             include __DIR__ . "/views/admin-layout.php";
         } else {

             include __DIR__ . "/views/layout.php";

            }
        }
}
?>

