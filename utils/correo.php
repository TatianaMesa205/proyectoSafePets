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
            $mail->Password   = 'uvnqknfkpxfabhgm'; 
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


    public static function enviarCorreoCancelacion($emailDestino, $nombreDestino, $mascota, $fechaCita, $motivo) {
        $mail = new PHPMailer(true);
        try {
            // SMTP (coincidente con los correos que ya funcionan)
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'carlosfernandosolergarzon@gmail.com';
            $mail->Password   = 'uvnqknfkpxfabhgm';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;
            $mail->CharSet    = 'UTF-8';

            $mail->SMTPOptions = [
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                ]
            ];

            $mail->setFrom('carlosfernandosolergarzon@gmail.com', 'Safe Pets');
            $mail->addAddress($emailDestino, $nombreDestino);

            $mail->isHTML(true);
            $mail->Subject = '⚠️ Cita Cancelada - SafePets';

            $cuerpo = "
            <div style='
                font-family: Arial, sans-serif;
                background-color: #f8f9fa;
                padding: 25px;
                border-radius: 12px;
                border: 1px solid #e0e0e0;
                max-width: 650px;
                margin: auto;
            '>
                <div style='text-align: center; margin-bottom: 25px;'>
                    <img src='https://i.pinimg.com/1200x/82/6b/5d/826b5d746b40a10c844ffa8204da50ad.jpg' alt='SafePets' style='width: 150px; margin-bottom: 10px;'>
                    <h2 style='color: #c0392b; margin: 0;'> Cita Cancelada</h2>
                    <p style='color: #555; margin: 0; font-size: 15px;'>Tu cita ha sido cancelada en SafePets</p>
                </div>

                <div style='
                    background: #ffffff;
                    padding: 20px;
                    border-radius: 10px;
                    border-left: 5px solid #e74c3c;
                    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
                '>
                    <p style='font-size: 15px; color: #333;'>
                        <strong>Mascota:</strong> {$mascota}
                    </p>
                    <p style='font-size: 15px; color: #333;'>
                        <strong>Fecha de la cita:</strong> {$fechaCita}
                    </p>
                    <p style='font-size: 15px; color: #333;'>
                        <strong>Motivo de cancelación:</strong> {$motivo}
                    </p>
                </div>

                <br>

                <div style='text-align: center;'>
                    <p style='font-size: 13px; color: #888; margin-top: 15px;'>
                        Este mensaje fue enviado automáticamente por <strong>SafePets</strong>.<br>
                        Si crees que esto es un error, contacta a soporte.
                    </p>
                </div>
            </div>
            ";


            $mail->Body = $cuerpo;

            $mail->send();
            return true;

        } catch (Exception $e) {
            error_log("ERROR MAILER CANCEL (to: {$emailDestino}): " . $e->getMessage());
            return false;
        }
    }

}

?>

