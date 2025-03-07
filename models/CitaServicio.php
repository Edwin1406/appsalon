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
                    c.id AS cita_id,
                    c.estado AS estado,
                    c.fecha,
                    c.hora,
                    --agreagado reciente
                    c.nota,
                    u.nombre AS nombrecliente,
                    u.apellido AS apellidocliente,
                    u.telefono AS telefonocliente,
                    s.nombre AS nombreservicio,
                    o.nombre AS nombreodontologo
                  FROM citasservicios cs
                  LEFT JOIN citas c ON cs.citaId = c.id
                  LEFT JOIN usuarios u ON c.usuarioid = u.id
                  LEFT JOIN servicios s ON cs.servicioId = s.id
                  LEFT JOIN odontologo o ON s.odontologoid = o.id
                  ORDER BY c.fecha ASC, c.hora ASC";  
    
        $resultado = self::consultarSQL5($query);
    
        return $resultado;
    }
    
    
    

   
}