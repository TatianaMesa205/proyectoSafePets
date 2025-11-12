<?php


// 1. Cargamos todas las librerías necesarias
// Carga la librería de Stripe (de la carpeta 'vendor/')
require_once 'vendor/autoload.php';
// Carga tu conexión a la BD
include_once "model/conexion.php";
// Carga tu modelo de donaciones (del Paso 2)
include_once "model/donacionesModel.php";

// 2. Configura tu Clave Secreta de Stripe
// !! REEMPLAZA ESTO con tu Clave Secreta (sk_test_...) !!
$clave_secreta_stripe = "sk_test_51SSSa5KPG83aCazKI9WoRZDpJHtVNYnwNRf4hoeBQUMYZYhonpefoG90dvhSTe4y9LEDm3Yoec1X5hothiP5Rrf000AozL9pbI";
\Stripe\Stripe::setApiKey($clave_secreta_stripe);

// 3. Configura tu "Secreto del Webhook" (Endpoint Secret)
// Lo obtendrás en el Paso 7, desde tu panel de Stripe.
// !! REEMPLAZA ESTO por el secreto 'whsec_...' !!
$endpoint_secret = 'whsec_d3cc202a7620a4ed79dd0fca53972b8c7f60da4994d78f6c493f1e1adaa3d88f';

// 4. Lee la información enviada por Stripe
$payload = @file_get_contents('php://input');
$sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
$event = null;

try {
    // 5. Verifica la firma (¡VITAL para seguridad!)
    // Esto comprueba que la notificación viene de Stripe y no de un atacante.
    $event = \Stripe\Webhook::constructEvent(
        $payload, $sig_header, $endpoint_secret
    );
} catch(\UnexpectedValueException $e) {
    // Payload inválido
    http_response_code(400);
    exit();
} catch(\Stripe\Exception\SignatureVerificationException $e) {
    // Firma inválida
    http_response_code(400);
    exit();
}

// 6. Maneja el evento (Solo nos importa 'checkout.session.completed')
if ($event->type == 'checkout.session.completed') {
    $session = $event->data->object; // La sesión de pago completada
    
    // 7. Extrae los datos que nos importan
    
    // Este es el 'codigo_referencia' que guardamos en la BD
    $codigo_referencia = $session->client_reference_id; 
    
    // Este es el ID de la transacción (ej: 'pi_...')
    $transaccion_id_externa = $session->payment_intent; 
    
    // El método de pago que usó el cliente (ej: 'card', 'pse', 'nequi')
    $metodo_pago = $session->payment_method_types[0] ?? 'desconocido';
    
    // El estado final del pago
    $estado_pago_stripe = $session->payment_status; // Debería ser "paid"

    // 8. Traduce el estado de Stripe a nuestro estado de la BD
    $estado_db = "fallido"; // Por defecto
    if ($estado_pago_stripe == "paid") {
        $estado_db = "aprobado";
    }

    // 9. ¡Actualiza la base de datos!
    // Llama a la función que creamos en 'donacionesModel.php' (Paso 2)
    DonacionesModel::mdlActualizarDonacionPorReferencia(
        $codigo_referencia, 
        $estado_db, 
        $transaccion_id_externa, 
        $metodo_pago
    );
}

// 10. Responde a Stripe con un "200 OK"
// Esto le dice a Stripe: "Recibí la notificación, no me la envíes de nuevo."
http_response_code(200);
echo "Evento recibido.";
?>