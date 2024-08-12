<?php
namespace Model;

class Odontologo extends ActiveRecord{
    protected static $tabla = 'odontologo';
    protected static $columnasDB =['id','nombre'];
    
    
    public $id;
    public $nombre;
    public $odontologoNombre;
    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->odontologoNombre = $args['odontologoNombre'] ?? '';

    }
    

}
?>