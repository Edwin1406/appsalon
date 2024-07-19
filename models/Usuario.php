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
        $this->admin = $args['admin'] ?? '0';
        $this->confirmado = $args['confirmado'] ?? '0';
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

    public function validarLogin(){
        if(!$this->email){
            self::$alertas['error'][] = "Debes añadir un email";
        }
        if(!$this->password){
            self::$alertas['error'][] = "Debes añadir un password";
        }
        return self::$alertas;
    }
    public function validarEmail(){
        if(!$this->email){
            self::$alertas['error'][] = "Debes añadir un email";
        }
        return self::$alertas;
    }

    public function validarPassword(){
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

    // Generar un token
    public function crearToken(){
        $this->token = uniqid();
    }


    // COMPROBAR EL  y VERIFICAR el confirmado
    public function comprobarPasswordAndVerificado($password){
        $resultado= password_verify($password, $this->password);
        if(!$resultado || !$this->confirmado){
            self::$alertas['error'][] = "La cuenta no ha sido confirmada o el password es incorrecto";
            
        }else{
            return true;
        }
    }

    


}