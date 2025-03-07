<?php
namespace Model;
class Citas extends ActiveRecord{
    // Base de datos
    protected static $tabla = 'citas';
    protected static $columnasDB = ['id','fecha','hora','estado','nota','usuarioId'];
    // Atributos
    public $id;
    public $fecha;
    public $hora;
    public $estado;
    public $nota;
    public $usuarioId;
    // Constructor
    public function __construct($args=[])
    {
        $this->id = $args['id'] ?? null;
        $this->fecha = $args['fecha'] ?? '';
        $this->hora = $args['hora'] ?? '';
        $this->estado = $args['estado'] ?? '';
        $this->nota = $args['nota'] ?? '';
        $this->usuarioId = $args['usuarioId'] ?? '';
        
    }

   
}