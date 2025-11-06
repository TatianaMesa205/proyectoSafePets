<?php

include_once "../model/vacunasModel.php";

class VacunasController
{
    public $id_vacunas;
    public $nombre_vacuna;
    public $tiempo_aplicacion;

    public function ctrListarVacunas()
    {
        $objRespuesta = VacunasModel::mdlListarVacunas();
        echo json_encode($objRespuesta);
    }

    public function ctrEliminarVacuna()
    {
        $objRespuesta = VacunasModel::mdlEliminarVacuna($this->id_vacunas);
        echo json_encode($objRespuesta);
    }

    public function ctrRegistrarVacuna()
    {
        $objRespuesta = VacunasModel::mdlRegistrarVacuna(
            $this->nombre_vacuna,
            $this->tiempo_aplicacion
        );
        echo json_encode($objRespuesta);
    }

    public function ctrEditarVacuna()
    {
        $objRespuesta = VacunasModel::mdlEditarVacuna(
            $this->id_vacunas,
            $this->nombre_vacuna,
            $this->tiempo_aplicacion
        );
        echo json_encode($objRespuesta);
    }
}

/* ========== RUTAS ========== */

if (isset($_POST["listarVacunas"]) == "ok") {
    $obj = new VacunasController();
    $obj->ctrListarVacunas();
}

if (isset($_POST["eliminarVacuna"]) == "ok") {
    $obj = new VacunasController();
    $obj->id_vacunas = $_POST["id_vacunas"];
    $obj->ctrEliminarVacuna();
}

if (isset($_POST["registrarVacuna"]) == "ok") {
    $obj = new VacunasController();
    $obj->nombre_vacuna = $_POST["nombre_vacuna"];
    $obj->tiempo_aplicacion = $_POST["tiempo_aplicacion"];
    $obj->ctrRegistrarVacuna();
}

if (isset($_POST["editarVacuna"]) == "ok") {
    $obj = new VacunasController();
    $obj->id_vacunas = $_POST["id_vacunas"];
    $obj->nombre_vacuna = $_POST["nombre_vacuna"];
    $obj->tiempo_aplicacion = $_POST["tiempo_aplicacion"];
    $obj->ctrEditarVacuna();
}
?>
