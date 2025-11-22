<?php

require_once __DIR__ . '/../vendor/autoload.php'; // Asegura la carga de PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Correo {

    public static function enviarCorreoCita($emailDestino, $nombreDestino, $fechaCita, $motivo) {
        $mail = new PHPMailer(true);

        try {
            // --- Configuración del Servidor SMTP ---
            // $mail->SMTPDebug = 0;                  // 0 para desactivar debug en producción (importante para AJAX)
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'carlosfernandosolergarzon@gmail.com'; // TU CORREO REAL
            $mail->Password   = 'uvnqknfkpxfabhgm'; // <--- SIN ESPACIOS
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;
            $mail->CharSet    = 'UTF-8';

            // --- Remitente y Destinatario ---
            $mail->setFrom('carlosfernandosolergarzon@gmail.com', 'SafePets Admin');
            $mail->addAddress($emailDestino, $nombreDestino);

            // --- Contenido del Correo ---
            $mail->isHTML(true);
            $mail->Subject = 'Confirmación de Cita - SafePets';
            
            $cuerpo = "
            <div style='font-family: Arial, sans-serif; padding: 20px; border: 1px solid #ddd; max-width: 600px;'>
                <h2 style='color: #27ae60;'>¡Hola $nombreDestino!</h2>
                <p>Tu cita ha sido agendada exitosamente en SafePets.</p>
                <hr>
                <p><strong>Detalles de la cita:</strong></p>
                <ul>
                    <li><strong>Fecha:</strong> $fechaCita</li>
                    <li><strong>Motivo:</strong> $motivo</li>
                    <li><strong>Estado:</strong> Pendiente de aprobación</li>
                </ul>
                <p>Nos pondremos en contacto contigo pronto si necesitamos más información.</p>
                <p style='font-size: 12px; color: #777;'>Este es un mensaje automático, por favor no responder.</p>
            </div>
            ";

            $mail->Body    = $cuerpo;
            $mail->AltBody = "Hola $nombreDestino. Tu cita para el $fechaCita ha sido agendada. Motivo: $motivo.";

            $mail->send();
            return true;

        } catch (Exception $e) {
            // Guardamos el error en el log del servidor, no lo imprimimos
            error_log("Error enviando correo: {$mail->ErrorInfo}");
            return false;
        }
    }
}