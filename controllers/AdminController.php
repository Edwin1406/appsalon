<?php
namespace Controllers;

use Model\AdminCita;
use MVC\Router;

class AdminController
{
    public static function index(Router $router)
    {
        session_start();
        isAdmin();
        // admin
        if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== 1) {
            header('Location: /paginaNoEncontrada');
        }

        $fecha = $_GET['fecha'] ?? date('Y-m-d');
        $fechas= explode('-',$fecha);
        // debuguear($fechas);
        if(!checkdate($fechas[1],$fechas[2],$fechas[0])){
          header('Location: /paginaNoEncontrada');
        }

    
        // debuguear($fecha);
        // consultar la base de datos
        $consulta = "SELECT citas.id, citas.hora,citas.fecha as fechas_whats, CONCAT( usuarios.nombre, ' ', usuarios.apellido) as cliente, ";
        $consulta .= " usuarios.email, usuarios.telefono, servicios.nombre as servicio,";
        $consulta .= " odontologo.nombre as odontologo ";
        $consulta .= " FROM citas  ";
        $consulta .= " LEFT OUTER JOIN usuarios ";
        $consulta .= " ON citas.usuarioId=usuarios.id  ";
        $consulta .= " LEFT OUTER JOIN citasservicios ";
        $consulta .= " ON citasservicios.citaId=citas.id ";
        $consulta .= " LEFT OUTER JOIN servicios ";
        $consulta .= " ON servicios.id=citasservicios.servicioId ";
        $consulta .= " LEFT OUTER JOIN odontologo ";
        $consulta .= " ON odontologo.id=servicios.odontologoId ";
        // $consulta .= " WHERE fecha =  '${fecha}' ";
        $consulta .= " WHERE fecha = '{$fecha}'";
        
       
        $citas=AdminCita::SQL($consulta);
      //  debuguear($citas);
          
      $router->render('admin/index',[
        'nombre' => $_SESSION['nombre'],
        'citas' => $citas,
        'fecha' => $fecha

      ]);
    }
}


?>