<?php
namespace Controllers;

use Model\Cita;

class ApiHoraController{
    public static function index() {
        
        // Permitir acceso desde cualquier origen
        header("Access-Control-Allow-Origin: *");
        
        // Permitir métodos específicos (GET, POST, PUT, DELETE, OPTIONS)
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        
        // Permitir headers específicos (Content-Type, Authorization, etc.)
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
        
        // Permitir credenciales (cookies, autenticación HTTP, etc.)
        // header("Access-Control-Allow-Credentials: true");
        

        $cita = Cita::all();
        echo json_encode($cita);
        
    }
}


?>