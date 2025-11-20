<?php

include_once "../model/adoptantesModel.php";

class AdoptantesController
{

    public $id_adoptantes;
    public $nombre_completo;
    public $cedula;
    public $telefono;
    public $email;
    public $direccion;

    public function ctrListarAdoptantes()
    {
        $objRespuesta = AdoptantesModel::mdlListarAdoptantes();
        echo json_encode($objRespuesta);
    }


    public function ctrEliminarAdoptante()
    {
        $objRespuesta = AdoptantesModel::mdlEliminarAdoptante($this->id_adoptantes);
        echo json_encode($objRespuesta);
    }

    public function ctrRegistrarAdoptante()
    {
        $objRespuesta = AdoptantesModel::mdlRegistrarAdoptante(
            $this->nombre_completo,
            $this->cedula,
            $this->telefono,
            $this->email,
            $this->direccion,

        );
        echo json_encode($objRespuesta);
    }

    public function ctrEditarAdoptante()
    {
        $objRespuesta = AdoptantesModel::mdlEditarAdoptante(
            $this->id_adoptantes, 
            $this->nombre_completo, 
            $this->cedula, 
            $this->telefono, 
            $this->email, 
            $this->direccion
        );
        echo json_encode($objRespuesta);
    }

    // Verifica si el usuario logueado ya es un adoptante registrado
    public function ctrVerificarPerfilAdoptante()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['email'])) {
            echo json_encode(["codigo" => "401", "mensaje" => "No hay sesión activa"]);
            return;
        }

        $email = $_SESSION['email'];
        // Si no existe mdlMostrarAdoptante en el modelo, obtenemos la lista completa y buscamos por email
        $respuesta = false;
        $lista = AdoptantesModel::mdlListarAdoptantes();
        if (is_array($lista)) {
            foreach ($lista as $fila) {
                if (isset($fila['email']) && $fila['email'] === $email) {
                    $respuesta = $fila;
                    break;
                }
            }
        }

        if ($respuesta) {
            // Si existe, devolvemos success y el ID del adoptante
            echo json_encode(["codigo" => "200", "existe" => true, "id_adoptantes" => $respuesta["id_adoptantes"]]);
        } else {
            // Si no existe
            echo json_encode(["codigo" => "200", "existe" => false]);
        }
    }

}

if (isset($_POST["listarAdoptantes"]) && $_POST["listarAdoptantes"] == "ok") {
    $objAdoptantes = new AdoptantesController();
    $objAdoptantes->ctrListarAdoptantes();
}

if (isset($_POST["eliminarAdoptante"]) && $_POST["eliminarAdoptante"] == "ok") {
    $objAdoptantes = new AdoptantesController();
    $objAdoptantes->id_adoptantes = $_POST["id_adoptantes"];
    $objAdoptantes->ctrEliminarAdoptante();
}

if (isset($_POST["registrarAdoptante"]) && $_POST["registrarAdoptante"] == "ok") {
    $objAdoptantes = new AdoptantesController();
    $objAdoptantes->nombre_completo = $_POST["nombre_completo"];
    $objAdoptantes->cedula = $_POST["cedula"];
    $objAdoptantes->telefono = $_POST["telefono"];
    $objAdoptantes->email = $_POST["email"];
    $objAdoptantes->direccion = $_POST["direccion"];
    $objAdoptantes->ctrRegistrarAdoptante();
}

if (isset($_POST["editarAdoptante"]) && $_POST["editarAdoptante"] == "ok") {
    $objAdoptantes = new AdoptantesController();

    $objAdoptantes->nombre_completo = $_POST["nombre_completo"];
    $objAdoptantes->cedula = $_POST["cedula"];
    $objAdoptantes->telefono = $_POST["telefono"];
    $objAdoptantes->email = $_POST["email"];
    $objAdoptantes->direccion = $_POST["direccion"];
    $objAdoptantes->id_adoptantes = $_POST["id_adoptantes"];

    $objAdoptantes->ctrEditarAdoptante();
}

// --- NO OLVIDES AGREGAR EL MANEJO DE LA PETICIÓN AL FINAL DEL ARCHIVO ---

if (isset($_POST["verificarPerfil"]) && $_POST["verificarPerfil"] == "ok") {
    $obj = new AdoptantesController();
    $obj->ctrVerificarPerfilAdoptante();
}
