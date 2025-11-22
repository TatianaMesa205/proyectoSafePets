<?php

// --- CORRECCIÓN DE RUTA ---
// Usamos __DIR__ para asegurar que encuentre el modelo sin importar desde dónde se llame
include_once __DIR__ . "/../model/mascotasModel.php";

class MascotasController
{
    public $id_mascotas;
    public $nombre;
    public $especie;
    public $raza;
    public $edad;
    public $sexo;
    public $tamano;
    public $fecha_ingreso;
    public $estado_salud;
    public $estado;
    public $descripcion;
    public $imagen;

    /* =============================================
       MÉTODO PARA CONTAR MASCOTAS (Inicio Admin)
       ============================================= */
    static public function ctrContarMascotas(){
        return MascotasModel::mdlContarMascotas();
    }

    public function ctrListarMascotas()
    {
        $objRespuestaMascota = MascotasModel::mdlListarMascotas();
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
            $this->tamano,
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
        $objRespuestaMascota = MascotasModel::mdlEditarMascota(
            $this->id_mascotas, 
            $this->nombre, 
            $this->especie, 
            $this->raza, 
            $this->edad, 
            $this->sexo, 
            $this->tamano, 
            $this->fecha_ingreso, 
            $this->estado_salud, 
            $this->estado, 
            $this->descripcion, 
            $this->imagen
        );
        echo json_encode($objRespuestaMascota);
    }
}

// =======================================================
// MANEJO DE PETICIONES AJAX
// =======================================================

if (isset($_POST["listarMascotas"]) && $_POST["listarMascotas"] == "ok") {
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
    $objMascotas->tamano = $_POST["tamano"];
    $objMascotas->fecha_ingreso = $_POST["fecha_ingreso"];
    $objMascotas->estado_salud = $_POST["estado_salud"];
    $objMascotas->estado = $_POST["estado"];
    $objMascotas->descripcion = $_POST["descripcion"];

    $ruta_foto = "";
    if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == 0) {
        $directorio = "../../CarpetaCompartida/Mascotas/";
        if (!file_exists($directorio)) {
            mkdir($directorio, 0777, true);
        }
        $nombreArchivo = uniqid() . "_" . basename($_FILES["imagen"]["name"]);
        $ruta_foto = $directorio . $nombreArchivo;
        move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta_foto);
    }
    $objMascotas->imagen = $ruta_foto;
    $objMascotas->ctrRegistrarMascota();
}

if (isset($_POST["editarMascota"]) && $_POST["editarMascota"] == "ok") {

    $objMascotas = new MascotasController();
    $objMascotas->id_mascotas = $_POST["id_mascotas"];
    $objMascotas->nombre = $_POST["nombre"];
    $objMascotas->especie = $_POST["especie"];
    $objMascotas->raza = $_POST["raza"];
    $objMascotas->edad = $_POST["edad"];
    $objMascotas->sexo = $_POST["sexo"];
    $objMascotas->tamano = $_POST["tamano"];
    $objMascotas->fecha_ingreso = $_POST["fecha_ingreso"];
    $objMascotas->estado_salud = $_POST["estado_salud"];
    $objMascotas->estado = $_POST["estado"];
    $objMascotas->descripcion = $_POST["descripcion"];

    $ruta_foto = "";
    if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == 0) {
        $directorio = "../../CarpetaCompartida/Mascotas/";
        if (!file_exists($directorio)) {
            mkdir($directorio, 0777, true);
        }
        $nombreArchivo = uniqid() . "_" . basename($_FILES["imagen"]["name"]);
        $ruta_foto = $directorio . $nombreArchivo;
        move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta_foto);
    } else {
        $ruta_foto = isset($_POST["imagen_actual"]) ? $_POST["imagen_actual"] : "";
    }

    $objMascotas->imagen = $ruta_foto;
    $objMascotas->ctrEditarMascota();
}
?>