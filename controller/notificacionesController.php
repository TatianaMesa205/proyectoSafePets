<?php

if (file_exists("../model/notificacionesModel.php")) {
    require_once "../model/notificacionesModel.php";
} elseif (file_exists("model/notificacionesModel.php")) {
    require_once "model/notificacionesModel.php";
}



class NotificacionesController {


    static public function ctrVerificarNotificacion($idUsuario, $idMascota){
        // Llamamos al modelo que creamos anteriormente
        $respuesta = NotificacionesModel::verificarNotificacion($idUsuario, $idMascota);
        return $respuesta;
    }


    static public function ctrRegistrarNotificacion($datos){
        $respuesta = NotificacionesModel::registrarInteres($datos);
        return $respuesta;
    }

}

if (isset($_POST["activarCampana"])) {

    $data = [
        "id_mascotas" => $_POST["id_mascotas"],
        "id_usuarios" => $_POST["id_usuarios"],
        "email" => $_POST["email_usuario"]
    ];

    $resp = NotificacionesController::ctrRegistrarNotificacion($data);

    echo json_encode(["codigo" => $resp ? "200" : "400"]);
}