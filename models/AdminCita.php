<?php
namespace model;

use Model\ActiveRecord;
// con relacion a la tabla citaServicios
class AdminCita extends ActiveRecord{
    public static $tabla = 'citaServicios';
    public static $columnasDB= ['id','hora','cliente','email','telefono','servicio','precio'];
    public $id;
    public $hora;
    public $cliente;
    public $email;
    public $telefono;
    public $servicio;
    public $precio;
    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->hora = $args['hora'] ?? '';
        $this->cliente = $args['cliente'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->servicio = $args['servicio'] ?? '';
        $this->precio = $args['precio'] ?? '';
    }


}


?>