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
     public function render(string $view, array $datos = []): void
     {
         extract($datos, EXTR_SKIP);
 
         ob_start();
         include __DIR__ . "/views/$view.php";
         $contenido = ob_get_clean();
 
 
         $url_actual = $_SERVER['REQUEST_URI'] ?? '/';
         
        
         // debuguear($url_actual);
 
         if(str_contains($url_actual,'/admin')){
             include __DIR__ . "/views/admin-layout.php";
 
         }else{
             
             include __DIR__ . "/views/layout.php";
 
         }
       
 
        
     }
}
?>

