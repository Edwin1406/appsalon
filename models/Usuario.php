<?php 
namespace Model;

use Error;

class Usuario extends ActiveRecord{
    protected static $tabla = 'usuarios';
    protected static $columnasDB =['id','nombre','apellido','email','password','telefono','admin','confirmado','token'];
    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;

    public function __construct($args=[])
    {
        // areglos asociativos
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->admin = $args['admin'] ?? null;
        $this->confirmado = $args['confirmado'] ?? null;
        $this->token = $args['token'] ?? '';
    }
    // mensaje de validacion para crear cuenta

    public function validar()
    {
        if(!$this->nombre){
            self::$alertas['error'][] = "Debes añadir un nombre";
        }
        if(!$this->apellido){
            self::$alertas['error'][] = "Debes añadir un apellido";
        }
        if(!$this->email){
            self::$alertas['error'][] = "Debes añadir un email";
        }
        if(!$this->telefono){
            self::$alertas['error'][] = "Debes añadir un telefono";
        }
        if(!$this->password){
            self::$alertas['error'][] = "Debes añadir un password";
        }
        if(strlen($this->password) < 6){
            self::$alertas['error'][] = "El password debe tener al menos 6 caracteres";
        }

        return self::$alertas;
    }

    public function existeUsuario(){
        $query = "SELECT * FROM ".self::$tabla." WHERE email = '".$this->email."' LIMIT 1";
        $resultado = self::$db->query($query);
        if($resultado->num_rows){ //num_rows es una propiedad de mysqli
            self::$alertas['error'][] = "El usuario ya esta registrado";
        }
        return $resultado;
        // debuguear($resultado);
    }
    // hashear password
    public function hashPassword(){
        $this->password = password_hash($this->password,PASSWORD_BCRYPT);
    }

    


}