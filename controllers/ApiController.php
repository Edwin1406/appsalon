<?php
namespace Controllers;

use Model\Servicio;


class ApiController {
    public static function index() {

        $servicios = Servicio::all();
        echo json_encode($servicios);
        
    }

    public static function guardar(){
        // $respuesta = [
        //     'mensaje' => 'Cita guardada',

        // ]; // Arreglo para la respuesta asocitiva
        // echo json_encode($respuesta);
        echo 'Cita guardada';
    }


}


?>