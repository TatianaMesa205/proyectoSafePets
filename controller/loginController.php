<?php
// 1. Configuración inicial segura
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Limpiar cualquier salida previa
ob_start();

// Cabecera JSON
header('Content-Type: application/json; charset=utf-8');

// Incluir modelo de forma segura
$modelPath = __DIR__ . '/../model/loginModel.php';
if (!file_exists($modelPath)) {
    echo json_encode(['codigo' => '500', 'mensaje' => "Modelo no encontrado: $modelPath"]);
    exit;
}
require_once $modelPath;

class LoginControlador {

    public function ctrLogin() {
        try {
            if (!isset($_POST['nombre_usuario'], $_POST['contrasena'])) {
                throw new Exception("Faltan datos.");
            }

            $nombre_usuario = trim($_POST['nombre_usuario']);
            $contrasena = $_POST['contrasena'];

            $respuesta = LoginModelo::mdlLogin($nombre_usuario, $contrasena);

            if ($respuesta['codigo'] === "200") {
                // Guardar datos en sesión
                $_SESSION['iniciarSesion'] = "ok";
                $_SESSION['id'] = $respuesta['usuario']['id']; 
                $_SESSION['nombre_usuario'] = $respuesta['usuario']['nombre_usuario'];
                $_SESSION['rol'] = $respuesta['usuario']['rol']; 
                $_SESSION['email'] = $respuesta['usuario']['email']; 
                
                // Definir redirección
                if ($_SESSION['rol'] === 'admin') {
                    $respuesta['redirect'] = 'index.php?ruta=inicioAdmin';
                } else {
                    $respuesta['redirect'] = 'index.php?ruta=inicioAdp';
                }
            }
            echo json_encode($respuesta);

        } catch (Exception $e) {
            echo json_encode(["codigo" => "500", "mensaje" => "Error: " . $e->getMessage()]);
        }
    }

    public function ctrRegistro() {
        try {
            $nombre = $_POST['nombre_usuario'] ?? '';
            $email = $_POST['email'] ?? '';
            $pass = $_POST['contrasena'] ?? '';
            
            if(empty($nombre) || empty($email) || empty($pass)){
                 throw new Exception("Datos incompletos");
            }

            $res = LoginModelo::mdlRegistrarUsuario($nombre, $email, $pass);
            echo json_encode($res);
        } catch (Exception $e) {
            echo json_encode(["codigo" => "500", "mensaje" => $e->getMessage()]);
        }
    }
    
    public function ctrCrearAdmin() {
        if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin') {
             $nombre = $_POST['nombre_usuario'] ?? '';
             $email = $_POST['email'] ?? '';
             $pass = $_POST['contrasena'] ?? '';
             
             $res = LoginModelo::mdlCrearAdmin($nombre, $email, $pass);
             echo json_encode($res);
        } else {
            echo json_encode(["codigo" => "403", "mensaje" => "No autorizado"]);
        }
    }

    // --- FUNCIÓN ACTUALIZADA CON REDIRECCIÓN ---
    public function ctrActualizarPerfil() {
        try {
            if (!isset($_SESSION['iniciarSesion']) || !isset($_SESSION['id'])) {
                echo json_encode(["codigo" => "403", "mensaje" => "No autorizado"]);
                return;
            }
    
            $idUsuario = $_SESSION['id'];
            $rol = $_SESSION['rol']; // Obtenemos el rol actual
            $nuevoNombre = $_POST['nombre_usuario'] ?? '';
            $nuevaPass = $_POST['password'] ?? ''; 
    
            if (empty($nuevoNombre)) {
                echo json_encode(["codigo" => "400", "mensaje" => "El nombre es obligatorio"]);
                return;
            }
    
            $respuesta = LoginModelo::mdlActualizarPerfil($idUsuario, $nuevoNombre, $nuevaPass);
    
            if ($respuesta['codigo'] == "200") {
                // Actualizar sesión
                $_SESSION['nombre_usuario'] = $nuevoNombre;

                // Definir a dónde enviar al usuario según su rol
                if ($rol === 'admin') {
                    $respuesta['redirect'] = 'inicioAdmin'; 
                } else {
                    $respuesta['redirect'] = 'inicioAdp'; 
                }
            }
    
            echo json_encode($respuesta);
    
        } catch (Exception $e) {
            echo json_encode(["codigo" => "500", "mensaje" => $e->getMessage()]);
        }
    }

    public function ctrLogout() {
        session_unset();
        session_destroy();
        echo json_encode(["codigo" => "200", "mensaje" => "Sesión cerrada"]);
    }
}

// Manejo de peticiones
if (isset($_POST['accion'])) {
    $login = new LoginControlador();
    switch ($_POST['accion']) {
        case 'login': 
            $login->ctrLogin(); 
            break;
        case 'registro': 
            $login->ctrRegistro(); 
            break;
        case 'crear_admin': 
            $login->ctrCrearAdmin(); 
            break;
        case 'logout': 
            $login->ctrLogout(); 
            break;
        case 'actualizar_perfil': 
            $login->ctrActualizarPerfil();
            break;
        default:
            echo json_encode(["codigo" => "400", "mensaje" => "Acción inválida"]);
    }
} else {
    // Respuesta por defecto si se llama sin acción
}
?>