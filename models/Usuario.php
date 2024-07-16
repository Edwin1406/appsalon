<?php 
namespace Model;

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
            self::$alertas[] = "Debes añadir un nombre";
        }
        if(!$this->apellido){
            self::$alertas[] = "Debes añadir un apellido";
        }
        if(!$this->email){
            self::$alertas[] = "Debes añadir un email";
        }
        if(!$this->password){
            self::$alertas[] = "Debes añadir un password";
        }
        if(!$this->telefono){
            self::$alertas[] = "Debes añadir un telefono";
        }
        return self::$alertas;
    }

    


}