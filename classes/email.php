<?php
namespace Classes;

class Email {
    public $email;
    public $nombre;
    public $apellido;
    public $token;
    public function __construct($email,$nombre,$apellido,$token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->token = $token;
      
    }

}