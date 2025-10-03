<?php

include_once "../model/mascotasModel.php";

class MascotasController
{
    public $id_mascotas;
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
        $objRespuestaMascota = MascotasModel::mdlListarMascota();
        echo json_encode($objRespuestaMascota);
    }


    public function ctrEliminarMascota()
    {
        $objRespuestaMascota = MascotasModel::mdlEliminarMascota($this->id_mascotas);
        echo json_encode($objRespuestaMascota);
    }

    public function ctrRegistrarMascota()
    {
        $objRespuestaMascota = MascotasModel::mdlRegistrarMascota(
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
        $objRespuestaMascota = MascotasModel::mldEditarMascota($this->id_mascotas, $this->nombre, $this->especie, $this->raza, 
        $this->edad, $this->sexo, $this->tamaño, $this->fecha_ingreso, $this->estado_salud, $this->estado, $this->descripcion, $this->imagen);
        echo json_encode($objRespuestaMascota);
    }

}

if (isset($_POST["listarMascotas"]) == "ok") {
    $objMascotas = new MascotasController();
    $objMascotas->ctrListarMascotas();
}

if (isset($_POST["eliminarMascota"]) == "ok") {
    $objMascotas = new MascotasController();
    $objMascotas->id_mascotas = $_POST["id_mascotas"];
    $objMascotas->ctrEliminarMascota();
}

if (isset($_POST["registrarMascota"]) == "ok") {
    $objMascotas = new MascotasController();
    
    $objMascotas->nombre = $_POST["nombre"];
    $objMascotas->especie = $_POST["especie"];
    $objMascotas->raza = $_POST["raza"];
    $objMascotas->edad = $_POST["edad"];
    $objMascotas->sexo = $_POST["sexo"];
    $objMascotas->tamaño = $_POST["tamaño"];
    $objMascotas->fecha_ingreso = $_POST["fecha_ingreso"];
    $objMascotas->estado_salud = $_POST["estado_salud"];
    $objMascotas->estado = $_POST["estado"];
    $objMascotas->descripcion = $_POST["descripcion"];
    $objMascotas->imangen = $_POST["imangen"];  

    $objMascotas->ctrRegistrarMascota();
}

if (isset($_POST["editarMascota"]) == "ok") {
    $objMascotas = new MascotasController();

    $objMascotas->nombre = $_POST["nombre"];
    $objMascotas->especie = $_POST["especie"];
    $objMascotas->raza = $_POST["raza"];
    $objMascotas->edad = $_POST["edad"];
    $objMascotas->sexo = $_POST["sexo"];
    $objMascotas->tamaño = $_POST["tamaño"];
    $objMascotas->fecha_ingreso = $_POST["fecha_ingreso"];
    $objMascotas->estado_salud = $_POST["estado_salud"];
    $objMascotas->estado = $_POST["estado"];
    $objMascotas->descripcion = $_POST["descripcion"];
    $objMascotas->imangen = $_POST["imangen"];
    $objMascotas->id_mascotas = $_POST["id_mascotas"];

    $objMascotas->ctrEditarMascota ();
}