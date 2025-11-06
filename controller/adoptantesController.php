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

    public function ctrListarAdoptantes()
    {
        $objRespuesta = AdoptantesModel::mdlListarAdoptantes();
        echo json_encode($objRespuesta);
    }


    public function ctrEliminarAdoptante()
    {
        $objRespuesta = AdoptantesModel::mdlEliminarAdoptante($this->id_adoptantes);
        echo json_encode($objRespuesta);
    }

    public function ctrRegistrarAdoptante()
    {
        $objRespuesta = AdoptantesModel::mdlRegistrarAdoptante(
            $this->nombre_completo,
            $this->cedula,
            $this->telefono,
            $this->email,
            $this->direccion,

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
    $objAdoptantes->nombre_completo = $_POST["nombre_completo"];
    $objAdoptantes->cedula = $_POST["cedula"];
    $objAdoptantes->telefono = $_POST["telefono"];
    $objAdoptantes->email = $_POST["email"];
    $objAdoptantes->direccion = $_POST["direccion"];
    $objAdoptantes->id_usuarios = $_POST["id_usuarios"];
    $objAdoptantes->ctrRegistrarAdoptante();
}

if (isset($_POST["editarAdoptante"]) == "ok") {
    $objAdoptantes = new AdoptantesController();

    $objAdoptantes->nombre_completo = $_POST["nombre_completo"];
    $objAdoptantes->cedula = $_POST["cedula"];
    $objAdoptantes->telefono = $_POST["telefono"];
    $objAdoptantes->email = $_POST["email"];
    $objAdoptantes->direccion = $_POST["direccion"];
    $objAdoptantes->id_usuarios = $_POST["id_usuarios"];
    $objAdoptantes->id_adoptantes = $_POST["id_adoptantes"];

    $objAdoptantes->ctrEditarAdoptante();
}