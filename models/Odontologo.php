<?php
namespace Model;

class Odontologo extends ActiveRecord{
    protected static $tabla = 'odontologo';
    protected static $columnasDB =['id','nombre'];
    
    
    public $id;
    public $nombre;
    public $odontologo;
    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->odontologo = $args['odontologo'] ?? '';

    }


    
    public function validar()
    {
        if(!$this->nombre){
            self::$alertas['error'][] = "Debes añadir un nombre";
        }
       
        return self::$alertas;
    }


    public function existeUsuario(){
        $query = "SELECT * FROM ".self::$tabla." WHERE nombre = '".$this->nombre."' LIMIT 1";
        $resultado = self::$db->query($query);
        if($resultado->num_rows){ //num_rows es una propiedad de mysqli
            self::$alertas['error'][] = "El usuario ya esta registrado";
        }
        return $resultado;
        // debuguear($resultado);
    }

}
?>