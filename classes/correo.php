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
      // Crear una instancia de PHPMailer
      $mail = new PHPMailer();
      
      // Configuración del servidor SMTP
      $mail->isSMTP();
      $mail->Host = $_ENV['EMAIL_HOST'];
      $mail->SMTPAuth = true;
      $mail->Username = $_ENV['EMAIL_USER'];
      $mail->Password = $_ENV['EMAIL_PASS'];
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Alternativa moderna a 'ssl'
      $mail->Port = $_ENV['EMAIL_PORT'];
  
      // Configurar el remitente y destinatario
      $mail->setFrom('pruebas@odonto.megawebsistem.com', 'Soporte Odonto');
      $mail->addAddress($this->email); // Correo del destinatario
      $mail->addReplyTo('soporte@odonto.megawebsistem.com', 'Soporte Odonto');
  
      // Configurar el asunto del correo
      $mail->Subject = 'Notificación de inicio de sesión';
  
      // Configurar el contenido en formato HTML
      $mail->isHTML(true);
      $mail->CharSet = 'UTF-8';
  
      // Construcción del contenido del email
      $contenido = '<html>';
      $contenido .= '<head><meta charset="UTF-8"></head>';
      $contenido .= '<body>';
      $contenido .= '<p><strong>Hola ' . htmlspecialchars($this->nombre) . ',</strong></p>';
      $contenido .= '<p>Te notificamos que se ha iniciado sesión en tu cuenta.</p>';
      $contenido .= '<p>Si fuiste tú, puedes ignorar este mensaje.</p>';
      $contenido .= '<p>Si no reconoces esta actividad, te recomendamos cambiar tu contraseña inmediatamente.</p>';
      $contenido .= '<p>Atentamente,<br>El equipo de Odonto</p>';
      $contenido .= '</body></html>';
  
      $mail->Body = $contenido;
  
      // Enviar el email y manejar posibles errores
      if (!$mail->send()) {
          error_log("Error al enviar correo: " . $mail->ErrorInfo);
          return false;
      }
  
      return true;
  }
  
}







