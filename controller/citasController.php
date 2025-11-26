<?php
ob_start(); 

include_once __DIR__ . "/../model/citasModel.php";
include_once __DIR__ . "/../model/adoptantesModel.php";
include_once __DIR__ . "/../utils/correo.php";

class CitasController
{
    public $id_citas;
    public $id_adoptantes;
    public $id_mascotas;
    public $fecha_cita;
    public $estado;
    public $motivo;

    static public function ctrContarCitas(){
        return CitasModel::mdlContarCitas(); 
    }
    
    public function ctrListarCitas() {
        $objRespuesta = CitasModel::mdlListarCitas();
        ob_clean(); header('Content-Type: application/json'); echo json_encode($objRespuesta); die();
    }

    public function ctrEliminarCita() {
        $objRespuesta = CitasModel::mdlEliminarCita($this->id_citas);
        ob_clean(); header('Content-Type: application/json'); echo json_encode($objRespuesta); die();
    }

    public function ctrRegistrarCita() {
        $objRespuesta = CitasModel::mdlRegistrarCita($this->id_adoptantes, $this->id_mascotas, $this->fecha_cita, $this->estado, $this->motivo);
        
        if (isset($objRespuesta["codigo"]) && $objRespuesta["codigo"] == "200") {
            try {
                $adoptante = AdoptantesModel::mdlMostrarAdoptante("id_adoptantes", $this->id_adoptantes);
                if ($adoptante) {
                    Correo::enviarCorreoCita($adoptante["email"], $adoptante["nombre_completo"], $this->fecha_cita, $this->motivo);
                }
            } catch (Throwable $e) {}
        }
        ob_clean(); header('Content-Type: application/json'); echo json_encode($objRespuesta); die();
    }

    public function ctrEditarCita() {
        $objRespuesta = CitasModel::mdlEditarCita($this->id_citas, $this->id_adoptantes, $this->id_mascotas, $this->fecha_cita, $this->estado, $this->motivo);

        if (isset($objRespuesta["codigo"]) && $objRespuesta["codigo"] == "200") {
            try {
                $adoptante = AdoptantesModel::mdlMostrarAdoptante("id_adoptantes", $this->id_adoptantes);
                if ($adoptante) {
                    Correo::enviarCorreoModificacion($adoptante["email"], $adoptante["nombre_completo"], $this->fecha_cita, $this->motivo, $this->estado);
                }
            } catch (Throwable $e) {}
        }

        ob_clean(); header('Content-Type: application/json'); echo json_encode($objRespuesta); die();
    }

    public function ctrTraerFechas() {
        $fechas = CitasModel::mdlObtenerFechasOcupadas();
        ob_clean(); header('Content-Type: application/json'); echo json_encode($fechas); die();
    }
}

// --- MANEJO DE PETICIONES ---

if (isset($_POST["traerFechas"]) == "ok") { $obj = new CitasController(); $obj->ctrTraerFechas(); }
if (isset($_POST["listarCitas"]) == "ok") { $obj = new CitasController(); $obj->ctrListarCitas(); }
if (isset($_POST["eliminarCita"]) == "ok") { $obj = new CitasController(); $obj->id_citas = $_POST["id_citas"]; $obj->ctrEliminarCita(); }

if (isset($_POST["registrarCita"]) == "ok") {
    $obj = new CitasController();
    $obj->id_adoptantes = $_POST["id_adoptantes"];
    $obj->id_mascotas = $_POST["id_mascotas"];
    $obj->fecha_cita = $_POST["fecha_cita"];
    $obj->estado = $_POST["estado"];
    $obj->motivo = $_POST["motivo"];
    $obj->ctrRegistrarCita();
}

if (isset($_POST["editarCita"]) == "ok") {
    $obj = new CitasController();
    $obj->id_citas = $_POST["id_citas"];
    $obj->id_adoptantes = $_POST["id_adoptantes"];
    $obj->id_mascotas = $_POST["id_mascotas"];
    $obj->fecha_cita = $_POST["fecha_cita"];
    $obj->estado = $_POST["estado"];
    $obj->motivo = $_POST["motivo"];
    $obj->ctrEditarCita();
}
?>