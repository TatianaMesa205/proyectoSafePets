<?php
include_once "../model/seguimientosModel.php";

class SeguimientosMascotasController
{
    public $id_seguimientos;
    public $id_adopciones;
    public $fecha_visita;
    public $observacion;

    // 1. LISTAR SEGUIMIENTOS (Tabla principal)
    public function ctrListarSeguimientos()
    {
        $objRespuesta = SeguimientosMascotasModel::mdlListarSeguimientos();
        echo json_encode($objRespuesta);
    }

    // 2. LISTAR ADOPCIONES (Para el Select)
    // Este método llamará al Modelo que ahora incluye la "fecha_adopcion"
    public function ctrListarAdopcionesSelect()
    {
        $objRespuesta = SeguimientosMascotasModel::mdlListarAdopcionesParaSelect();
        echo json_encode($objRespuesta);
    }

    // 3. REGISTRAR
    public function ctrRegistrarSeguimiento()
    {
        $objRespuesta = SeguimientosMascotasModel::mdlRegistrarSeguimiento(
            $this->id_adopciones,
            $this->fecha_visita,
            $this->observacion
        );
        echo json_encode($objRespuesta);
    }

    // 4. EDITAR
    public function ctrEditarSeguimiento()
    {
        $objRespuesta = SeguimientosMascotasModel::mdlEditarSeguimiento(
            $this->id_seguimientos,
            $this->id_adopciones,
            $this->fecha_visita,
            $this->observacion
        );
        echo json_encode($objRespuesta);
    }

    // 5. ELIMINAR
    public function ctrEliminarSeguimiento()
    {
        $objRespuesta = SeguimientosMascotasModel::mdlEliminarSeguimiento($this->id_seguimientos);
        echo json_encode($objRespuesta);
    }
}

// --- PETICIONES POST ---

if (isset($_POST["listarSeguimientos"]) && $_POST["listarSeguimientos"] == "ok") {
    $obj = new SeguimientosMascotasController();
    $obj->ctrListarSeguimientos();
}

if (isset($_POST["listarAdopcionesSelect"]) && $_POST["listarAdopcionesSelect"] == "ok") {
    $obj = new SeguimientosMascotasController();
    $obj->ctrListarAdopcionesSelect();
}

if (isset($_POST["registrarSeguimiento"]) && $_POST["registrarSeguimiento"] == "ok") {
    $obj = new SeguimientosMascotasController();
    $obj->id_adopciones = $_POST["id_adopciones"];
    $obj->fecha_visita = $_POST["fecha_visita"];
    $obj->observacion = $_POST["observacion"];
    $obj->ctrRegistrarSeguimiento();
}

if (isset($_POST["editarSeguimiento"]) && $_POST["editarSeguimiento"] == "ok") {
    $obj = new SeguimientosMascotasController();
    $obj->id_seguimientos = $_POST["id_seguimientos"];
    $obj->id_adopciones = $_POST["id_adopciones"];
    $obj->fecha_visita = $_POST["fecha_visita"];
    $obj->observacion = $_POST["observacion"];
    $obj->ctrEditarSeguimiento();
}

if (isset($_POST["eliminarSeguimiento"]) && $_POST["eliminarSeguimiento"] == "ok") {
    $obj = new SeguimientosMascotasController();
    $obj->id_seguimientos = $_POST["id_seguimientos"];
    $obj->ctrEliminarSeguimiento();
}
?>