<?php

session_start(); 

require_once '../vendor/autoload.php';
include_once "../model/donacionesModel.php";

class DonacionesController
{
    
    public $id_donaciones;
    public $id_usuarios;
    public $codigo_referencia;
    public $monto;
    public $estado_pago;
    public $fecha;
    public $metodo_pago;
    
    private $stripe;

    public function __construct() {

        $clave_secreta_stripe = "sk_test_51SSSa5KPG83aCazKI9WoRZDpJHtVNYnwNRf4hoeBQUMYZYhonpefoG90dvhSTe4y9LEDm3Yoec1X5hothiP5Rrf000AozL9pbI";
        $this->stripe = new \Stripe\StripeClient($clave_secreta_stripe);
    }

    public function ctrRegistrarDonacion()
    {
    
        $codigo_referencia = "SP-DON-" . uniqid(); 
        $monto = $this->monto;
        $id_usuarios = $this->id_usuarios; 
        
        $registroDb = DonacionesModel::mdlRegistrarDonacion($id_usuarios, $monto, $codigo_referencia);

        
        if ($registroDb["codigo"] != "200") {
            echo json_encode(["codigo" => "500", "mensaje" => "Error al registrar la donación en la BD."]);
            return;
        }

        
        $urlBase = "https://winnifred-unfilterable-preachily.ngrok-free.dev/proyectoSafePets";
        
        
        $success_url = $urlBase . "/gracias.php"; 
        
        
        $cancel_url = $urlBase . "/cancelado.php";

        try {
            //  Crear la Sesión de Pago en Stripe 
            $session = $this->stripe->checkout->sessions->create([
                
                // Métodos de pago           
                'payment_method_types' => ['card'], 
                
                // Los productos a cobrar
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'cop', // Moneda colombiana
                        'product_data' => [
                            'name' => 'Donación para Safe Pets',
                            'images' => ['https://i.imgur.com/UvNf02E.png'], // Puedes cambiar esta imagen
                        ],
                        
                        'unit_amount' => $monto * 100, 
                    ],
                    'quantity' => 1,
                ]],
                
                'mode' => 'payment',
                'success_url' => $success_url, // URL de éxito
                'cancel_url' => $cancel_url,   // URL de cancelación
                
                //  Vincula esta sesión de Stripe con tu registro en la BD
                'client_reference_id' => $codigo_referencia 
            ]);

            // Devolver el ID de la sesión al JavaScript 
            echo json_encode(['codigo' => '200', 'sessionId' => $session->id]);

        } catch (Exception $e) {
            // Si Stripe da un error
            echo json_encode(['codigo' => '500', 'mensaje' => 'Error de Stripe: ' . $e->getMessage()]);
        }
    }


  

    public function ctrListarDonaciones()
    {
        $objRespuesta = DonacionesModel::mdlListarDonaciones();
        echo json_encode($objRespuesta);
    }

    public function ctrEliminarDonacion()
    {
        $objRespuesta = DonacionesModel::mdlEliminarDonacion($this->id_donaciones);
        echo json_encode($objRespuesta);
    }

    public function ctrEditarDonacion()
    {
        $objRespuesta = DonacionesModel::mdlEditarDonacion(
            $this->id_donaciones,
            $this->id_usuarios,
            $this->monto,
            $this->fecha,
            $this->metodo_pago
        );
        echo json_encode($objRespuesta);
    }
}



if (isset($_POST["listarDonaciones"]) && $_POST["listarDonaciones"] == "ok") {
    $obj = new DonacionesController();
    $obj->ctrListarDonaciones();
}

if (isset($_POST["eliminarDonacion"]) == "ok") {
    $obj = new DonacionesController();
    $obj->id_donaciones = $_POST["id_donaciones"];
    $obj->ctrEliminarDonacion();
}

// ESTA RUTA ES LA QUE SE LLAMARÁ DESDE EL JS
if (isset($_POST["registrarDonacion"]) == "ok") {
    $obj = new DonacionesController();
    
    // Verificamos que el usuario haya iniciado sesión
    if (!isset($_SESSION['id'])) {
        echo json_encode(["codigo" => "403", "mensaje" => "No has iniciado sesión."]);
        exit;
    }
    
    $obj->id_usuarios = $_SESSION['id']; // Obtenemos el ID del usuario logueado
    $obj->monto = $_POST["monto"];       // Obtenemos el monto del JS
    
    $obj->ctrRegistrarDonacion(); // Llamamos a la nueva función de Stripe
}

if (isset($_POST["editarDonacion"]) == "ok") {
    $obj = new DonacionesController();
    $obj->id_donaciones = $_POST["id_donaciones"];
    $obj->id_usuarios = $_POST["id_usuarios"];
    $obj->monto = $_POST["monto"];
    $obj->fecha = $_POST["fecha"];
    $obj->metodo_pago = $_POST["metodo_pago"];
    $obj->ctrEditarDonacion();
}
?>