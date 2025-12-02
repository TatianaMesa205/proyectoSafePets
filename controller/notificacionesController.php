<?php
require_once "../model/notificacionesModel.php";
require_once "../utils/correo.php";

if (isset($_POST["activarCampana"])) {

    $data = [
        "id_mascotas" => $_POST["id_mascotas"],
        "id_usuarios" => $_POST["id_usuarios"],
        "email" => $_POST["email_usuario"]
    ];

    // SOLO registrar, NO enviar correo
    $resp = NotificacionesModel::registrarInteres($data);

    echo json_encode(["codigo" => $resp ? "200" : "400"]);
    
}
