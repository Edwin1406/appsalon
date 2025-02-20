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
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];
        $mail->SMTPSecure = 'ssl';
        $mail->Port = $_ENV['EMAIL_PORT'];

          // configurar el contenido del email
        $mail->setFrom('pruebas@odonto.megawebsistem.com', 'Odonto Seguridad');
        $mail->addAddress($this->email);
        $mail->addReplyTo('soporte@odonto.megawebsistem.com', 'Soporte Odonto');
        $mail->Subject = 'Confirma tu cuenta';

        // set HTML
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $contenido = '<html>';
        $contenido .= '<p>Hola ' . $this->nombre . '</p>';
        $contenido .= '<p>Para confirmar tu cuenta por favor haz clic en el siguiente enlace</p>';
        $contenido .= '<p><a href="https://odonto.megawebsistem.com/confirmar?token=' . $this->token . '">Confirmar cuenta</a></p>';
        $contenido .= '<p>Si no solicitaste la creación de la cuenta, por favor ignora este mensaje</p>';
        $contenido .= '</html>';
        $mail->Body = $contenido;

        // enviar el email
        $mail->send();

       
    }

    public function enviarRecuperacion() {
        
        
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

        $mail->setFrom('pruebas@odonto.megawebsistem.com', 'Odonto Seguridad');
        $mail->addAddress($this->email);
        $mail->addReplyTo('soporte@odonto.megawebsistem.com', 'Soporte Odonto');


        $mail->Subject = 'Restablece tu contraseña';
        

        // set HTML
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $contenido = '<html>';
        $contenido .= '<p>Hola ' . $this->nombre . '</p>';
        $contenido .= '<p>Haz solicitado reestablecer tu password,sigue el enlance para hacerlo</p>';
        $contenido .= '<p><a href="https://odonto.megawebsistem.com/recuperar?token=' . $this->token . '">Reestablecer Password</a></p>';
        $contenido .= '<p>Si no solicitaste la creación de la cuenta, por favor ignora este mensaje</p>';
        $contenido .= '</html>';
        $mail->Body = $contenido;

        // enviar el email
        $mail->send();

    }



}







