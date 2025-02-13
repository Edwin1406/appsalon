<?php
namespace Model;

class  CitaServicio extends ActiveRecord{
    protected static $tabla = 'citasservicios';
    protected static $columnasDB = ['id','citaId','servicioId'];
    
    public $id;
    public $citaId;
    public $servicioId;

    public function __construct($args=[])
    {
        $this->id = $args['id'] ?? null;
        $this->citaId = $args['citaId'] ?? '';
        $this->servicioId = $args['servicioId'] ?? '';
    }




    public static function obtenerCitas() {
        $query = "SELECT 
                    cs.id AS citasservicio_id,
                    cs.estado AS estado,
                    c.id AS cita_id,
                    c.fecha,
                    c.hora,
                    u.nombre AS nombrecliente,
                    u.apellido AS apellidocliente,
                    u.telefono AS telefonocliente,
                    s.nombre AS nombreservicio,
                    o.nombre AS nombreodontologo
                  FROM citasservicios cs
                  LEFT JOIN citas c ON cs.citaId = c.id
                  LEFT JOIN usuarios u ON c.usuarioid = u.id
                  LEFT JOIN servicios s ON cs.servicioId = s.id
                  LEFT JOIN odontologo o ON s.odontologoid = o.id";
    
        $resultado = self::consultarSQL5($query);
    
     
        return $resultado;
    }
    
    

   
}