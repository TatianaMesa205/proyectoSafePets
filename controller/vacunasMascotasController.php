<?php

include_once "../model/vacunasMascotasModel.php";

class VacunasMascotasController
{
    public $id_vacunas_mascotas;
    public $id_mascotas;
    public $id_vacunas;
    public $fecha_aplicacion;
    public $proxima_dosis;

    public function ctrListarVacunasMascotas()
    {
        $objRespuesta = VacunasMascotasModel::mdlListarVacunasMascotas();
        echo json_encode($objRespuesta);
    }

    public function ctrEliminarVacunaMascota()
    {
        $objRespuesta = VacunasMascotasModel::mdlEliminarVacunaMascota($this->id_vacunas_mascotas);
        echo json_encode($objRespuesta);
    }

    public function ctrRegistrarVacunaMascota()
    {
        $objRespuesta = VacunasMascotasModel::mdlRegistrarVacunaMascota(
            $this->id_mascotas,
            $this->id_vacunas,
            $this->fecha_aplicacion,
            $this->proxima_dosis
        );
        echo json_encode($objRespuesta);
    }

    public function ctrEditarVacunaMascota()
    {
        $objRespuesta = VacunasMascotasModel::mdlEditarVacunaMascota(
            $this->id_vacunas_mascotas,
            $this->id_mascotas,
            $this->id_vacunas,
            $this->fecha_aplicacion,
            $this->proxima_dosis
        );
        echo json_encode($objRespuesta);
    }
}



if (isset($_POST["listarVacunasMascotas"]) == "ok") {
    $obj = new VacunasMascotasController();
    $obj->ctrListarVacunasMascotas();
}

if (isset($_POST["eliminarVacunaMascota"]) == "ok") {
    $obj = new VacunasMascotasController();
    $obj->id_vacunas_mascotas = $_POST["id_vacunas_mascotas"];
    $obj->ctrEliminarVacunaMascota();
}

if (isset($_POST["registrarVacunaMascota"]) == "ok") {
    $obj = new VacunasMascotasController();
    $obj->id_mascotas = $_POST["id_mascotas"];
    $obj->id_vacunas = $_POST["id_vacunas"];
    $obj->fecha_aplicacion = $_POST["fecha_aplicacion"];
    $obj->proxima_dosis = $_POST["proxima_dosis"];
    $obj->ctrRegistrarVacunaMascota();
}

if (isset($_POST["editarVacunaMascota"]) && $_POST["editarVacunaMascota"] == "ok") {
    $obj = new VacunasMascotasController();
    $obj->id_vacunas_mascotas = $_POST["id_vacunas_mascotas"];
    $obj->id_mascotas = $_POST["id_mascotas"];
    $obj->id_vacunas = $_POST["id_vacunas"];
    $obj->fecha_aplicacion = $_POST["fecha_aplicacion"];
    $obj->proxima_dosis = $_POST["proxima_dosis"];
    $obj->ctrEditarVacunaMascota();
}

?>
