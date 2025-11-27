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

        // 🔍 VALIDAR SI EL ADOPTANTE YA TIENE CITA PENDIENTE O CONFIRMADA
        $citaActiva = CitasModel::mdlBuscarCitaActiva($this->id_adoptantes);

        if ($citaActiva) {
            ob_clean();
            header('Content-Type: application/json');
            echo json_encode([
                "codigo" => "409",
                "mensaje" => "Tienes una cita en proceso, en este momento no puedes adoptar"
            ]);
            die();
        }

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

    public function ctrCancelarCita()
    {
        $infoCita = CitasModel::mdlInfoCita($this->id_citas);

        if (!$infoCita) {
            ob_clean();
            header('Content-Type: application/json');
            echo json_encode(["codigo" => "404", "mensaje" => "Cita no encontrada"]);
            die();
        }

        // Validación de 48 horas
        $fechaCita = strtotime($infoCita["fecha_cita"]);
        $ahora = time();
        $diferenciaHoras = ($fechaCita - $ahora) / 3600;

        if ($diferenciaHoras < 48) {
            ob_clean();
            header('Content-Type: application/json');
            echo json_encode([
                "codigo" => "403",
                "mensaje" => "No es posible cancelar tan cerca de la hora acordada"
            ]);
            die();
        }

        // CANCELAR CITA EN BD
        $respuesta = CitasModel::mdlCancelarCita($this->id_citas);

        if ($respuesta["codigo"] == "200") {

            // LISTAR TODOS LOS ADMINISTRADORES
            $admins = CitasModel::mdlAdmins();

            if (!$admins || count($admins) === 0) {
                // No hay admins: informar pero la cita ya está cancelada
                ob_clean();
                header('Content-Type: application/json');
                echo json_encode([
                    "codigo" => "200",
                    "mensaje" => "Cita cancelada correctamente, pero no se encontraron administradores para notificar."
                ]);
                die();
            }

            $failed = []; // mails que fallaron

            foreach ($admins as $admin) {
                // validar email no vacío
                $emailAdmin = $admin['email'] ?? null;
                $nombreAdmin = $admin['nombre_usuario'] ?? ($admin['nombre'] ?? 'Administrador');

                if (empty($emailAdmin)) {
                    $failed[] = [
                        "email" => $emailAdmin,
                        "error" => "Email vacío"
                    ];
                    continue;
                }

                // intentar enviar correo; Correo::enviarCorreoCancelacion devuelve true/false
                $sent = Correo::enviarCorreoCancelacion(
                    $emailAdmin,
                    $nombreAdmin,
                    $infoCita["mascota"],
                    $infoCita["fecha_cita"],
                    $infoCita["motivo"]
                );

                if (!$sent) {
                    $failed[] = [
                        "email" => $emailAdmin,
                        "error" => "send_failed"
                    ];
                }
            }

            // Añadir info de fallo en respuesta si los hay
            if (count($failed) > 0) {
                $respuesta['mail_failed'] = $failed;
                $respuesta['mensaje'] = $respuesta['mensaje'] . " (Algunos correos no se enviaron).";
            }
        }

        ob_clean();
        header('Content-Type: application/json');
        echo json_encode($respuesta);
        die();
    }



    public function ctrTraerFechas() {
        $fechas = CitasModel::mdlObtenerFechasOcupadas();
        ob_clean(); header('Content-Type: application/json'); echo json_encode($fechas); die();
    }

}

// --- MANEJO DE PETICIONES ---

if (isset($_POST["traerFechas"]) == "ok") { $obj = new CitasController(); $obj->ctrTraerFechas(); }
if (isset($_POST["listarCitas"]) && $_POST["listarCitas"] == "ok") { $obj = new CitasController(); $obj->ctrListarCitas(); }
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

if (isset($_POST["cancelarCita"]) && $_POST["cancelarCita"] == "ok") {
    $objCitas = new CitasController();
    $objCitas->id_citas = $_POST["id_citas"];
    $objCitas->ctrCancelarCita();
}

if (isset($_POST["listarCitasAdoptante"]) && $_POST["listarCitasAdoptante"] === "ok") {

    $id = $_POST["id_adoptantes"];

    $respuesta = CitasModel::mdlListarCitasAdoptante($id);

    ob_clean();
    echo json_encode([
        "codigo" => "200",
        "listaCitas" => $respuesta
    ]);
    die();
}

?>