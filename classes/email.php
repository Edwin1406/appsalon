<?php
namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class email {
    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token) {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }



    public function enviarConfirmacion() {
        
        //  creamos una instancia de PHPMailer
        $mail = new PHPMailer();
        // configurar el SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'agrolecc@gmail.com';
        $mail->Password = 'fkbavwbfpyqikmws';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

          // configurar el contenido del email
        $mail->setFrom('agrolecc@gmail.com');
        $mail->addAddress('edwin.ed948@gmail.com','AppSalon.com'); //correo de destino
        $mail->Subject = 'Confirma tu cuenta';

        // set HTML
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $contenido = '<html>';
        $contenido .= '<p>Hola ' . $this->nombre . '</p>';
        $contenido .= '<p>Para confirmar tu cuenta por favor haz clic en el siguiente enlace</p>';
        $contenido = '<a href="https://serviacrilico.com/confirmar?token='.$this->token.'">Confirmar cuenta</a>';
        $contenido .= '<p>Si no solicitaste la creación de la cuenta, por favor ignora este mensaje</p>';
        $contenido .= '</html>';
        $mail->Body = $contenido;

        // enviar el email
        $mail->send();

       
    }
}
