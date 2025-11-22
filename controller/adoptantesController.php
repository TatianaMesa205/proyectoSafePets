<?php

// Asegurar ruta correcta al modelo y mostrar error claro si no existe
$modelPath = __DIR__ . '/../model/adoptantesModel.php';
if (!file_exists($modelPath)) {
    throw new Exception("Modelo adoptantesModel.php no encontrado en: $modelPath");
}
require_once $modelPath;

class AdoptantesController
{

    public $id_adoptantes;
    public $nombre_completo;
    public $cedula;
    public $telefono;
    public $email;
    public $direccion;

    /* ==============================================
       MÉTODO QUE FALTABA (IMPORTANTE)
       Busca el adoptante para el formulario de citas
       ============================================== */
    static public function ctrMostrarAdoptante($item, $valor)
    {
        $respuesta = AdoptantesModel::mdlMostrarAdoptante($item, $valor);
        return $respuesta;
    }

    /* ==============================================
       MÉTODO PARA EL BOTÓN "ADOPTAME" (AJAX)
       Verifica si el usuario ya es adoptante
       ============================================== */
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
        
        $respuesta = AdoptantesModel::mdlMostrarAdoptante("email", $email);

        if ($respuesta) {
            echo json_encode(["codigo" => "200", "existe" => true, "id_adoptantes" => $respuesta["id_adoptantes"]]);
        } else {
            echo json_encode(["codigo" => "200", "existe" => false]);
        }
    }

    /* ==============================================
       MÉTODOS CRUD
       ============================================== */

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
            $this->direccion
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

}

// =======================================================
// BLOQUE DE PETICIONES AJAX (Aquí estaba el problema)
// =======================================================

if (isset($_POST["listarAdoptantes"]) && $_POST["listarAdoptantes"] == "ok") {
    $objAdoptantes = new AdoptantesController();
    $objAdoptantes->ctrListarAdoptantes();
}

// --- ESTE BLOQUE FALTABA ---
if (isset($_POST["verificarPerfil"]) && $_POST["verificarPerfil"] == "ok") {
    $obj = new AdoptantesController();
    $obj->ctrVerificarPerfilAdoptante();
}
// ---------------------------

if (isset($_POST["eliminarAdoptante"]) == "ok") {
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

if (isset($_POST["editarAdoptante"]) == "ok") {
    $objAdoptantes = new AdoptantesController();
    $objAdoptantes->nombre_completo = $_POST["nombre_completo"];
    $objAdoptantes->cedula = $_POST["cedula"];
    $objAdoptantes->telefono = $_POST["telefono"];
    $objAdoptantes->email = $_POST["email"];
    $objAdoptantes->direccion = $_POST["direccion"];
    $objAdoptantes->id_adoptantes = $_POST["id_adoptantes"];
    $objAdoptantes->ctrEditarAdoptante();
}
?>