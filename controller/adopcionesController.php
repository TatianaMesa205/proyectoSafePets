<?php
include_once "../model/adopcionesModel.php";

class AdopcionesController
{
    public $id_adopciones;
    public $mascotas_id;
    public $adoptantes_id;
    public $fecha_adopcion;
    public $estado;
    public $observaciones;
    public $contrato;

    public function ctrListarAdopciones()
    {
        $objRespuesta = AdopcionesModel::mdlListarAdopciones();
        echo json_encode($objRespuesta);
    }

    public function ctrEliminarAdopcion()
    {
        $objRespuesta = AdopcionesModel::mdlEliminarAdopcion($this->id_adopciones);
        echo json_encode($objRespuesta);
    }

    public function ctrRegistrarAdopcion()
    {
        // Manejo del archivo (PDF o imagen)
        $nombreArchivo = null;
        if (isset($_FILES["contrato"]) && $_FILES["contrato"]["error"] == 0) {
            $carpeta = "../../CarpetaCompartida/Contratos/";
            if (!file_exists($carpeta)) {
                mkdir($carpeta, 0777, true);
            }

            $nombreArchivo = uniqid("contrato_") . "_" . basename($_FILES["contrato"]["name"]);
            $rutaDestino = $carpeta . $nombreArchivo;

            if (move_uploaded_file($_FILES["contrato"]["tmp_name"], $rutaDestino)) {
                $this->contrato = $nombreArchivo;
            } else {
                $this->contrato = null;
            }
        }

        $objRespuesta = AdopcionesModel::mdlRegistrarAdopcion(
            $this->mascotas_id,
            $this->adoptantes_id,
            $this->fecha_adopcion,
            $this->estado,
            $this->observaciones,
            $this->contrato
        );

        echo json_encode($objRespuesta);
    }

    public function ctrEditarAdopcion()
    {
        $contratoActual = $_POST["contrato_actual"] ?? null;
        $this->contrato = $contratoActual; 

        if (isset($_FILES["contrato"]) && $_FILES["contrato"]["error"] == 0) {

            $carpeta = "../../CarpetaCompartida/Contratos/";
            if (!file_exists($carpeta)) {
                mkdir($carpeta, 0777, true);
            }

            $nombreArchivo = uniqid("contrato_") . "_" . basename($_FILES["contrato"]["name"]);
            $rutaDestino = $carpeta . $nombreArchivo;

            if (move_uploaded_file($_FILES["contrato"]["tmp_name"], $rutaDestino)) {
                $this->contrato = $nombreArchivo;
            }
        }

        $objRespuesta = AdopcionesModel::mdlEditarAdopcion(
            $this->id_adopciones,
            $this->mascotas_id,
            $this->adoptantes_id,
            $this->fecha_adopcion,
            $this->estado,
            $this->observaciones,
            $this->contrato 
        );

        echo json_encode($objRespuesta);
    }

}


if (isset($_POST["listarAdopciones"]) && $_POST["listarAdopciones"] == "ok") {
    $obj = new AdopcionesController();
    $obj->ctrListarAdopciones();
}

if (isset($_POST["eliminarAdopcion"]) && $_POST["eliminarAdopcion"] == "ok") {
    $obj = new AdopcionesController();
    $obj->id_adopciones = $_POST["id_adopciones"];
    $obj->ctrEliminarAdopcion();
}

if (isset($_POST["registrarAdopcion"]) && $_POST["registrarAdopcion"] == "ok") {
    $obj = new AdopcionesController();
    $obj->mascotas_id = $_POST["mascotas_id"];
    $obj->adoptantes_id = $_POST["adoptantes_id"];
    $obj->fecha_adopcion = $_POST["fecha_adopcion"];
    $obj->estado = $_POST["estado"];
    $obj->observaciones = $_POST["observaciones"] ?? "";
    $obj->ctrRegistrarAdopcion();
}

if (isset($_POST["editarAdopcion"]) && $_POST["editarAdopcion"] == "ok") {
    $obj = new AdopcionesController();
    $obj->id_adopciones = $_POST["id_adopciones"];
    $obj->mascotas_id = $_POST["mascotas_id"];
    $obj->adoptantes_id = $_POST["adoptantes_id"];
    $obj->fecha_adopcion = $_POST["fecha_adopcion"];
    $obj->estado = $_POST["estado"];
    $obj->observaciones = $_POST["observaciones"] ?? "";
    $obj->ctrEditarAdopcion();
}

