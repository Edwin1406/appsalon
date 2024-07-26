<?php
namespace Controllers;

use Model\Cita;
use Model\CitaServicio;
use Model\Servicio;


class ApiController {
    public static function index() {

        $servicios = Servicio::all();
        echo json_encode($servicios);
        
    }

    public static function guardar(){
        
        // almacena la cita y devuelve el ID
        $cita= new Cita($_POST);
        $resultado = $cita->guardar();

        $id = $resultado['id'];

        // Almacena los servicios con el ID de la cita
         $idServicios = explode(",", $_POST['servicios']);
         foreach($idServicios as $idServicio):
            $args = [
                'citaId' => $id,
                'servicioId' => $idServicio
            ];
            $citaServicio = new CitaServicio($args);
            $citaServicio->guardar();
         endforeach;
        //  retronamos una respuesta
        
        echo json_encode(['resultado' => $resultado]);
        
        // $respuesta = [
        //     'resultado' => $resultado,
        // ]; // Arreglo para la respuesta asocitiva
        // echo json_encode($respuesta);

    }


    public static function eliminar(){
       if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $id = $_POST['id'];
        $cita = Cita::find($id);
        $cita->eliminar();
        echo json_encode(['resultado' => 'Cita eliminada']);
       }
    }


}


?>