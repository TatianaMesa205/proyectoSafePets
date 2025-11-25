<?php
ob_start(); // Inicia el buffer para evitar errores de cabeceras

// --- CORRECCIÓN DE RUTAS (SOLUCIÓN A TUS WARNINGS) ---
// Usamos __DIR__ para obligar a que la ruta sea absoluta desde este archivo
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

    // --- ESTE ES EL MÉTODO QUE TE FALTABA (SOLUCIÓN AL FATAL ERROR) ---
    static public function ctrContarCitas(){
        return CitasModel::mdlContarCitas(); 
    }
    
    // Método auxiliar por si lo llamas de otra forma
    static public function ctrContarCitasPendientes(){
        return CitasModel::mdlContarCitas();
    }

    public function ctrListarCitas()
    {
        $objRespuestaCitas = CitasModel::mdlListarCitas();
        ob_clean(); 
        header('Content-Type: application/json');
        echo json_encode($objRespuestaCitas);
        die();
    }

    public function ctrEliminarCita()
    {
        $objRespuestaCitas = CitasModel::mdlEliminarCita($this->id_citas);
        ob_clean();
        header('Content-Type: application/json');
        echo json_encode($objRespuestaCitas);
        die();
    }

    public function ctrRegistrarCita()
    {
        // 1. Registrar la cita
        $objRespuestaCitas = CitasModel::mdlRegistrarCita(
            $this->id_adoptantes,
            $this->id_mascotas,
            $this->fecha_cita,
            $this->estado,
            $this->motivo
        );

        // 2. Enviar correo si se guardó bien
        if (isset($objRespuestaCitas["codigo"]) && $objRespuestaCitas["codigo"] == "200") {
            try {
                $adoptante = AdoptantesModel::mdlMostrarAdoptante("id_adoptantes", $this->id_adoptantes);
                if ($adoptante) {
                    // Usamos la clase Correo corregida
                    Correo::enviarCorreoCita(
                        $adoptante["email"], 
                        $adoptante["nombre_completo"], 
                        $this->fecha_cita, 
                        $this->motivo
                    );
                }
            } catch (Throwable $e) {
                // Si falla el correo, continuamos sin romper el proceso
            }
        }

        ob_clean();
        header('Content-Type: application/json');
        echo json_encode($objRespuestaCitas); 
        die();
    }

    public function ctrEditarCita()
    {
        $objRespuestaCitas = CitasModel::mdlEditarCita(
            $this->id_citas, 
            $this->id_adoptantes, 
            $this->id_mascotas, 
            $this->fecha_cita, 
            $this->estado, 
            $this->motivo
        );

        // Enviar correo de modificación
        if (isset($objRespuestaCitas["codigo"]) && $objRespuestaCitas["codigo"] == "200") {
            try {
                $adoptante = AdoptantesModel::mdlMostrarAdoptante("id_adoptantes", $this->id_adoptantes);
                if ($adoptante) {
                    Correo::enviarCorreoModificacion(
                        $adoptante["email"], 
                        $adoptante["nombre_completo"], 
                        $this->fecha_cita, 
                        $this->motivo,
                        $this->estado
                    );
                }
            } catch (Throwable $e) {
                // Error silencioso
            }
        }

        ob_clean();
        header('Content-Type: application/json');
        echo json_encode($objRespuestaCitas);
        die();
    }

    public function ctrTraerFechas() {
        $fechas = CitasModel::mdlObtenerFechasOcupadas();
        ob_clean();
        header('Content-Type: application/json');
        echo json_encode($fechas);
        die();
    }
}

// =======================================================
// MANEJO DE PETICIONES AJAX (POST)
// =======================================================

if (isset($_POST["traerFechas"]) == "ok") {
    $obj = new CitasController();
    $obj->ctrTraerFechas();
}

if (isset($_POST["listarCitas"]) == "ok") {
    $objCitas = new CitasController();
    $objCitas->ctrListarCitas();
}

if (isset($_POST["eliminarCita"]) == "ok") {
    $objCitas = new CitasController();
    $objCitas->id_citas = $_POST["id_citas"];
    $objCitas->ctrEliminarCita();
}

if (isset($_POST["registrarCita"]) == "ok") {
    $objCitas = new CitasController();
    $objCitas->id_adoptantes = $_POST["id_adoptantes"];
    $objCitas->id_mascotas = $_POST["id_mascotas"];
    $objCitas->fecha_cita = $_POST["fecha_cita"];
    $objCitas->estado = $_POST["estado"];
    $objCitas->motivo = $_POST["motivo"];
    $objCitas->ctrRegistrarCita();
}

if (isset($_POST["editarCita"]) == "ok") {
    $objCitas = new CitasController();
    $objCitas->id_citas = $_POST["id_citas"];
    $objCitas->id_adoptantes = $_POST["id_adoptantes"];
    $objCitas->id_mascotas = $_POST["id_mascotas"];
    $objCitas->fecha_cita = $_POST["fecha_cita"];
    $objCitas->estado = $_POST["estado"];
    $objCitas->motivo = $_POST["motivo"];
    $objCitas->ctrEditarCita();
}
?>