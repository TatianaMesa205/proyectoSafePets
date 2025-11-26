<?php
ob_start(); // Inicia el buffer para evitar errores de headers

// --- CORRECCIÓN DE RUTAS ---
// Usamos __DIR__ para que las rutas sean absolutas relativas a este archivo
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

   
    static public function ctrContarCitasPendientes(){
        return CitasModel::mdlContarCitas();
    }
    
    static public function ctrContarCitas(){
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
        // 1. Registrar la cita en la Base de Datos
        $objRespuestaCitas = CitasModel::mdlRegistrarCita(
            $this->id_adoptantes,
            $this->id_mascotas,
            $this->fecha_cita,
            $this->estado,
            $this->motivo
        );

        // 2. Intentar enviar correo SOLO si el registro fue exitoso
        if (isset($objRespuestaCitas["codigo"]) && $objRespuestaCitas["codigo"] == "200") {
            try {
                $adoptante = AdoptantesModel::mdlMostrarAdoptante("id_adoptantes", $this->id_adoptantes);
                if ($adoptante) {
                    $email = $adoptante["email"];
                    $nombre = $adoptante["nombre_completo"];
                    // Enviamos el correo
                    Correo::enviarCorreoCita($email, $nombre, $this->fecha_cita, $this->motivo);
                }
            } catch (Throwable $e) {
                // Si falla el correo, continuamos sin interrumpir el JSON
            }
        }

        ob_clean();
        header('Content-Type: application/json');
        echo json_encode($objRespuestaCitas); 
        die();
    }

    public function ctrEditarCita()
    {
        $objRespuestaCitas = CitasModel::mdlEditarCita($this->id_citas, $this->id_adoptantes, $this->id_mascotas, $this->fecha_cita, $this->estado, $this->motivo);
        ob_clean();
        header('Content-Type: application/json');
        echo json_encode($objRespuestaCitas);
        die();
    }

    public function ctrCancelarCita()
    {
        $infoCita = CitasModel::mdlInfoCita($this->id_citas);

        if (!$infoCita) {
            echo json_encode(["codigo" => "404", "mensaje" => "Cita no encontrada"]);
            return;
        }

        // Validación de 48 horas
        $fechaCita = strtotime($infoCita["fecha_cita"]);
        $ahora = time();
        $diferenciaHoras = ($fechaCita - $ahora) / 3600;

        if ($diferenciaHoras < 48) {
            echo json_encode([
                "codigo" => "403",
                "mensaje" => "No es posible cancelar tan cerca de la hora acordada"
            ]);
            return;
        }

        // CANCELAR CITA EN BD
        $respuesta = CitasModel::mdlCancelarCita($this->id_citas);

        if ($respuesta["codigo"] == "200") {

            // LISTAR TODOS LOS ADMINISTRADORES
            $admins = CitasModel::mdlAdmins();

            foreach ($admins as $admin) {
                Correo::enviarCorreoCancelacion(
                    $admin["email"],
                    $admin["nombre_usuario"],
                    $infoCita["mascota"],
                    $infoCita["fecha_cita"],
                    $infoCita["motivo"]
                );
            }
        }

        echo json_encode($respuesta);
        die();
    }




}

// =======================================================
// MANEJO DE PETICIONES AJAX
// =======================================================

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

if (isset($_POST["listarCitasAdoptante"]) && $_POST["listarCitasAdoptante"] == "ok") {
    $id = $_POST["id_adoptantes"];

    $respuesta = CitasModel::mdlListarCitasAdoptante($id);

    echo json_encode([
        "codigo" => "200",
        "listaCitas" => $respuesta
    ]);

    return;
}

if (isset($_POST["cancelarCita"]) == "ok") {
    $objCitas = new CitasController();
    $objCitas->id_citas = $_POST["id_citas"];
    $objCitas->ctrCancelarCita();
}

?>