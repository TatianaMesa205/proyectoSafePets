<?php

include_once "../model/adoptantesModel.php";

class AdoptantesController
{

    public $id_adaptantes;
    public $nombre_completo;
    public $cedula;
    public $telefono;
    public $email;
    public $direccion;
    public $id_usuarios;

    public function ctrListarAdoptantes()
    {
        $objRespuesta = AdoptantesModel::mdlListarAdoptantes();
        echo json_encode($objRespuestaMusuario);
    }


    public function ctrEliminarMusuario()
    {
        $objRespuesta = AdoptantesModel::mdlEliminarMusuario($this->id_adoptantes);
        echo json_encode($objRespuestaMusuario);
    }

    public function ctrRegistrarAdoptante()
    {
        $objRespuestaAdoptantes = AdoptantesModel::mdlRegistrarAdoptante(
            $this->nombre_completo,
            $this->cedula,
            $this->telefono,
            $this->email,
            $this->direccion,
            $this->id_usuarios,

        );
        echo json_encode($objRespuesta);
    }

    public function ctrEditarAdoptante()
    {
        $objRespuesta = AdoptantesModel::mldEditarAdoptante($this->id_adoptantes, $this->nombre_completo, $this->cedula, $this->telefono, $this->email, $this->direccion);
        echo json_encode($objRespuesta);


    }

}

if (isset($_POST["listarAdoptantes"]) == "ok") {
    $objAdoptantes = new AdoptantesController();
    $objAdoptantes->ctrListarAdoptantes();
}

if (isset($_POST["eliminarAdoptante"]) == "ok") {
    $objAdoptantes = new AdoptantesController();
    $objAdoptantes->id_adoptantes = $_POST["id_adoptantes"];
    $objAdoptantes->ctrEliminarAdoptante();
}

if (isset($_POST["registrarAdoptante"]) == "ok") {
    $objAdoptantes = new AdoptantesController();
    $objAdoptantes->nombreM = $_POST["nombreM"];
    $objMusuarios->edadM = $_POST["edadM"];
    $objMusuarios->usuario_id = $_POST["usuario_id"];
    $objAdoptantes->ctrRegistrarAdoptante();
}

if (isset($_POST["editarAdoptante"]) == "ok") {
    $objAdoptantes = new AdoptantesController();

    $objMusuarios->nombreM = $_POST["nombreM"];
    $objMusuarios->edadM = $_POST["edadM"];
    $objMusuarios->idMascota = $_POST["idMascota"];

    $objAdoptantes->ctrEditarAdoptante();
}