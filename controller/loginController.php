<?php
session_start();

include_once "../model/loginModel.php";

class LoginControlador
{
    public function ctrLogin()
    {
        if (isset($_POST['nombre_usuario']) && isset($_POST['contrasena'])) {
            $nombre_usuario = $_POST['nombre_usuario'];
            $contrasena = $_POST['contrasena'];
            $respuesta = LoginModelo::mdlLogin($nombre_usuario, $contrasena);

            if ($respuesta['codigo'] === "200") {
                $_SESSION['iniciarSesion'] = "ok";
                $_SESSION['id'] = $respuesta['usuario']['id'];
                $_SESSION['nombre_usuario'] = $respuesta['usuario']['nombre_usuario'];
                $_SESSION['rol'] = $respuesta['usuario']['rol'];
            }

            echo json_encode($respuesta);
        }
    }

    public function ctrRegistro()
    {
        if (isset($_POST['nombre_usuario']) && isset($_POST['email']) && isset($_POST['contrasena'])) {
            $nombre_usuario = $_POST['nombre_usuario'];
            $email = $_POST['email'];
            $contrasena = $_POST['contrasena'];
            
            $respuesta = LoginModelo::mdlRegistrarUsuario($nombre_usuario, $email, $contrasena);
            echo json_encode($respuesta);
        }
    }

    public function ctrCrearAdmin()
    {
        // Solo permitir si hay una sesión activa de admin
        if (isset($_SESSION['iniciarSesion']) && $_SESSION['rol'] === 'admin') {
            if (isset($_POST['nombre_usuario']) && isset($_POST['email']) && isset($_POST['contrasena'])) {
                $nombre_usuario = $_POST['nombre_usuario'];
                $email = $_POST['email'];
                $contrasena = $_POST['contrasena'];
                
                $respuesta = LoginModelo::mdlCrearAdmin($nombre_usuario, $email, $contrasena);
                echo json_encode($respuesta);
            }
        } else {
            echo json_encode(array("codigo" => "403", "mensaje" => "No tiene permisos para realizar esta acción"));
        }
    }

    public function ctrLogout()
    {
        session_destroy();
        echo json_encode(array("codigo" => "200", "mensaje" => "Sesión cerrada exitosamente"));
    }
}

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
    }
}