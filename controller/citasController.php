<?php

include_once "../model/citasModel.php";

class CitasController
{

    public $id_citas;
    public $id_adoptantes;
    public $id_mascotas;
    public $fecha_cita;
    public $estado;
    public $motivo;

    public function ctrListarCitas()
    {
        $objRespuestaCitas = CitasModel::mdlListarCitas();
        echo json_encode($objRespuestaCitas);
    }


    public function ctrEliminarCita()
    {
        $objRespuestaCitas = CitasModel::mdlEliminarCita($this->id_citas);
        echo json_encode($objRespuestaCitas);
    }

    public function ctrRegistrarCita()
    {
        $objRespuestaCitas = CitasModel::mdlRegistrarCita(
            $this->id_adoptantes,
            $this->id_mascotas,
            $this->fecha_cita,
            $this->estado,
            $this->motivo
        );
        echo json_encode($objRespuestaCitas);
    }

    public function ctrEditarCita()
    {
        $objRespuestaCitas = CitasModel::mdlEditarCita($this->id_citas, $this->id_adoptantes, $this->id_mascotas, $this->fecha_cita, $this->estado, $this->motivo);
        echo json_encode($objRespuestaCitas);


    }

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