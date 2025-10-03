<?php


session_start();
include_once "../model/loginModel.php";


header('Content-Type: application/json');

class LoginControlador {

    // --- FUNCIÓN DE INICIO DE SESIÓN ---
    public function ctrLogin() {
        try {
            if (!isset($_POST['nombre_usuario'], $_POST['contrasena'])) {
                throw new Exception("Faltan datos en el formulario.");
            }

            $nombre_usuario = trim($_POST['nombre_usuario']);
            $contrasena = $_POST['contrasena'];

            $respuesta = LoginModelo::mdlLogin($nombre_usuario, $contrasena);

            if ($respuesta['codigo'] === "200") {
                $_SESSION['iniciarSesion'] = "ok";
                $_SESSION['id'] = $respuesta['usuario']['id'];
                $_SESSION['nombre_usuario'] = $respuesta['usuario']['nombre_usuario'];
                $_SESSION['rol'] = $respuesta['usuario']['rol'];
                
                
                if ($respuesta['usuario']['rol'] === 'admin') {
                    $respuesta['redirect'] = 'index.php?ruta=inicioAdmin';
                } else {
                    $respuesta['redirect'] = 'index.php?ruta=inicioAdp';
                }
            }
            echo json_encode($respuesta);

        } catch (Exception $e) {
            echo json_encode(["codigo" => "500", "mensaje" => "Error en el servidor: " . $e->getMessage()]);
        }
    }

    // --- FUNCIÓN DE REGISTRO (Solo para rol "adoptante") ---
    public function ctrRegistro() {
        try {
            if (!isset($_POST['nombre_usuario'], $_POST['email'], $_POST['contrasena'])) {
                throw new Exception("Faltan datos en el formulario.");
            }

            $nombre_usuario = trim($_POST['nombre_usuario']);
            $email = trim($_POST['email']);
            $contrasena = $_POST['contrasena'];

            // Validaciones
            if (empty($nombre_usuario) || empty($email) || empty($contrasena)) {
                throw new Exception("Todos los campos son obligatorios.");
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception("El formato del email no es válido.");
            }
            if (strlen($contrasena) < 6) {
                throw new Exception("La contraseña debe tener al menos 6 caracteres.");
            }
            
            // Llama al modelo para registrar (el modelo le asignará el rol de adoptante por defecto)
            $respuesta = LoginModelo::mdlRegistrarUsuario($nombre_usuario, $email, $contrasena);
            echo json_encode($respuesta);

        } catch (Exception $e) {
            echo json_encode(["codigo" => "400", "mensaje" => $e->getMessage()]);
        }
    }

    // --- FUNCIÓN PARA CREAR NUEVOS ADMINS (Desde el panel de otro admin) ---
    public function ctrCrearAdmin() {
        // La lógica aquí es correcta: solo un admin logueado puede ejecutar esto.
        if (isset($_SESSION['iniciarSesion']) && $_SESSION['rol'] === 'admin') {
             if (isset($_POST['nombre_usuario'], $_POST['email'], $_POST['contrasena'])) {
                $nombre_usuario = trim($_POST['nombre_usuario']);
                $email = trim($_POST['email']);
                $contrasena = $_POST['contrasena'];
                $respuesta = LoginModelo::mdlCrearAdmin($nombre_usuario, $email, $contrasena);
                echo json_encode($respuesta);
            }
        } else {
            echo json_encode(["codigo" => "403", "mensaje" => "No tienes permisos para realizar esta acción."]);
        }
    }

    // --- FUNCIÓN DE CERRAR SESIÓN ---
    public function ctrLogout() {
        session_unset();
        session_destroy();
        echo json_encode(["codigo" => "200", "mensaje" => "Sesión cerrada exitosamente"]);
    }
}


// --- MANEJADOR DE ACCIONES ---
// Este bloque dirige la petición de JavaScript a la función correcta.
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
        default:
            echo json_encode(["codigo" => "400", "mensaje" => "Acción no válida."]);
    }
} else {
    echo json_encode(["codigo" => "400", "mensaje" => "No se especificó ninguna acción."]);
}
?>