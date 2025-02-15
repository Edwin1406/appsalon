<?php
namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class correo {
    public $email;
    public $nombre;

    public function __construct($email, $nombre) {
        $this->email = $email;
        $this->nombre = $nombre;
    }


    public function enviarSesion() {
        
      //  creamos una instancia de PHPMailer
      $mail = new PHPMailer();
      // configurar el SMTP
      $mail->isSMTP();
      $mail->Host = $_ENV['EMAIL_HOST'];
      $mail->SMTPAuth = true;
      $mail->Username = $_ENV['EMAIL_USER'];
      $mail->Password = $_ENV['EMAIL_PASS'];
      $mail->SMTPSecure = 'ssl';
      $mail->Port = $_ENV['EMAIL_PORT'];

        // configurar el contenido del email
      $mail->setFrom('pruebas@odonto.megawebsistem.com');
      $mail->addAddress($this->email); //correo de destino
      $mail->Subject = 'Restablece tu contraseña';

      // set HTML
      $mail->isHTML(true);
      $mail->CharSet = 'UTF-8';
      $contenido = '<html>';
      $contenido .= '<p>Hola ' . $this->nombre . '</p>';
      $contenido .= '<>Haz iniciado session en tu cuenta</p>';
      $contenido .= '<p> </p>';
      $contenido .= '<p>Si no iniciaste session cambiar contrasena</p>';
      $contenido .= '</html>';
      $mail->Body = $contenido;

      // enviar el email
      $mail->send();

  }
}







