<?php
namespace Controllers;

use Model\Cita;
use Model\Servicio;


class ApiController {
    public static function index() {

        $servicios = Servicio::all();
        echo json_encode($servicios);
        
    }

    public static function guardar(){
        
        // almacena la cita y devuelve el ID
        // $cita= new Cita($_POST);
        // $respuesta = $cita->guardar();

        // Almacena la Cita y el Servicio
         $idServicio = explode(',', $_POST['servicio']);

        $respuesta = [
            'servicio' => $idServicio,

        ]; // Arreglo para la respuesta asocitiva

        echo json_encode($respuesta);





    }


}


?>