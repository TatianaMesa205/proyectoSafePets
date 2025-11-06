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
        $objRespuesta = AdopcionesModel::mdlRegistrarAdopcion(
            $this->mascotas_id,
            $this->adoptantes_id,
            $this->fecha_adopcion,
            $this->estado,
            $this->observaciones,
            $this->contrato,

        );
        echo json_encode($objRespuesta);
    }

    public function ctrEditarAdopcion()
    {
        $objRespuesta = AdopcionesModel::mldEditarAdopcion($this->id_adopciones, $this->mascotas_id, $this->adoptantes_id, $this->fecha_adopcion, $this->estado, $this->observaciones, $this->contrato );
        echo json_encode($objRespuesta);


    }

}

if (isset($_POST["listarAdopciones"]) == "ok") {
    $objAdopciones = new AdopcionesController();
    $objAdopciones->ctrListarAdopciones();
}

if (isset($_POST["eliminarAdopcion"]) == "ok") {
    $objAdopciones = new AdopcionesController();
    $objAdopciones->id_adopciones = $_POST["id_adopciones"];
    $objAdopciones->ctrEliminarAdopcion();
}

if (isset($_POST["registrarAdopcion"]) == "ok") {
    $objAdopciones = new AdopcionesController();
    $objAdopciones->mascotas_id = $_POST["mascotas_id"];
    $objAdopciones->adoptantes_id = $_POST["adoptantes_id"];
    $objAdopciones->fecha_adopcion = $_POST["fecha_adopcion"];
    $objAdopciones->estado = $_POST["estado"];
    $objAdopciones->observacion = $_POST["observacion"];
    $objAdopciones->contrato = $_POST["contrato"];
    $objAdopciones->id_adopciones = $_POST["id_adopciones"];
    $objAdopciones->ctrRegistrarAdopcion();
}

if (isset($_POST["editarAdopcion"]) == "ok") {
    $objAdopciones = new AdopcionesController();

    $objAdopciones->mascotas_id = $_POST["mascotas_id"];
    $objAdopciones->adoptantes_is = $_POST["adoptantes_id"];
    $objAdopciones->fecha_adopcion = $_POST["fecha_adopcion"];
    $objAdopciones->estado = $_POST["estado"];
    $objAdopciones->observacion = $_POST["observacion"];
    $objAdopciones->contrato = $_POST["contrato"];
    $objAdopciones->id_adopciones = $_POST["id_adopciones"];

    $objAdopciones->ctrEditarAdopcion();
}