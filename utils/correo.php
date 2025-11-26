<?php

require_once __DIR__ . '/../vendor/autoload.php'; 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Correo {

    // 1. Correo de Registro
    public static function enviarCorreoCita($emailDestino, $nombreDestino, $fechaCita, $motivo) {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'carlosfernandosolergarzon@gmail.com'; 
            $mail->Password   = 'uvnqknfkpxfabhgm'; // <--- CORREGIDO: SIN ESPACIOS
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;
            $mail->CharSet    = 'UTF-8';

            $mail->setFrom('carlosfernandosolergarzon@gmail.com', 'SafePets Admin');
            $mail->addAddress($emailDestino, $nombreDestino);

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
                <p>Nos pondremos en contacto contigo pronto.</p>
            </div>
            ";

            $mail->Body = $cuerpo;
            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    // 2. Correo de Modificación
    public static function enviarCorreoModificacion($emailDestino, $nombreDestino, $fechaNueva, $motivo, $estado) {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'carlosfernandosolergarzon@gmail.com'; 
            $mail->Password   = 'uvnqknfkpxfabhgm'; 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;
            $mail->CharSet    = 'UTF-8';

            $mail->setFrom('carlosfernandosolergarzon@gmail.com', 'SafePets Admin');
            $mail->addAddress($emailDestino, $nombreDestino);

            $mail->isHTML(true);
            $mail->Subject = 'Actualización de tu Cita - SafePets';
            
            $cuerpo = "
            <div style='font-family: Arial, sans-serif; padding: 20px; border: 1px solid #ffc107; max-width: 600px;'>
                <h2 style='color: #d35400;'>Tu cita ha sido modificada</h2>
                <p>Hola <strong>$nombreDestino</strong>, te informamos que hubo cambios en tu solicitud.</p>
                <hr>
                <p><strong>Nuevos detalles:</strong></p>
                <ul>
                    <li><strong>Nueva Fecha:</strong> $fechaNueva</li>
                    <li><strong>Motivo/Observación:</strong> $motivo</li>
                    <li><strong>Estado actual:</strong> $estado</li>
                </ul>
                <p>Si tienes dudas, contáctanos.</p>
            </div>
            ";

            $mail->Body = $cuerpo;
            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
?>