<?php

include_once "../model/citasModel.php";

class MusuarioControlador
{

    public $idMascota;
    public $nombreM;
    public $edadM;
    public $usuario_id;
    public $raza_id;
    public $tipo_mascota_id;

    public function ctrListarMusuarios()
    {
        $objRespuestaMusuario = CitasModel::mdlListarCitas();
        echo json_encode($objRespuestaMusuario);
    }


    public function ctrEliminarMusuario()
    {
        $objRespuestaMusuario = CitasModel::mdlEliminarCita($this->idMascota);
        echo json_encode($objRespuestaMusuario);
    }

    public function ctrRegistrarMusuario()
    {
        $objRespuestaMusuario = CitasModel::mdlRegistrarCita(
            $this->nombreM, 
            $this->edadM,
            $this->usuario_id,
            $this->raza_id,
            $this->tipo_mascota_id
        );
        echo json_encode($objRespuestaMusuario);
    }

    public function ctrEditarMusuario()
    {
        $objRespuestaMusuario = CitasModel::mdlEditarCita($this->idMascota, $this->nombreM, $this->edadM);
        echo json_encode($objRespuestaMusuario);


    }

}

if (isset($_POST["listarMusuarios"]) == "ok") {
    $objMusuarios = new MusuarioControlador();
    $objMusuarios->ctrListarMusuarios();
}

if (isset($_POST["eliminarMusuario"]) == "ok") {
    $objMusuarios = new MusuarioControlador();
    $objMusuarios->idMascota = $_POST["idMascota"];
    $objMusuarios->ctrEliminarMusuario();
}

if (isset($_POST["registrarMusuario"]) == "ok") {
    $objMusuarios = new MusuarioControlador();
    $objMusuarios->nombreM = $_POST["nombreM"];
    $objMusuarios->edadM = $_POST["edadM"];
    $objMusuarios->usuario_id = $_POST["usuario_id"];
    $objMusuarios->raza_id = $_POST["raza_id"];
    $objMusuarios->tipo_mascota_id = $_POST["tipo_mascota_id"];
    $objMusuarios->ctrRegistrarMusuario();
}

if (isset($_POST["editarMusuario"]) == "ok") {
    $objMusuarios = new MusuarioControlador();

    $objMusuarios->nombreM = $_POST["nombreM"];
    $objMusuarios->edadM = $_POST["edadM"];
    $objMusuarios->idMascota = $_POST["idMascota"];

    $objMusuarios->ctrEditarMusuario();
}