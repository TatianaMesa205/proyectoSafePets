<?php

include_once "../model/musuarioModelo.php";

class MusuarioControlador
{

    public $id_mascotas;
    public $id_vacunas;
    public $nombre;
    public $especie;
    public $raza;
    public $edad;
    public $sexo;
    public $tamaño;
    public $fecha_ingreso;
    public $estado_salud;
    public $estado;
    public $descripcion;
    public $imagen;

    public function ctrListarMascotas()
    {
        $objRespuestaMascota = MascotaModel::mdlListarMascota();
        echo json_encode($objRespuestaMascota);
    }


    public function ctrCargarUsuario(){
        $objRespuesta = MascotaModel::mdlCargarUsuario($this->id_mascotas);
        echo json_encode($objRespuesta);
    }



    public function ctrEliminarMascota()
    {
        $objRespuestaMascota = MascotaModel::mdlEliminarMascota($this->id_mascotas);
        echo json_encode($objRespuestaMascota);
    }

    public function ctrRegistrarMascota()
    {
        $objRespuestaMascota = MascotaModel::mdlRegistrarMascota(
            $this->id_vacuna,
            $this->nombre, 
            $this->especie, 
            $this->raza, 
            $this->edad,
            $this->sexo, 
            $this->tamaño,
            $this->fecha_ingreso,
            $this->estado_salud, 
            $this->estado, 
            $this->descripcion, 
            $this->imagen
        );
        echo json_encode($objRespuestaMascota);
    }

    public function ctrEditarMascota()
    {
        $objRespuestaMascota = MascotaModel::mldEditarMascota($this->id_mascotas, $this->id_vacuna, $this->nombre, $this->especie, $this->raza, 
        $this->edad, $this->sexo, $this->tamaño, $this->fecha_ingreso, $this->estado_salud, $this->estado, $this->descripcion, $this->imagen);
        echo json_encode($objRespuestaMascota);


    }

}

if (isset($_POST["listarMascotas"]) == "ok") {
    $objMusuarios = new MascotaController();
    $objMusuarios->ctrListarMascotas();
}

if (isset($_POST["eliminarMusuario"]) == "ok") {
    $objMusuarios = new MascotaController();
    $objMusuarios->id_mascotas = $_POST["id_mascotas"];
    $objMusuarios->ctrEliminarMascota();
}

if (isset($_POST["registrarMusuario"]) == "ok") {
    $objMusuarios = new MascotaController();
    $objMusuarios->nombreM = $_POST["nombreM"];
    $objMusuarios->edadM = $_POST["edadM"];
    $objMusuarios->usuario_id = $_POST["usuario_id"];
    $objMusuarios->tipo_mascota_id = $_POST["tipo_mascota_id"];
    $objMusuarios->ctrRegistrarMascota();
}

if (isset($_POST["editarMusuario"]) == "ok") {
    $objMusuarios = new MascotaController();

    $objMusuarios->nombreM = $_POST["nombreM"];
    $objMusuarios->edadM = $_POST["edadM"];
    $objMusuarios->idMascota = $_POST["idMascota"];

    $objMusuarios->ctrEditarMascota ();
}