<?php
// 1. Configuración inicial segura
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Limpiar cualquier salida previa
ob_start();

// Cabecera JSON
header('Content-Type: application/json; charset=utf-8');

// Incluir modelo de Login
$modelPath = __DIR__ . '/../model/loginModel.php';
if (!file_exists($modelPath)) {
    echo json_encode(['codigo' => '500', 'mensaje' => "Modelo loginModel no encontrado."]);
    exit;
}
require_once $modelPath;

// Incluir modelo de Adoptantes (para editar perfil completo si aplica)
$adpModelPath = __DIR__ . '/../model/adoptantesModel.php';
if (file_exists($adpModelPath)) {
    require_once $adpModelPath;
}

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

    // --- FUNCIÓN ACTUALIZADA PARA PERFIL ---
    public function ctrActualizarPerfil() {
        try {
            if (!isset($_SESSION['iniciarSesion']) || !isset($_SESSION['id'])) {
                echo json_encode(["codigo" => "403", "mensaje" => "No autorizado"]);
                return;
            }
    
            $idUsuario = $_SESSION['id'];
            $rol = $_SESSION['rol']; 
            $nuevoNombre = $_POST['nombre_usuario'] ?? '';
            $nuevaPass = $_POST['password'] ?? ''; 
    
            if (empty($nuevoNombre)) {
                echo json_encode(["codigo" => "400", "mensaje" => "El nombre es obligatorio"]);
                return;
            }
    
            // 1. Actualizar tabla USUARIOS
            $respuesta = LoginModelo::mdlActualizarPerfil($idUsuario, $nuevoNombre, $nuevaPass);
    
            if ($respuesta['codigo'] == "200") {
                // Actualizar nombre en sesión
                $_SESSION['nombre_usuario'] = $nuevoNombre;

                // 2. Verificar si se enviaron datos de ADOPTANTE para actualizar
                if (isset($_POST['editar_adoptante']) && $_POST['editar_adoptante'] == "true") {
                    
                    if (class_exists('AdoptantesModel')) {
                        $idAdp = $_POST['id_adoptantes'];
                        $nomAdp = $_POST['nombre_completo'];
                        $cedAdp = $_POST['cedula'];
                        $telAdp = $_POST['telefono'];
                        $dirAdp = $_POST['direccion'];
                        $emailAdp = $_POST['email_adoptante']; // Requerido por el modelo

                        // Llamar al modelo de adoptantes
                        $resAdp = AdoptantesModel::mdlEditarAdoptante($idAdp, $nomAdp, $cedAdp, $telAdp, $emailAdp, $dirAdp);

                        if ($resAdp['codigo'] != "200") {
                            // Si falla la parte del adoptante, avisamos adjuntando el error
                            $respuesta['mensaje'] .= " (Advertencia: " . $resAdp['mensaje'] . ")";
                        }
                    }
                }

                // Definir a dónde enviar al usuario según su rol
                if ($rol === 'admin') {
                    $respuesta['redirect'] = 'index.php?ruta=inicioAdmin'; 
                } else {
                    $respuesta['redirect'] = 'index.php?ruta=inicioAdp'; 
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
}
?>