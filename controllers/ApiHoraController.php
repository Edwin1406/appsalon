<?php
namespace Controllers;

use Model\Cita;

class ApiHoraController{
    public static function index() {
        
     
        

        $cita = Cita::all();
        echo json_encode($cita);
        
    }
}


?>