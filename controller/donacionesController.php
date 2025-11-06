<?php

include_once "../model/donacionesModel.php";

class DonacionesController
{
    public $id_donaciones;
    public $id_usuarios;
    public $monto;
    public $fecha;
    public $metodo_pago;

    public function ctrListarDonaciones()
    {
        $objRespuesta = DonacionesModel::mdlListarDonaciones();
        echo json_encode($objRespuesta);
    }

    public function ctrEliminarDonacion()
    {
        $objRespuesta = DonacionesModel::mdlEliminarDonacion($this->id_donaciones);
        echo json_encode($objRespuesta);
    }

    public function ctrRegistrarDonacion()
    {
        $objRespuesta = DonacionesModel::mdlRegistrarDonacion(
            $this->id_usuarios,
            $this->monto,
            $this->fecha,
            $this->metodo_pago
        );
        echo json_encode($objRespuesta);
    }

    public function ctrEditarDonacion()
    {
        $objRespuesta = DonacionesModel::mdlEditarDonacion(
            $this->id_donaciones,
            $this->id_usuarios,
            $this->monto,
            $this->fecha,
            $this->metodo_pago
        );
        echo json_encode($objRespuesta);
    }
}

/* ========== RUTAS ========== */

if (isset($_POST["listarDonaciones"]) == "ok") {
    $obj = new DonacionesController();
    $obj->ctrListarDonaciones();
}

if (isset($_POST["eliminarDonacion"]) == "ok") {
    $obj = new DonacionesController();
    $obj->id_donaciones = $_POST["id_donaciones"];
    $obj->ctrEliminarDonacion();
}

if (isset($_POST["registrarDonacion"]) == "ok") {
    $obj = new DonacionesController();
    $obj->id_usuarios = $_POST["id_usuarios"];
    $obj->monto = $_POST["monto"];
    $obj->fecha = $_POST["fecha"];
    $obj->metodo_pago = $_POST["metodo_pago"];
    $obj->ctrRegistrarDonacion();
}

if (isset($_POST["editarDonacion"]) == "ok") {
    $obj = new DonacionesController();
    $obj->id_donaciones = $_POST["id_donaciones"];
    $obj->id_usuarios = $_POST["id_usuarios"];
    $obj->monto = $_POST["monto"];
    $obj->fecha = $_POST["fecha"];
    $obj->metodo_pago = $_POST["metodo_pago"];
    $obj->ctrEditarDonacion();
}
?>
