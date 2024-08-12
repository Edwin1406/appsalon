<?php
namespace Model;

class Servicio extends ActiveRecord{
    protected static $tabla = 'servicios';
    protected static $columnasDB =['id','nombre','precio','odontologoId'];
    
    public $id;
    public $nombre;
    public $precio;
    public $odontologoId;

    public function __construct()
    {
        // areglos asociativos
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->odontologoId = $args['odontologoId'] ?? '';
    }

    public function validar(){
        if(!$this->nombre){
            self::$alertas['error'][] = "Debes añadir un nombre de servicio"; 
        }
        if(!$this->precio){
            self::$alertas['error'][] = "Debes añadir un precio al servicio";
        }
        // if($this->precio < 0){
        //     self::$alertas['error'][] = "El precio debe ser mayor a 0";
        // }
        if(!is_numeric($this->precio)){
            self::$alertas['error'][] = "El precio debe ser un numero";
        }
        return self::$alertas;
    }

   





}

?>