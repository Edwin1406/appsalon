<?php
namespace Model;
class Cita extends ActiveRecord{
    // Base de datos
    protected static $tabla = 'citas';
    protected static $columnasDB = ['id','fecha','hora','usuarioId'];
    // Atributos
    public $id;
    public $fecha;
    public $hora;
    public $usuarioId;
    // Constructor
    public function __construct($args=[])
    {
        $this->id = $args['id'] ?? null;
        $this->fecha = $args['fecha'] ?? '';
        $this->hora = $args['hora'] ?? '';
        $this->usuarioId = $args['usuarioId'] ?? '';
        
    }

     // Método para obtener el usuario sin usar propiedades dinámicas
     public function getUsuario() {
        return Usuario::find($this->usuarioId);
    }
}