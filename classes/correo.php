<?php
namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;
use IntlDateFormatter;
use DateTime;

class correo {
    public $email;
    public $nombre;

    public function __construct($email, $nombre) {
        $this->email = $email;
        $this->nombre = $nombre;
    }
   
 
        // Obtener la IP real del usuario en servidores como Hostinger o con Cloudflare
        public function obtenerIPUsuario() {
            if (!empty($_SERVER['HTTP_CF_CONNECTING_IP'])) {
                return $_SERVER['HTTP_CF_CONNECTING_IP']; // IP del usuario si usas Cloudflare
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
                return trim($ips[0]); // La primera IP en la lista es la IP real del usuario
            } else {
                return $_SERVER['REMOTE_ADDR']; // IP normal
            }
        }
    
        // Obtener ubicación de la IP usando ip-api.com
        public function obtenerUbicacion($ip) {
            if ($ip === '127.0.0.1' || strpos($ip, '192.168.') === 0 || strpos($ip, '10.') === 0) {
                return 'IP privada (Red interna)';
            }
    
            $url = "http://ip-api.com/json/{$ip}?fields=status,country,regionName,city";
            $respuesta = @file_get_contents($url);
            $datos = json_decode($respuesta, true);
    
            if ($datos && $datos['status'] === 'success') {
                return "{$datos['city']}, {$datos['regionName']}, {$datos['country']}";
            }
    
            return 'Ubicación desconocida';
        }
    
        // Enviar correo de inicio de sesión
        public function enviarSesion() {
            $mail = new PHPMailer();
    
            // Configuración SMTP
            $mail->isSMTP();
            $mail->Host = $_ENV['EMAIL_HOST'];
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['EMAIL_USER'];
            $mail->Password = $_ENV['EMAIL_PASS'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = $_ENV['EMAIL_PORT'];
    
            // Obtener IP y ubicación real del usuario
            $ipUsuario = $this->obtenerIPUsuario();
            $ubicacionUsuario = $this->obtenerUbicacion($ipUsuario);
    
            // Configurar el correo
            $mail->setFrom('pruebas@odonto.megawebsistem.com', 'Odonto Seguridad');
            $mail->addAddress($this->email);
    
            $mail->Subject = 'Notificación de Inicio de Sesión';
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
    
            // Configurar la zona horaria de Ecuador
            date_default_timezone_set('America/Guayaquil');
    
            // Formatear la fecha en español
            $formatter = new IntlDateFormatter(
                'es_EC',
                IntlDateFormatter::FULL,
                IntlDateFormatter::SHORT,
                'America/Guayaquil',
                IntlDateFormatter::GREGORIAN
            );
            $fechaHora = $formatter->format(new DateTime());
    
            // Contenido del email
            $contenido = '<html>';
            $contenido .= '<head><meta charset="UTF-8"></head>';
            $contenido .= '<body style="font-family: Arial, sans-serif; background-color: #f5f5f5; padding: 20px;">';
            $contenido .= '<div style="max-width: 600px; background-color: white; padding: 20px; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0,0,0,0.1);">';
            $contenido .= '<p style="text-align: right; color: #555;">Fecha: ' . $fechaHora . '</p>';
            $contenido .= '<h2 style="text-align: center; color: #333;">Ingreso a tu Cuenta</h2>';
            $contenido .= '<p><strong>' . htmlspecialchars($this->nombre) . '</strong>,</p>';
            $contenido .= '<p>Tu ingreso a la plataforma se realizó con éxito.</p>';
    
            // Tabla con detalles de inicio de sesión
            $contenido .= '<table style="width: 100%; border-collapse: collapse; margin-top: 10px;">';
            $contenido .= '<tr><th style="background-color: #f0f0f0; padding: 8px; text-align: left; border-bottom: 1px solid #ddd;">Detalle</th></tr>';
            $contenido .= '<tr><td style="padding: 8px; border-bottom: 1px solid #ddd;"><strong>IP:</strong> ' . $ipUsuario . '</td></tr>';
            $contenido .= '<tr><td style="padding: 8px;"><strong>Ubicación:</strong> ' . $ubicacionUsuario . '</td></tr>';
            $contenido .= '</table>';
    
            $contenido .= '<p style="margin-top: 15px;">Si no has solicitado este servicio, repórtalo a nuestro equipo de soporte.</p>';
            $contenido .= '<p>Gracias por utilizar nuestros servicios.</p>';
            $contenido .= '<p><strong>Atentamente,</strong><br>Equipo de Odonto</p>';
            $contenido .= '</div>';
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
    
  








