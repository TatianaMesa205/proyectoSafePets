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
            <div style='
                font-family: Arial, sans-serif;
                background: #f7f2ec;
                padding: 25px;
                border-radius: 15px;
                border: 1px solid #e6daca;
                max-width: 620px;
                margin: auto;
            '>
                <div style='text-align: center; margin-bottom: 20px;'>
                    <h2 style='color: #b78f67; margin: 0; font-weight: bold;'>¡Hola $nombreDestino!</h2>
                    <p style='color: #7a6a58; margin: 5px 0; font-size: 15px;'>
                        Tu cita ha sido agendada exitosamente en SafePets 
                    </p>
                </div>

                <div style='
                    background: #fffdf9;
                    padding: 20px;
                    border-radius: 12px;
                    border-left: 5px solid #d4b699;
                    border-right: 1px solid #e6daca;
                    border-top: 1px solid #e6daca;
                    border-bottom: 1px solid #e6daca;
                    box-shadow: 0 3px 8px rgba(0,0,0,0.05);
                    margin-bottom: 15px;
                '>
                    <p style='font-size: 15px; color: #5f5144; margin-bottom: 8px;'>
                        <strong style='color:#8c6f54;'>Detalles de la cita:</strong>
                    </p>

                    <ul style='font-size: 14px; color: #5f5144; padding-left: 18px; line-height: 1.6;'>
                        <li><strong style='color:#8c6f54;'>Fecha:</strong> $fechaCita</li>
                        <li><strong style='color:#8c6f54;'>Motivo:</strong> $motivo</li>
                        <li><strong style='color:#8c6f54;'>Estado:</strong> Pendiente de aprobación</li>
                    </ul>
                </div>

                <div style='text-align: center;'>
                    <p style='font-size: 13px; color: #8b7b6b; margin-top: 10px;'>
                        Nos pondremos en contacto contigo muy pronto<br>
                        Gracias por confiar en <strong>SafePets</strong> 🤎.
                    </p>
                </div>
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
            <div style='
                font-family: Arial, sans-serif;
                background: #f7f2ec;
                padding: 25px;
                border-radius: 15px;
                border: 1px solid #e6daca;
                max-width: 620px;
                margin: auto;
            '>
                <div style='text-align: center; margin-bottom: 20px;'>
                    <h2 style='color: #b78f67; margin: 0; font-weight: bold;'>Tu cita ha sido modificada</h2>
                    <p style='color: #7a6a58; margin: 5px 0; font-size: 15px;'>
                        Hola <strong>$nombreDestino</strong>, queremos informarte que tu cita ha sido actualizada 
                    </p>
                </div>

                <div style='
                    background: #fffdf9;
                    padding: 20px;
                    border-radius: 12px;
                    border-left: 5px solid #d4b699;
                    border-right: 1px solid #e6daca;
                    border-top: 1px solid #e6daca;
                    border-bottom: 1px solid #e6daca;
                    box-shadow: 0 3px 8px rgba(0,0,0,0.05);
                    margin-bottom: 15px;
                '>
                    <p style='font-size: 15px; color: #5f5144; margin-bottom: 10px;'>
                        <strong style='color:#8c6f54;'>Nuevos detalles:</strong>
                    </p>

                    <ul style='font-size: 14px; color: #5f5144; padding-left: 18px;'>
                        <li><strong style='color:#8c6f54;'>Nueva Fecha:</strong> $fechaNueva</li>
                        <li><strong style='color:#8c6f54;'>Motivo/Observación:</strong> $motivo</li>
                        <li><strong style='color:#8c6f54;'>Estado actual:</strong> $estado</li>
                    </ul>
                </div>

                <div style='text-align: center;'>
                    <p style='font-size: 13px; color: #8b7b6b; margin-top: 10px;'>
                        Si necesitas más información, puedes ingresar a <strong>SafePets</strong> o contactarnos 🤎
                    </p>
                </div>
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
            $mail->Subject = 'Cita Cancelada - SafePets';

            $cuerpo = "
            <div style='
                font-family: Arial, sans-serif;
                background: #f7f2ec;
                padding: 25px;
                border-radius: 15px;
                border: 1px solid #e6daca;
                max-width: 620px;
                margin: auto;
            '>
                <div style='text-align: center; margin-bottom: 20px;'>
                    <h2 style='color: #b78f67; margin: 0; font-weight: bold;'>Cita Cancelada</h2>
                    <p style='color: #7a6a58; margin: 5px 0; font-size: 15px;'>
                        Tu cita ha sido cancelada en SafePets 
                    </p>
                </div>

                <div style='
                    background: #fffdf9;
                    padding: 20px;
                    border-radius: 12px;
                    border-left: 5px solid #d4b699;
                    border-right: 1px solid #e6daca;
                    border-top: 1px solid #e6daca;
                    border-bottom: 1px solid #e6daca;
                    box-shadow: 0 3px 8px rgba(0,0,0,0.05);
                '>
                    <p style='font-size: 15px; color: #5f5144; margin: 0 0 10px 0;'>
                        <strong style='color:#8c6f54;'>Mascota:</strong> {$mascota}
                    </p>
                    <p style='font-size: 15px; color: #5f5144; margin: 0;'>
                        <strong style='color:#8c6f54;'>Fecha de la cita:</strong> {$fechaCita}
                    </p>
                </div>

                <br>

                <div style='text-align: center;'>
                    <p style='font-size: 13px; color: #8b7b6b; margin-top: 10px;'>
                        Este mensaje fue enviado automáticamente por <strong>SafePets</strong> 🤎<br>
                        Si crees que esto es un error, contáctanos a través de la plataforma.
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


    public static function enviarCorreoNotificacionMascota($emailDestino, $nombreDestino, $nombreMascota) {
        $mail = new PHPMailer(true);

        try {
            // Configuración SMTP
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'carlosfernandosolergarzon@gmail.com';
            $mail->Password   = 'uvnqknfkpxfabhgm'; 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;
            $mail->CharSet    = 'UTF-8';

            $mail->setFrom('carlosfernandosolergarzon@gmail.com', 'SafePets');
            $mail->addAddress($emailDestino, $nombreDestino);

            // Contenido
            $mail->isHTML(true);
            $mail->Subject = "Notificación de Mascota - SafePets";

            $cuerpo = "
            <div style='
                font-family: Arial, sans-serif;
                background: #f7f2ec;
                padding: 25px;
                border-radius: 15px;
                border: 1px solid #e6daca;
                max-width: 600px;
                margin: auto;
            '>
                <div style='text-align: center;'>
                    <h2 style='color: #b78f67; margin-bottom: 10px;'>
                        ¡Buenas noticias, $nombreDestino!
                    </h2>
                </div>

                <p style='font-size: 15px; color: #6b5e52; line-height: 1.6;'>
                    La mascota que te interesa, <strong style='color:#8c6f54;'>$nombreMascota</strong>, 
                    ahora está <strong style='color:#7c9c63;'>DISPONIBLE</strong> para adopción.
                </p>

                <div style='
                    background: #fffdf9;
                    padding: 15px;
                    border-radius: 12px;
                    border: 1px solid #e6daca;
                    margin-top: 15px;
                    text-align: center;
                '>
                    <p style='color:#8c745e; font-size: 14px; margin: 0;'>
                        Puedes ingresar a SafePets para ver más detalles
                        y continuar con el proceso de adopción.
                    </p>
                </div>

                <p style='font-size: 14px; color: #7b6a5a; margin-top: 25px; text-align:center;'>
                    Gracias por confiar en <strong>SafePets</strong>. 🤎<br>
                    ¡Esperamos que encuentres a tu compañero ideal!
                </p>
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

