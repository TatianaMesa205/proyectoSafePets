<?php
session_start();

include_once "../model/loginModel.php";

class LoginControlador
{
    public function ctrLogin()
    {
        if (isset($_POST['nombre_usuario']) && isset($_POST['contrasena'])) {
            $nombre_usuario = trim($_POST['nombre_usuario']);
            $contrasena = $_POST['contrasena'];
            
            // Validate inputs
            if (empty($nombre_usuario) || empty($contrasena)) {
                echo json_encode(array("codigo" => "400", "mensaje" => "Todos los campos son obligatorios"));
                return;
            }
            
            $respuesta = LoginModelo::mdlLogin($nombre_usuario, $contrasena);

            if ($respuesta['codigo'] === "200") {
                $_SESSION['iniciarSesion'] = "ok";
                $_SESSION['id'] = $respuesta['usuario']['id'];
                $_SESSION['nombre_usuario'] = $respuesta['usuario']['nombre_usuario'];
                $_SESSION['rol'] = $respuesta['usuario']['rol'];
                
                if ($respuesta['usuario']['rol'] === 'admin') {
                    $respuesta['redirect'] = 'index.php?ruta=admin';
                } elseif ($respuesta['usuario']['rol'] === 'adoptante') {
                    $respuesta['redirect'] = 'index.php?ruta=inicioAdp';
                } else {
                    $respuesta['redirect'] = 'index.php?ruta=inicio';
                }
            }

            echo json_encode($respuesta);
        } else {
            echo json_encode(array("codigo" => "400", "mensaje" => "Datos incompletos"));
        }
    }

    public function ctrRegistro()
    {
        if (isset($_POST['nombre_usuario']) && isset($_POST['email']) && isset($_POST['contrasena'])) {
            $nombre_usuario = trim($_POST['nombre_usuario']);
            $email = trim($_POST['email']);
            $contrasena = $_POST['contrasena'];
            
            // Validate inputs
            if (empty($nombre_usuario) || empty($email) || empty($contrasena)) {
                echo json_encode(array("codigo" => "400", "mensaje" => "Todos los campos son obligatorios"));
                return;
            }
            
            // Validate email format
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo json_encode(array("codigo" => "400", "mensaje" => "El formato del email no es válido"));
                return;
            }
            
            // Validate password length
            if (strlen($contrasena) < 6) {
                echo json_encode(array("codigo" => "400", "mensaje" => "La contraseña debe tener al menos 6 caracteres"));
                return;
            }
            
            $respuesta = LoginModelo::mdlRegistrarUsuario($nombre_usuario, $email, $contrasena);
            echo json_encode($respuesta);
        } else {
            echo json_encode(array("codigo" => "400", "mensaje" => "Datos incompletos"));
        }
    }

    public function ctrCrearAdmin()
    {
        // Only allow if there's an active admin session
        if (isset($_SESSION['iniciarSesion']) && $_SESSION['rol'] === 'admin') {
            if (isset($_POST['nombre_usuario']) && isset($_POST['email']) && isset($_POST['contrasena'])) {
                $nombre_usuario = trim($_POST['nombre_usuario']);
                $email = trim($_POST['email']);
                $contrasena = $_POST['contrasena'];
                
                // Validate inputs
                if (empty($nombre_usuario) || empty($email) || empty($contrasena)) {
                    echo json_encode(array("codigo" => "400", "mensaje" => "Todos los campos son obligatorios"));
                    return;
                }
                
                $respuesta = LoginModelo::mdlCrearAdmin($nombre_usuario, $email, $contrasena);
                echo json_encode($respuesta);
            } else {
                echo json_encode(array("codigo" => "400", "mensaje" => "Datos incompletos"));
            }
        } else {
            echo json_encode(array("codigo" => "403", "mensaje" => "No tiene permisos para realizar esta acción"));
        }
    }

    public function ctrLogout()
    {
        $_SESSION = array();
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();
        echo json_encode(array("codigo" => "200", "mensaje" => "Sesión cerrada exitosamente"));
    }
}

if (isset($_POST['accion'])) {
    $login = new LoginControlador();
    try {
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
            default:
                echo json_encode(array("codigo" => "400", "mensaje" => "Acción no válida"));
        }
    } catch (Exception $e) {
        echo json_encode(array("codigo" => "500", "mensaje" => "Error interno del servidor"));
    }
} else {
    echo json_encode(array("codigo" => "400", "mensaje" => "No se especificó ninguna acción"));
}
