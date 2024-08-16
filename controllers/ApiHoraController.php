<?php
namespace Controllers;

use Model\Cita;

class ApiHoraController{
    public static function index() {
        header("Access-Control-Allow-Origin: *");

        $cita = Cita::all();
        echo json_encode($cita);
        
    }
}


?>