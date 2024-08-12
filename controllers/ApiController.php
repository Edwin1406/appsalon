<?php
namespace Controllers;

use Model\Cita;
use Model\CitaServicio;
use Model\Odontologo;
use Model\Servicio;


class ApiController {
    public static function index() {

        $servicios = Servicio::all();

        $serviciosConOdontologo = [];
        
        foreach ($servicios as $servicio) {
            $odontologo = Odontologo::find($servicio->odontologoId);
            
            $servicioConOdontologo = [
                'id' => $servicio->id,
                'nombre' => $servicio->nombre,
                'precio' => $servicio->precio,
                'odontologoId' => $servicio->odontologoId,
                'odontologo' => $odontologo->nombre, // Añadimos el nombre del odontólogo
            ];
        
            $serviciosConOdontologo[] = $servicioConOdontologo;
        }
        
        echo json_encode($serviciosConOdontologo);
        
        
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
        $cita->eliminarCita();
        header('Location: '.$_SERVER['HTTP_REFERER']);
       }
    }


}


?>